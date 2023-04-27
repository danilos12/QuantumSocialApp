<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\CommandModule;
use App\Models\Tag_groups;
use App\Models\Tag_items;
use App\Models\TwitterToken;
use App\Models\QuantumAcctMeta;
use DateTime;
use DateTimeZone;

class CommandmoduleController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
		$title = 'Command Module';
        return view('commandmodule')->with('title', $title);
    }

    public function create(Request $request) {
        // dd($request);
        try {          
            $postData = $request->all();
            $user_id = Auth::id();
            $main_twitter_id = $postData['twitter_id'];      
            $acctMeta = QuantumAcctMeta::where('user_id' , Auth::id())->first();
            $twitter_meta = TwitterToken::where('twitter_id', $main_twitter_id)->first();
            $utc = new DateTime("now", new DateTimeZone($acctMeta->timezone));
            $datetime = $utc->format('Y-m-d H:i:s'); // save this to database for custom slot initially
            
            $post = null;
            
            // Save the regular tweet for main account
            $insertData = [
                'user_id' => $user_id,
                'twitter_id' => $main_twitter_id,
                'post_type' => $postData['post_type_tweets'],
                'post_description' => urldecode($postData['tweet_text_area']) ?? null,
                'tweetlink' => $postData['retweet-link-input'] ?? null,
                'rt_time' => $postData['num-custom-cm'] ?? null,
                'rt_frame' => $postData['time-custom-cm'] ?? null,
                'rt_ite' => $postData['iterations-custom-cm'] ?? null,
                'promo_id' => $postData['retweet'] ?? null, 
                'sched_method' => $postData['scheduling-options'] ?? null,
                'sched_time' => $datetime,
                'post_type_code' => rand(10000, 99999),
            ];

            if ($postData['scheduling-options'] === 'set-countdown') {
                $countDown = ($postData['c-set-countdown'] === '1') ? rtrim($postData['ct-set-countdown'], 's') : $postData['ct-set-countdown'];
                $countDownWithWords = $postData['c-set-countdown'] . ' ' . $countDown;

                // modify the UTC datetime object by adding the countdown time
                $utc->modify($countDownWithWords);

                // format the resulting datetime object as a string in the 'YYYY-MM-DD HH:MM:SS' format
                $scheduled_time = $utc->format('Y-m-d H:i:s');

                $insertData['sched_time'] = $scheduled_time;
            }

            if ($postData['scheduling-options'] === 'custom-time') {
                $custom_time = '';

                if (isset($postData['ct-hour']) && isset($postData['ct-min']) && isset($postData['ct-am-pm'])) {
                    $ctime = $postData['ct-hour'] . ":" . $postData['ct-min'] . $postData['ct-am-pm'];
                    $ct = DateTime::createFromFormat('h:i A', $ctime);
                    $formatted24hrTime = $ct->format('H:i');
                    $custom_time = $postData['ct-time-date'] . ' ' . $formatted24hrTime;
                }

                // modify the UTC datetime object by adding the countdown time
                $utc->modify($custom_time);

                // format the resulting datetime object as a string in the 'YYYY-MM-DD HH:MM:SS' format
                $custom_time = $utc->format('Y-m-d H:i:s');

                $insertData['sched_time'] = $custom_time;                
            }
          
            if ($postData['scheduling-options'] === 'custom-slot') {                
                $insertData['sched_time'] = $datetime;
            }

            if ($postData['post_type_tweets'] === "retweet-tweets") {
                $url = urldecode($postData['retweet-link-input']);
                $tweet_id = basename(parse_url($url, PHP_URL_PATH));

                $retweet = $this->tweet2twitter($twitter_meta, array('tweet_id' => $tweet_id), "https://api.twitter.com/2/users/". $main_twitter_id . "/retweets");

                return $retweet;
            }

            // CommandModule::create($insertData);   

            // post tweet
            if ($postData['scheduling-options'] === "send-now") {
                $post = $this->tweet2twitter($twitter_meta, array('text' => urldecode($postData['tweet_text_area'])), "https://api.twitter.com/2/tweets");

                return $post;
            }            

            // Save tweetstorm for main account
            $tweetStormKeys = preg_grep('/^tweet_text_area_\d+$/', array_keys($postData));
            if (isset($tweetStormKeys)) {
                foreach ($tweetStormKeys as $tweetStormKey) {
                    $tweetStormValue = $postData[$tweetStormKey];
                    if ($tweetStormValue) {
                        $tweetStormNumber = str_replace('tweet_text_area_', '', $tweetStormKey);
                        $insertData['twitter_id'] = $main_twitter_id;
                        $insertData['post_description'] = urldecode($tweetStormValue);
                        CommandModule::create($insertData);
                    }

                    if ($postData['scheduling-options'] === "send-now") {
                        $this->postTweet2twitter($main_twitter_id, $tweetStormValue);
                    }
                }
            }

            // Save regular tweet for cross tweet account
            $crossTweetKeys = preg_grep('/^crossTweetAcct_\d+$/', array_keys($postData));
            if (isset($crossTweetKeys)) {
                foreach ($crossTweetKeys as $crossTweetKey) {
                    $crossTweetValue = $postData[$crossTweetKey];
                    if ($crossTweetValue) {
                        $crossTweetNumber = str_replace('crossTweetAcct_', '', $crossTweetKey);
                        $insertData['twitter_id'] = $crossTweetValue;
                        $insertData['crosstweet_accts'] = $crossTweetNumber;
                        CommandModule::create($insertData);
                    }

                    if ($postData['scheduling-options'] === "send-now") {
                        $this->postTweet2twitter($crossTweetValue, urldecode($postData['tweet_text_area']));
                    }
                    
                }
            }


            // Save tweetstorm for cross tweet account
            $tweetStormKeys = preg_grep('/^tweet_text_area_\d+$/', array_keys($postData));
            if (isset($tweetStormKeys)) {
                foreach ($tweetStormKeys as $tweetStormKey) {
                    $tweetStormValue = $postData[$tweetStormKey];
                    $tweetStormNumber = str_replace('tweet_text_area_', '', $tweetStormKey);
                    if (isset($postData['crossTweetAcct_' . $tweetStormNumber])) {
                        $insertData['twitter_id'] = $postData['crossTweetAcct_' . $tweetStormNumber];
                        $insertData['post_description'] = urldecode($tweetStormValue);
                        CommandModule::create($insertData);
                    }

                    if ($postData['scheduling-options'] === "send-now") {
                        $this->postTweet2twitter($postData['crossTweetAcct_' . $tweetStormNumber], urldecode($tweetStormValue));
                    }
                }
            }          
           
            // Return success response
            return response()->json(['status' => '201', 'message' => 'Data has been created.', 'tweet' => $post]);

        } catch (Exception $e) {
            Log::error('Error creating data: ' . $e->getMessage());
            return response()->json(['status' => '409', 'error' => 'Failed to create data.']);
   
        }
    }
   
    
    public function addTagGroup(Request $request) {
        
        try {
            $insert = Tag_groups::create([
                'user_id' => Auth::id(),
                'twitter_id' => $request->input('twitter_id'),
                'tag_group_mkey' => "_" . strtolower(str_replace(' ', '_', $request->input('myInput'))), //add underscore in the beginner always
                'tag_group_mvalue' => $request->input('myInput'),
            ]);

            if ($insert) {
                $latestRecord = Tag_groups::where('user_id', Auth::id())
                                ->latest('created_at')
                                ->first();

                // access the newly added column
                $key = $latestRecord->tag_group_mkey;
                $value = $latestRecord->tag_group_mvalue;
                // Return success response
                return response()->json(['status' => '201', 'key' => $key, 'value' => $value]);
            } else {
                // Return error response
                return response()->json(['status' => '400', 'message' => 'Bad request']);
            }
            
        } catch (Exception $e) {
            return response()->json(['status' => '400', 'message' => $e]);
        }
    } 

    public function addTagItem(Request $request) {
        // dd($request);
        try {
            $insert = Tag_items::create([
                'user_id' => Auth::id(),
                'twitter_id' => $request->input('twitter_id'),
                'tag_meta_key' => $request->input('tag_id'),
                'tag_meta_value' => $request->input('hashtag'),
            ]);

            if ($insert) {
                $latestRecord = Tag_items::where('user_id', Auth::id())
                ->latest('created_at')
                    ->first();

                // access the newly added column
                $value = $latestRecord->tag_meta_value;
                // Return success response
                return response()->json(['status' => '201', 'hashtag' => $value]);
            } else {
                // Return error response
                return response()->json(['status' => '400', 'message' => 'Bad request']);
            }
        } catch (Exception $e)  {
            return response()->json(['status' => '400', 'message' => $e]);

        }

    }

    public function getTagGroups($id) {
        try {     
            $tagGroups = Tag_groups::where(['user_id' => Auth::id(), 'twitter_id' => $id])->get();
            
            return response()->json($tagGroups);
        }  catch (Exception $e) {
            return response()->json(['status' => '400', 'message' => $e]);
        } 
    }
    
    public function getTagItems(Request $request) {
        $twitterId = $request->input('twitter_id');
        $tagId = $request->input('tag_id');

        $tagItems = Tag_items::where(['twitter_id' => $twitterId, 'tag_meta_key' => $tagId])->get(); 
        return response()->json($tagItems);
    }

    public function getUnselectedTwitterAccounts() {

        $getUnselectedTwitter = DB::table('twitter_accts')
                ->join('ut_acct_mngt', 'twitter_accts.twitter_id', '=', 'ut_acct_mngt.twitter_id')
                ->select('twitter_accts.*', 'ut_acct_mngt.*')
                ->where('ut_acct_mngt.selected', "=", 0) // selected
                ->where('ut_acct_mngt.user_id', "=", Auth::id())
                ->where('twitter_accts.deleted', "=", 0)
                ->get();

        return response()->json($getUnselectedTwitter);
    }
 
    public function getTweetsUsingPostTypes($id, $post_type) {
        $tweets = null;

        if ($post_type === "posted" ) {
            $tweets = CommandModule::where(['twitter_id' => $id, 'sched_method' => 'send-now' ])->get();
        }
        else if($post_type === "save-draft") {
            $tweets = CommandModule::where(['twitter_id' => $id, 'sched_method' => $post_type ])->get();
        } else {
            $tweets = DB::table('cmd_module')
                        ->where('twitter_id', $id)
                        ->whereIn('sched_method', ['rush-queue', 'add-queue', 'custom-time', 'set-countdown'])
                        ->orderByRaw("FIELD(sched_method, 'rush-queue') DESC")
                        ->orderByRaw("FIELD(sched_method, 'add-queue', 'custom-time', 'set-countdown') DESC")
                        ->orderByRaw("CASE WHEN sched_method IN ('add-queue', 'custom-time', 'set-countdown') THEN sched_time END DESC")
                        ->orderBy('created_at', 'ASC')
                        ->get();                           
        }

        return response()->json($tweets);
    }    

    // API to post and retweet to twitter
    function tweet2twitter($twitter_meta, $data, $endpoint) {
        
        // check access token
        $check = $this->isAccessTokenExpired($twitter_meta);

        // send tweet
        $headers = array(
            'Authorization: Bearer ' . (($check !== false) ? $check->access_token : $twitter_meta->access_token),
            'Content-Type: application/json'
        );

        $data = json_encode($data);
        
        $sendTweetNow = $this->apiRequest($endpoint, $headers, 'POST', $data );

        if ($sendTweetNow) {
            return response()->json(['status' => 200, 'message' => 'Your tweet has been posted']);
        } else {
            return response()->json(['status' => 500, 'message' => 'Failed to send tweet']);
        }
    }

    function isAccessTokenExpired($twitter_meta)
    {
        // dd($twitter_meta);
        $expires_in = $twitter_meta->expires_in;
        $created_at = strtotime($twitter_meta->updated_at);
        $refresh_token = $twitter_meta->refresh_token;
        $expires_at = $created_at + $expires_in;
        $current_time = time();


        // dd($expires_at >= $current_time);
        if ($expires_at <= $current_time) {

            $getNewToken = $this->getRefreshToken($refresh_token, env('TWITTER_CLIENT_ID'));
            session()->put('token_details', $getNewToken);

            if (!isset($getNewToken->access_token) || !isset($getNewToken->refresh_token)) {
                return response()->json(['status' => 500, 'message' => 'Failed to refresh token']);
            }

            // update token in database
            $updateToken = TwitterToken::where('twitter_id', $twitter_meta->twitter_id)
                ->update([
                    'access_token' => $getNewToken->access_token,
                    'refresh_token' => $getNewToken->refresh_token
                ]);

            if (!$updateToken) {
                return response()->json(['status' => 500, 'message' => 'Failed to update token']);
            }

            return $getNewToken;
        }

        return false;
    }
    
    function apiRequest($url, $headers, $method, $data)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_ENCODING, '');
        curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
        curl_setopt($curl, CURLOPT_TIMEOUT, 0);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);

        if ($method === 'POST') {
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        } else {
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
        }        

        $response = curl_exec($curl);
        $info = curl_getinfo($curl);

        curl_close($curl);
        
        if ($info['http_code'] == 201) {
            $data = json_decode($response);
            return $data;
        } else {
            return curl_error($curl);
        }
    }

    function getRefreshToken($refreshToken, $clientId)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.twitter.com/2/oauth2/token?refresh_token=$refreshToken&grant_type=refresh_token&client_id=$clientId",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded',
                'Cookie: guest_id=v1%3A167698806120814768; guest_id_ads=v1%3A167698806120814768; guest_id_marketing=v1%3A167698806120814768; personalization_id="v1_c/rVbz9sH+phQ/F7c4ZfMg=="'
            ),
        ));


        $response = curl_exec($curl);
        $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if ($http_code != 200) {
            // Handle the error here
            return ['error' => 'Error: ' . $http_code];
        }

        $json_response = json_decode($response);

        return $json_response;
    }

}

