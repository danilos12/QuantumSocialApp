<?php

namespace App\Http\Controllers;

use App\Models\Twitter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


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
            $_ENV =  env('TWITTER_BEARER_TOKEN') ?? "AAAAAAAAAAAAAAAAAAAAAAX4lAEAAAAANMt4THwRzGff8IzPOSJAxsYDfnw%3D3UBzwDd2HJg4HZdl7vreAG5HoVNibNzXkIDL1qaER0UJ076wAX";

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
            $_ENV =  env('TWITTER_BEARER_TOKEN') ?? "AAAAAAAAAAAAAAAAAAAAAAX4lAEAAAAANMt4THwRzGff8IzPOSJAxsYDfnw%3D3UBzwDd2HJg4HZdl7vreAG5HoVNibNzXkIDL1qaER0UJ076wAX";

            $headers = array(
                "Authorization: Bearer " . $_ENV
            );

            $url = "https://api.twitter.com/2/users/" . $twitterId . "/tweets";
            $data = null;
            $filteredData = null;
            
           
            switch ($type) {
                case "retweet":
                    $data = "tweet.fields=referenced_tweets,created_at,author_id,public_metrics,text,attachments&max_results=100";
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

    public function twitterDetails($twitterId) {
        dd($twitterId);
    }


    public function switchedAccount(Request $request) {

        $title = "Profile";
        
        try {
            $twitterId = $request->input('twitter_id');


            // Update the selected Twitter account
            $updated = DB::table('ut_acct_mngt')
                ->where('user_id', Auth::id())
                ->update([
                    'selected' => DB::raw("CASE WHEN twitter_id = $twitterId THEN 1 ELSE 0 END")
                ]);
           

            // Check if update was successful
            if ($updated) {
                return response()->json(['success' => true, 'message' => 'Tweets are updated', 'get_tweets' => 'getTweets']);
            } else {
                return response()->json(['success' => false, 'message' => 'Tweets are not updated']);                
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

    public function removeTwitterAccount(Request $request)
    {

        $id = $request->input('twitter_id');
        $delete = Twitter::where('twitter_id', $id)->update(['deleted' => 1]);

        return response()->json(['success' => true, "deleted" => $delete, 'message' => 'Twitter account is now deleted']);
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
