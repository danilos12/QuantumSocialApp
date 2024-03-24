<?php

namespace App\Http\Controllers;

use App\Models\Twitter;
use App\Models\UT_AcctMngt;
use App\Models\TwitterToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Queue;
use App\Helpers\TwitterHelper;



class TwitterApi extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getTweets($twitterId)
    {
        try {
            $_ENV =  TwitterHelper::getActiveAPI(Auth::id())->bearer_token;

            $headers = array(
                "Authorization: Bearer " . $_ENV
            );       

            $data = "tweet.fields=created_at,author_id,public_metrics,text,attachments&max_results=30";
            $url = "https://api.twitter.com/2/users/" . $twitterId . "/tweets";
            $request = $this->curlGetHttpRequest($url, $headers, $data);
            
            if (!empty($request->data)) {
                // get images of the tweet 
                foreach ($request->data as $v) {
                    if (property_exists($v, "attachments")) {
                        // call cURL request for API        
                        $data = "expansions=attachments.media_keys&media.fields=url";
                        $getAttachment = $this->curlGetHttpRequest("https://api.twitter.com/2/tweets/" . $v->id, array("Authorization: Bearer " . $_ENV), $data);

                        if (property_exists($getAttachment, 'includes')) {
                            $getAttachmentURL = $getAttachment->includes->media;
                            foreach ($getAttachmentURL as $media) {
                                if (property_exists($media, 'url')) {
                                    $v->image = $media->url;
                                }
                            }
                        }

                    } 
                }

                // return the modified data as a JSON response
                return response()->json([
                    'status' => 200,
                    'data' => $request->data,
                ]);
            } else {
                return response()->json([
                    'status' => 201,
                    'message' => 'Tweets not found'
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage()  . ' in ' . $th->getFile() . ' on line ' . $th->getLine()
            ]);
        }
    }

    public function getTweetFilters($twitterId, $type)
    {
        try {
            $_ENV =  TwitterHelper::getActiveAPI(Auth::id())->bearer_token;

            $headers = array(
                "Authorization: Bearer " . $_ENV
            );

            $url = "https://api.twitter.com/2/users/" . $twitterId . "/tweets";
            $data = null;
            $filteredData = null;
            
           
            switch ($type) {
                case "retweet":
                    $data = "tweet.fields=referenced_tweets,created_at,author_id,public_metrics,text,attachments&max_results=30";
                    $request = $this->curlGetHttpRequest($url, $headers, $data);

                    if (!empty($request->data)) {      
                        $filteredData = array_filter($request->data, function ($item) {
                            if (isset($item->referenced_tweets)) {
                                foreach ($item->referenced_tweets as $referencedTweet) {
                                    if ($referencedTweet->type === 'retweeted') {
                                        return true;
                                    }
                                }
                            }
                            return false;
                        });      
                    }      
                    break;

                case "quote":
                    $data = "";
                    break;
                    
                case "comments":
                    echo "hi";
                    break;

                case "replies":
                    $data = "exclude=retweets&tweet.fields=created_at,author_id,public_metrics,text,attachments&max_results=100";
                    $request = $this->curlGetHttpRequest($url, $headers, $data);

                    if (!empty($request->data)) {
                        $filteredData = $request->data;
                    }                    
                    break;

                case "image" :
                    $data = "tweet.fields=created_at,author_id,public_metrics,text,attachments&max_results=100";
                    $request = $this->curlGetHttpRequest($url, $headers, $data);

                    if (!empty($request->data)) {
                        $filteredData = array_filter($request->data, function ($item) {
                            return isset($item->attachments);
                        });

                        foreach ($filteredData as $tweet) {
                            $data1 = "expansions=attachments.media_keys&media.fields=url";
                            $getAttachment = $this->curlGetHttpRequest("https://api.twitter.com/2/tweets/" . $tweet->id, array("Authorization: Bearer " . $_ENV), $data1);
                            
                            if (property_exists($getAttachment, 'includes')) {
                                $attachmentData = $getAttachment->includes->media;
                                
                                foreach ($attachmentData as $media) {
                                    if (property_exists($media, 'url')) {
                                        $tweet->image = $media->url;
                                    }
                                }
                            }
                        }
                       
                    }
                    break;

                case "links";
                    echo "hi";
                    break;

                case "no-links";
                    echo "hi";
                    break;

                default:
                    $data = "tweet.fields=created_at,author_id,public_metrics,text,attachments&max_results=30";
                    $request = $this->curlGetHttpRequest($url, $headers, $data);
                    
                    if (!empty($request->data)) {
                        // get images of the tweet 
                        $filteredData = $request->data;

                        foreach ($request->data as $v) {
                            if (property_exists($v, "attachments")) {
                                // call cURL request for API        
                                $data = "expansions=attachments.media_keys&media.fields=url";
                                $getAttachment = $this->curlGetHttpRequest("https://api.twitter.com/2/tweets/" . $v->id, array("Authorization: Bearer " . $_ENV), $data);

                                if (property_exists($getAttachment, 'includes')) {
                                    $getAttachmentURL = $getAttachment->includes->media;
                                    foreach ($getAttachmentURL as $media) {
                                        if (property_exists($media, 'url')) {
                                            $v->image = $media->url;
                                        }
                                    }
                                }
                            }
                        }
                    }
                    break;
            }            

            if ($filteredData !== null) {                              
                // return the modified data as a JSON response
                return response()->json([
                    'status' => 200,
                    'data' => $filteredData,
                ]);
            } else {
                return response()->json([
                    'status' => 201,
                    'message' => 'Tweets not found',
                ]);
            }
            
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage()  . ' in ' . $th->getFile() . ' on line ' . $th->getLine()
            ]);       
        }
    }

    public function tweetNow(Request $request, $id) {

        try {
            $like = explode('-', $request->tweet);
            $getToken = TwitterHelper::getTwitterToken($id);
            $twitterMeta = $getToken->toArray();

            $twitter_meta = $twitterMeta[0];

            // check access tokenW
            $checkIfTokenExpired = TwitterHelper::isTokenExpired($twitter_meta['expires_in'], strtotime($twitter_meta['updated_at']), $twitter_meta['refresh_token'], $twitter_meta['access_token'], $twitter_meta['twitter_id']);  
            
            // send tweet
            $headers = array(
                'Authorization: Bearer ' . $checkIfTokenExpired['token'],
                'Content-Type: application/json'
            );  
            
            $data = json_encode(array('tweet_id' => $like[1]));
            
            // $getLikes = $this->curlGetHttpRequest('https://api.twitter.com/2/users/' . $id . '/likes', $headers, array('tweet_id' => $like[1]));
            $commandModule = new CommandmoduleController();
            $getLikes = $commandModule->apiRequest('https://api.twitter.com/2/users/' . $id . '/likes', $headers, 'POST', $data);
            dd($getLikes);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage()  . ' in ' . $th->getFile() . ' on line ' . $th->getLine()
            ]);
        }

    } 

    public function switchedAccount(Request $request) {
        $title = "Profile";        
        try {
            $twitterId = str_replace('twitter-', '', $request->input('id'));

            $updatedSelected = UT_AcctMngt::where('user_id', Auth::id())
                ->where('twitter_id', $twitterId)
                ->update(['selected' => 1]);

            // check if the twitter linked is more than one
            $countTwitterAcct = UT_AcctMngt::where('user_id', Auth::id())->count();
            $updatedRow = '';
            if ($countTwitterAcct > 1) {
                // update the other twitter not equal to twitter id
                $updatedSelected += UT_AcctMngt::where('user_id', Auth::id())
                    ->where('twitter_id', '!=', $twitterId)                
                    ->update(['selected' => 0]);
                    
                $updatedRow = $updatedSelected;
            }
            
            if ($updatedSelected > 0 && $updatedRow > 0) {
                $selectedUser = DB::table('twitter_accts')
                    ->join('ut_acct_mngt', 'twitter_accts.twitter_id', '=', 'ut_acct_mngt.twitter_id')
                    ->select('twitter_accts.*', 'ut_acct_mngt.*')
                    ->where('ut_acct_mngt.selected', "=", 1) // selected
                    ->where('ut_acct_mngt.user_id', "=", Auth::id()) 
                    ->where('twitter_accts.deleted', "=", 0)
                    ->first();

                return response()->json(['success' => true, 'message' => 'Accounts are updated', 'twitter_id' => $selectedUser->twitter_id]);
            } else {
                return response()->json(['success' => false, 'message' => 'Accounts are not updated']);
            }

        } catch (\Exception $e) {
            
            return response()->json([
                'message' => 'Error updating records: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function tweets($id) {
        $tweets = $this->getTweets($id);
        return $tweets;
    }

    // to be back
    public function removeTwitterAccount(Request $request)
    {
        $id = $request->input('twitter_id');
        $twitter = Twitter::where('twitter_id', $id)->where('user_id', Auth::id());
        
        // Deleting the Twitter account
        $deletedTwitter = $twitter->delete();

        // Checking if the Twitter account deletion was successful
        if ($deletedTwitter) {
            // Deleting associated Twitter meta
            $deleteTwitterMeta = TwitterToken::where('twitter_id', $id)->where('user_id', Auth::id());
            $deletedMeta = $deleteTwitterMeta->delete();
            
            // If deletion of Twitter meta is successful
            if ($deletedMeta) {
                return response()->json([
                    'success' => true,
                    'deleted_twitter' => $twitter, // Sending deleted Twitter account details
                    'deleted_meta' => $deleteTwitterMeta, // Sending deleted Twitter meta details
                    'message' => 'Twitter account and associated meta data are now deleted'
                ]);
            } else {
                // If deletion of Twitter meta fails
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to delete associated Twitter meta data'
                ], 500);
            }
        } else {
            // If deletion of Twitter account fails
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete Twitter account'
            ], 500);
        }
    }

    public function curlGetHttpRequest($url, $headers,  $data) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url . "?" . $data);            
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($curl);      
        $info = curl_getinfo($curl);     

        curl_close($curl);   
        
        if ($info['http_code'] == 200) {
            $data = json_decode($response);
            return $data;
        } else {
            return curl_error($curl);
        }
        
    }
    

}
