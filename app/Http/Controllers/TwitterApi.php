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
use App\Helpers\MembershipHelper;
use Illuminate\Support\Facades\Cache;


class TwitterApi extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


     protected $defaultid;
     public function __construct()
    {
        if (Auth::guard('web')->check()) {
            $this->middleware('auth');

        }
        if(Auth::guard('member')->check()) {

            $this->middleware('member-access');


        }


    }

     protected function setDefaultId()
     {
         if (Auth::guard('web')->check()) {
            return $this->defaultid = Auth::id();
         }
         if (Auth::guard('member')->check()) {
            return $this->defaultid = MembershipHelper::membercurrent();
         }
     }

     public function addmemberxaccts(Request $request){
        if(Auth::guard('web') || Auth::guard('member')->user()->admin_access == 1){

            $memberinfo = [
                'member_id' => intval($request->input('mid')),
                't_rid' => intval($request->input('twitterids')),
                'mtwitter_id' => $request->input('twitter_id'),
                'user_id' => intval($request->input('user_id')),
                'twitter_access' => $request->input('xaccess'),
                'selected' => true
            ];
            // return response()->json(['message'=>$memberinfo]);
            if($memberinfo['twitter_access'] === false){
                $updatedSelected = 0;
                $updatedSelected += DB::table('member_xaccount')
                         ->where('member_id', $memberinfo['member_id'])
                         ->where('mtwitter_id', '!=', $memberinfo['mtwitter_id'])
                         ->update(['selected' => 1]);

                $deleted = DB::table('member_xaccount')->where('t_rid', $memberinfo['t_rid'])->delete();
                if($deleted&&$updatedSelected){
                    return response()->json(['message'=>'Member cannot access this X account', 'stat'=>'success']);
                }
            }elseif($memberinfo['twitter_access'] === true){
                $updatedSelected = 0;

                $memberxadd = DB::table('member_xaccount')->insert($memberinfo);
                $updatedSelected += DB::table('member_xaccount')
                ->where('member_id', $memberinfo['member_id'])
                ->where('mtwitter_id', '!=', $memberinfo['mtwitter_id'])
                ->update(['selected' => 0]);
                if($memberxadd && $updatedSelected){
                    return response()->json(['message'=>'Member can now access this X account', 'stat'=>'success']);
                }
            }
        }else{
            return response()->json(['message'=>'You are not allowed to access this, please ask permission from the owner', 'stat'=>'warning']);
        }
    }

    public function getTweets($twitterId)
    {
        try {
            $_ENV =  TwitterHelper::getActiveAPI($this->setDefaultId())->bearer_token;

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
            
            $type = 'tweets';

            // Check if cached data exists
            $cachedData = Cache::get('tweets_' . $twitterId);     
            // dd($cachedData); 
            
            if ($cachedData) {
                // Return cached data if available
                return response()->json([
                    'status' => 200,
                    'tweets' => $cachedData,                    
                    'message' => 'Tweets retrieved from cache',
                ]);
            } else {
                // If cached data doesn't exist, fetch tweets from Twitter API
                $_ENV = TwitterHelper::getActiveAPI($this->setDefaultId())->bearer_token;
                $headers = ["Authorization: Bearer " . $_ENV];
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

                        // dd($request);
                            
                        if (isset($request->data)) {
                            // get images of the tweet
                            $filteredData['data'] = $request->data;
    
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

                            $filteredData['original'] = $request->meta;
                            $filteredData['status'] = 200;
                        } else {
                             // Error response
                            $filteredData['data'] = "Error: Failed to retrieve data.";
                            $filteredData['status'] = 500; // Internal Server Error
                        }             
                    break;                               
                        
                }


                if ($filteredData['status'] === 200) {
                    // Cache the fetched tweets
                    Cache::put('tweets_' . $twitterId, $filteredData, now()->addMinutes(30));

                    // return the modified data as a JSON response
                    return response()->json([
                        'status' => 200,
                        'tweets' => $filteredData,
                        'message' => 'Tweets retrieved from Twitter API',
                    ]);
                } else {
                    $bladeContent = view('profile_free_tier')->render();
                    return response()->json([
                        'status' => 500,
                        'message' => 'Tweets not found',
                        'html' =>  $bladeContent // Replace 'your-blade-template' with the name of your Blade template file
                    ]);
                }
                             
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage()  . ' in ' . $th->getFile() . ' on line ' . $th->getLine()
            ]);
        }
    }


    public function getTweetMoreTweets(Request $request, $twitterId) {
        // Check if cached data exists
        $cachedData = Cache::get('next_tweets_' . $twitterId);     

        if ($cachedData) {
            // Return cached data if available
            return response()->json([
                'status' => 200,
                'more_tweets' => $cachedData,                    
                'message' => 'Tweets retrieved from cache',
            ]);
        } else { 
            $_ENV =  TwitterHelper::getActiveAPI($this->setDefaultId())->bearer_token;

            $headers = array(
                "Authorization: Bearer " . $_ENV
            );
    
            $url = "https://api.twitter.com/2/users/" . $twitterId . "/tweets";
            $data = "tweet.fields=created_at,author_id,public_metrics,text,attachments&" . "pagination_token=" . $request->input('paginationToken');
            $request = $this->curlGetHttpRequest($url, $headers, $data);            
            $filteredData = null;
                            
            if (!empty($request->data)) {
                // get images of the tweet
                $filteredData['data'] = $request->data;

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

                $filteredData['original'] = $request->meta;
            }
            
            if ($filteredData !== null) {
                // Cache the fetched tweets
                Cache::put('next_tweets_' . $twitterId, $filteredData, now()->addMinutes(30));

                // return the modified data as a JSON response
                return response()->json([
                    'status' => 200,
                    'more_tweets' => $filteredData,
                    'message' => 'Tweets retrieved from Twitter API',
                ]);
            } else {
                return response()->json([
                    'status' => 201,
                    'message' => 'Tweets not found',
                ]);
            }
            
        }


        // dd($request);
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
            // dd($getLikes);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage()  . ' in ' . $th->getFile() . ' on line ' . $th->getLine()
            ]);
        }

    }

    public function switchedAccount(Request $request) {
        $title = "Profile";
        $twitterId = str_replace('twitter-', '', $request->input('id'));

        try {
            if(Auth::guard('web')->check()){
                $twitterId = str_replace('twitter-', '', $request->input('id'));

                $updatedSelected = UT_AcctMngt::where('user_id', $this->setDefaultId())
                    ->where('twitter_id', $twitterId)
                    ->update(['selected' => 1]);

                // check if the twitter linked is more than one
                $countTwitterAcct = UT_AcctMngt::where('user_id', $this->setDefaultId())->count();
                $updatedRow = '';
                if ($countTwitterAcct > 1) {
                    // update the other twitter not equal to twitter id
                    $updatedSelected += UT_AcctMngt::where('user_id', $this->setDefaultId())
                        ->where('twitter_id', '!=', $twitterId)
                        ->update(['selected' => 0]);

                    $updatedRow = $updatedSelected;
                }

                if ($updatedSelected > 0 && $updatedRow > 0) {
                    $selectedUser = DB::table('twitter_accts')
                        ->join('ut_acct_mngt', 'twitter_accts.twitter_id', '=', 'ut_acct_mngt.twitter_id')
                        ->select('twitter_accts.*', 'ut_acct_mngt.*')
                        ->where('ut_acct_mngt.selected', "=", 1) // selected
                        ->where('ut_acct_mngt.user_id', "=", $this->setDefaultId())
                        ->where('twitter_accts.deleted', "=", 0)
                        ->first();

                    return response()->json(['success' => true, 'stat' => 'success', 'message' => 'Accounts are updated', 'twitter_id' => $selectedUser->twitter_id]);
                } else {
                    return response()->json(['success' => false, 'stat' => 'warning', 'message' => 'Accounts are not updated']);
                }
            }
            if(Auth::guard('member')->check()){
                $title = "Profile";
                $twitterId = str_replace('twitter-', '', $request->input('id'));

                $updatedSelected = DB::table('member_xaccount')
                ->where('member_id', Auth::guard('member')->user()->id)
                ->update(['selected' => 1]);
                $countTwitterAcct =  DB::table('member_xaccount')->where('member_id', Auth::guard('member')->user()->id)->count();
                $updatedRow = '';

                if ($countTwitterAcct > 1) {
                    $updatedSelected += DB::table('member_xaccount')
                    ->where('member_id', Auth::guard('member')->user()->id)
                    ->where('mtwitter_id', '!=', $twitterId)
                    ->update(['selected' => 0]);
                    $updatedRow = $updatedSelected;

                }

                if ($updatedSelected > 0 && $updatedRow > 0) {
                    $selectedUser = DB::table('twitter_accts')
                        ->join('member_xaccount', 'twitter_accts.user_id', '=', 'member_xaccount.user_id')
                        ->select('twitter_accts.*', 'member_xaccount.*')
                        ->where('member_xaccount.selected', "=", 1) // selected
                        ->where('member_xaccount.member_id', "=", Auth::guard('member')->user()->id)
                        ->first();

                    return response()->json(['success' => true, 'stat' => 'success', 'message' => 'Accounts are updated', 'twitter_id' => $selectedUser->twitter_id]);
                } else {
                    return response()->json(['success' => false, 'stat' => 'warning', 'message' => 'Accounts are not updated']);
                }
            }


        } catch (\Exception $e) {

            return response()->json([
                'message' => 'Error updating records: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function setDefaultxAcct(Request $request) {
        try {
            $userId = $this->setDefaultId();
            $twitterId = $request->input('twitter_id');
    
            $checkIfDefault = UT_AcctMngt::where('user_id', $userId)
                                         ->where('twitter_id', $twitterId)
                                         ->first();            
            
            $ctAcct = $checkIfDefault->is_default_ctAcct === 0 ? 1 : 0;
            
            $update = UT_AcctMngt::where('user_id', $userId)
                                 ->where('twitter_id', $twitterId)
                                 ->update(['is_default_ctAcct' => $ctAcct]);
    
            if ($update) {
                return response()->json([
                    'status' => 200, 
                    'message' => 'This X account is set to default in cross tweeting', 
                    'stat' => 'success', 
                    'setActive' => $ctAcct
                ]);
            } else {
                return response()->json([
                    'status' => 500, 
                    'message' => 'Error in setting this account to default', 
                    'stat' => 'warning', 
                    'setActive' => $ctAcct
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage()  . ' in ' . $th->getFile() . ' on line ' . $th->getLine()
            ]);
        }
    }

    public function getUnselectedTwitterAccounts() {

        $getUnselectedTwitter = DB::table('twitter_accts')
                ->join('ut_acct_mngt', 'twitter_accts.twitter_id', '=', 'ut_acct_mngt.twitter_id')
                ->select('twitter_accts.*', 'ut_acct_mngt.*')
                ->where('ut_acct_mngt.selected', "=", 0) // selected
                ->where('ut_acct_mngt.user_id', "=", $this->setDefaultId())
                ->where('twitter_accts.deleted', "=", 0)
                ->get();

        return response()->json($getUnselectedTwitter);
    }
    public function tweets($id) {
        $tweets = $this->getTweets($id);
        return $tweets;
    }

    // to be back
    public function removeTwitterAccount(Request $request)
    {
        if(Auth::guard('web')->check() || Auth::guard('member')->user()->admin_access == 1) {

            $id = $request->input('twitter_id');

            $twitter = Twitter::where('twitter_id', $id)->where('user_id', $this->setDefaultId());

            // check if id is selected in the UT_ACCT_MNGT table
            $selectedTwitter = UT_AcctMngt::where('twitter_id', $id)->first();

            if ($selectedTwitter->selected === 1) {
                return response()->json([
                    'stat' => 'warning',
                    'message' => 'Unable to delete. This twitter account is currently selected.', 
                    'status' => 500,
                ]);
            } else {

                $twitter = Twitter::where('twitter_id', $id)->where('user_id', $this->setDefaultId());
                
                // Deleting the Twitter account
                $deletedTwitter = $twitter->delete();
    
                // Checking if the Twitter account deletion was successful
                if ($deletedTwitter) {
                    // Deleting associated Twitter meta
                    $deleteTwitterMeta = TwitterToken::where('twitter_id', $id)->where('user_id', $this->setDefaultId());
                    $deletedMeta = $deleteTwitterMeta->delete();
                    
                    $deleteUT_Acct_Mngt = UT_AcctMngt::where('twitter_id', $id)->where('user_id', $this->setDefaultId());
                    $deletedUT_Acct_Mngt = $deleteUT_Acct_Mngt->delete();
                    
                    // If deletion of Twitter meta is successful
                    if ($deletedMeta && $deletedUT_Acct_Mngt) {
                        return response()->json([
                            'success' => 200,
                            'deleted_twitter' => $twitter, // Sending deleted Twitter account details
                            'deleted_meta' => $deleteTwitterMeta, // Sending deleted Twitter meta details
                            'deleted_mngt' => $deletedUT_Acct_Mngt, // Sending deleted Twitter meta details
                            'message' => 'Twitter account and associated meta data are now deleted',
                            'stat' => 'success',
                        ]);
                    } else {
                        // If deletion of Twitter meta fails
                        return response()->json([
                            'success' => false,
                            'message' => 'Failed to delete associated Twitter meta data',
                            'stat' => 'warning',
                        ], 500);
                    }
    
                } else {
                    // If deletion of Twitter account fails
                    return response()->json([
                        'success' => false,
                        'message' => 'Failed to delete Twitter account',
                        'stat' => 'warning',
                    ], 500);
                }
    
                return response()->json(['stat' => 'success', 'status' => 200, 'message' => 'Twitter account is now deleted']);
            }  

        } else {
                return response()->json(['stat' => 'warning', 'message' => 'You are not allowed to delete X account, please ask permission to the owner'],403);
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
        } elseif ($info['http_code'] == 403) {
            $data = json_decode($response);
            return $data;
        }
        
        else {
            return curl_error($curl);
        }

    }


}
