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
use DateTime;
use Date;
use Carbon\Carbon;
use App\Helpers\TwitterHelper;
use App\Models\Schedule;
use Illuminate\Support\Facades\Session;


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
        $userId = Auth::id(); //To check current user loggedin User ID dria
        $hasRegularTweetsInQueue = CommandModule::where('user_id', $userId)
            ->where('sched_method', 'add-queue')
            ->where('post_type', 'regular-tweets')
            ->exists();      

        return view('commandmodule', ['title' => $title, 'hasRegularTweetsInQueue' => $hasRegularTweetsInQueue]);
    }
 
    public function create(Request $request) {               
        try {                      
            $postData = $request->all();
            $user_id = Auth::id();
            $main_twitter_id = $postData['twitter_id'];
            $url = isset($postData['retweet-link-input']) ? urldecode($postData['retweet-link-input']) : null;
            $tweet_id = basename(parse_url($url, PHP_URL_PATH));
            $getToken = TwitterHelper::getTwitterToken($request->twitter_id);
            $twitterMeta = $getToken->toArray();
            $twitter_meta = $twitterMeta[0];
            $utc = TwitterHelper::now($user_id);
            $datetime = $utc->format('Y-m-d H:i:s'); // save this to database for custom slot initially            
            $sched_method = null;           
            $sched_time = null;           
            $checkToggle = TwitterToken::where('twitter_id', $main_twitter_id)->where('active', 1)->first();

            // Save the regular tweet for main account
            $insertData = [
                'user_id' => $user_id,
                'twitter_id' => $main_twitter_id,
                'post_type' => $postData['post_type_tweets'],
                'tweetlink' => $postData['retweet-link-input'] ?? null,
                'rt_time' => $postData['num-custom-cm'] ?? null,
                'rt_frame' => $postData['time-custom-cm'] ?? null,
                'rt_ite' => $postData['iterations-custom-cm'] ?? null,
                'promo_id' => $postData['promo-tweets-cmp'] ?? null,                 
                'post_type_code' => rand(10000, 99999),
                'active' => $checkToggle->queue_switch
            ];

            // dd($postData);

            // Determine the scheduling method and time based on the user's selected option
            if (isset($postData['scheduling-options'])) {
                $sched_method = $postData['scheduling-options'];
                switch ($postData['scheduling-options']) {
                    case 'add-queue':
                        $count = DB::table('posts')
                            ->where('twitter_id', $main_twitter_id)
                            ->whereNotIn('sched_method', ['send-now', 'save-draft'])
                            ->orderBy('sched_time', 'DESC')
                            ->count();
                        $lastTweet = DB::table('posts')
                            ->where('twitter_id', $main_twitter_id)
                            ->whereNotIn('sched_method', ['send-now', 'save-draft'])
                            ->orderBy('sched_time', 'DESC')
                            ->first();
                        $sched_time = ($count > 0) ? $lastTweet->sched_time : $datetime;
                        break;

                    case 'count-down':
                        $countDown = ($postData['c-set-countdown'] === '1') ? rtrim($postData['ct-set-countdown'], 's') : $postData['ct-set-countdown'];
                        
                        $countDownWithWords = $postData['c-set-countdown'] . ' ' . $countDown;

                        // modify the UTC datetime object by adding the countdown time
                        $utc->modify($countDownWithWords);

                        // format the resulting datetime object as a string in the  'YYYY-MM-DD HH:MM:SS' format
                        $scheduled_time = $utc->format('Y-m-d H:i:s');
                        $sched_time = $scheduled_time;
                        break;
                        
                    case 'custom-time':
                        // Refactor this section to reduce duplication
                        $formatted24hrTime = date('H:i', strtotime($postData['ct-hour'] . ":" . $postData['ct-min'] . " " . $postData['ct-am-pm']));
                        $custom_time = $postData['ct-time-date'] . ' ' . $formatted24hrTime;

                        // modify the UTC datetime object by adding the custom time
                        $utc->modify($custom_time);

                        // format the resulting datetime object as a string in the 'YYYY-MM-DD HH:MM:SS' format
                        $custom_time = $utc->format('Y-m-d H:i:s');

                        $sched_time = $custom_time;
                        break;
                        
                    case 'custom-slot':
                        $date = Carbon::parse(urldecode($postData['custom-slot-datetime']), TwitterHelper::timezone(Auth::id()));
                        $sched_time = $date;
                        break;

                    case 'rush-queue':
                        $count = DB::table('posts')
                            ->where('twitter_id', $main_twitter_id)
                            ->whereNotIn('sched_method', ['send-now', 'save-draft'])
                            ->count();

                            $firstTweet = DB::table('posts')
                            ->where('twitter_id', $main_twitter_id)
                            ->whereNotIn('sched_method', ['send-now', 'save-draft'])
                            ->where('sched_time', '>', TwitterHelper::now($user_id))
                            ->orderBy('sched_time', 'ASC')
                            ->first();


                        $sched_time = ($count > 0) ? $firstTweet->sched_time : $datetime; 
                        break;  
                }
            } else {
                $sched_time = $datetime;
                $sched_method = 'save-draft';
            }     

            // Save data for main account
            // $responses = array();
            $responses = [];
            foreach ($postData['textarea'] as $textarea) {
                $insertData['post_description'] = $textarea;
                $insertData['sched_method'] = $sched_method;
                $insertData['sched_time'] = $sched_time;
                // $insertData['post_type'] = 'tweet-storm-tweets';
                CommandModule::create($insertData);
                
                // // Post tweet if scheduling option is "send-now"
                if ($postData['scheduling-options'] === 'send-now') {                    
                    if ($postData['post_type_tweets'] === "retweet-tweets") {                        
                        $responses[] = $this->tweet2twitter($twitter_meta, array('tweet_id' => $tweet_id), "https://api.twitter.com/2/users/" . $main_twitter_id . "/retweets");                        
                    }  else {
                        $responses[] = $this->tweet2twitter($twitter_meta, array('text' => urldecode($textarea)), "https://api.twitter.com/2/tweets");
                    }
                }

                // Save crosstweet data
                $crosstweetData = $insertData;
                if (!empty($postData['crosstweet'])) {
                    foreach ($postData['crosstweet'] as $key => $account) {
                        $crosstweetData['post_description'] = $textarea;

                        $crosstweetId = str_replace('twitterId-', '', $account);
                        $crosstweetData['twitter_id'] = $crosstweetId;
                        $crosstweetData['crosstweet_accts'] = $key;

                        $twitter_meta_cross = TwitterToken::where('twitter_id', $crosstweetId )->first();
                        
                        CommandModule::create($crosstweetData);

                        // Post tweet if scheduling option is "send-now"
                        if ($postData['scheduling-options'] === 'send-now') {
                            if ($postData['post_type_tweets'] === "retweet-tweets") {
                                $responses[] = $this->tweet2twitter($twitter_meta_cross, array('tweet_id' => $tweet_id), "https://api.twitter.com/2/users/" . $crosstweetId . "/retweets");
                            } else {
                                $responses[] = $this->tweet2twitter($twitter_meta_cross, array('text' => urldecode($textarea)), "https://api.twitter.com/2/tweets");
                            }
                        }
                    }
                }
            }

            // Retrieve the last saved data
            $lastSavedData = CommandModule::latest()->first();
                                             
            // Return success response
            return response()->json(['status' => 200, 'message' => 'Data has been created.', 'tweet' => $lastSavedData]);

        } catch (Exception $e) {
            $trace = $e->getTrace();
            $message = $e->getMessage();            
            // Handle the error
            // Log or display the error message along with file and line number
            return response()->json(['status' => 500, 'error' => $trace, 'message' => $message]);
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

    public function getCustomSlot(Request $request) {
        try {
               
            $getCustomSlot = DB::table('schedule')
                            ->join('days', 'days.day', '=', 'schedule.slot_day')
                            ->select('schedule.*', 'days.*')
                            ->where('user_id', Auth::id())
                            ->where('schedule.post_type', $request->post_type)
                            ->orderBy('days.id', 'ASC')
                            ->get();

        } catch(Exception $e) {
            $trace = $e->getTrace();
            $message = $e->getMessage();            
            // Handle the error
            // Log or display the error message along with file and line number
            return response()->json(['status' => '500', 'error' => $trace, 'message' => $message]);
        }

        return response()->json($getCustomSlot);
    }
 
    public function getTweetsUsingPostTypes($id, $post_type) {
        try {
            $tweets = '';   
            $checkToggle = TwitterToken::where('twitter_id', $id)->first();           
            
            switch ($post_type) {
                case 'posted': 
                    // dd(TwitterHelper::now(Auth::id()));
                    $tweets = DB::table('posts')
                        ->where('twitter_id', $id)
                        ->where('sched_time', '<', TwitterHelper::now(Auth::id()))
                        // ->where('sched_method', 'posted')
                        ->get();
                    break;
                    
                case 'save-draft': 
                    $tweets = CommandModule::where(['twitter_id' => $id, 'sched_method' => $post_type])->get();
                    break;
                    
                case 'queue':                                                             

                    $posts = DB::table('posts')                                         
                            ->select('*')
                            ->whereIn('id', function ($query) {
                                $query->select(DB::raw('MIN(id)'))
                                ->from('posts')
                                ->groupBy('post_type_code');
                            })
                            ->where('twitter_id', $id)
                            ->where('user_id', Auth::id())
                            ->where('sched_time', '>=', TwitterHelper::now(Auth::id()))
                            ->where('posts.post_type', '!=','evergreen-tweets')
                            ->where('posts.post_type', '!=','promos-tweets')
                            // ->where('posts.post_type', '!=','tweet-storm-tweets')
                            // ->where('active', $checkToggle->queue_switch)
                            ->orderBy('sched_time', 'ASC')
                            ->orderBy('sched_method', 'DESC')
                            ->get();               

                    // dd($posts)        ;
                    $schedules = Schedule::where('user_id', Auth::id())->get();     

                    $recurringDates = [];
                    $r = [];
                    $currentMonth = now()->month;
                    $currentYear = now()->year;

                    foreach ($schedules as $schedule) {
                        $dayOfWeek = Carbon::parse($schedule->slot_day)->dayOfWeek;
                        $time = Carbon::parse($schedule->hour . ':' . $schedule->minute_at . ' ' . $schedule->ampm);
                        
                        // $startDate = Carbon::create($currentYear, $currentMonth)->startOfMonth()->subMonths(2);
                        // $endDate = Carbon::create($currentYear, $currentMonth)->endOfMonth();
                        $startDate = Carbon::now()->startOfMonth();
                        $endDate = Carbon::now()->addMonths(2)->endOfMonth();
                        $currentDate = $startDate->copy();
                        
                        while ($currentDate->lte($endDate)) {
                            if ($currentDate->dayOfWeek === $dayOfWeek) {
                                $recurringDates[] = [
                                    'sched_time' => $currentDate->copy()->setTime($time->hour, $time->minute)->format('Y-m-d H:i:s'),
                                    'post_type' => $schedule->post_type,
                                    'sched_method' => 'slot_sched' 
                                ];
                            }
                            
                            $currentDate->addDay();
                        }                        
                    }

                    $object = collect($recurringDates)->map(function ($item) {
                        return (object) $item;
                    });

                    $objects = $object->sortBy('sched_time');

                    $objects->transform(function ($item) {
                        $item->sched_time = (string) $item->sched_time; // Convert specific property to string
                        return $item;
                    });

                    $mergedData = $objects->merge($posts);

                    $currentDateTime = Carbon::now();
                    $tweetSorted = collect($mergedData)->filter(function ($tweet) use ($currentDateTime) {
                        $tweetDateTime = Carbon::parse($tweet->sched_time);

                        // dd($tweet->sched_time);
                        return $tweetDateTime->greaterThan($currentDateTime);
                    });

                    
                    $tweets = $tweetSorted->sortBy('sched_time')->values()->toArray();               
                    // dd($tweets);

                    break;

                case 'evergreen': 
                    $tweets = DB::table('posts')
                        ->select('*')
                        ->whereIn('id', function ($query) {
                            $query->select(DB::raw('MIN(id)'))
                            ->from('posts')
                            ->groupBy('post_type_code');
                        })
                        ->where('twitter_id', $id)
                        // ->where('sched_time', '>', TwitterHelper::now(Auth::id()))
                        ->where('post_type', '=','evergreen-tweets')
                        // ->where('active', $checkToggle->queue_switch)
                        ->orderByRaw('CASE WHEN sched_time < ? THEN 1 ELSE 0 END', TwitterHelper::now(Auth::id()))
                        ->orderBy('sched_time', 'ASC')
                        ->orderBy('sched_method', 'DESC')
                        ->orderBy('updated_at', 'ASC')
                        ->get();
                        break;    

                case 'promo': 
                    $tweets = DB::table('posts')
                        ->select('*')
                        ->whereIn('id', function ($query) {
                            $query->select(DB::raw('MIN(id)'))
                            ->from('posts')
                            ->groupBy('post_type_code');
                        })
                        ->where('twitter_id', $id)
                        // ->where('sched_time', '>', TwitterHelper::now(Auth::id()))
                        ->where('post_type', '=','promos-tweets')
                        // ->where('active', $checkToggle->queue_switch)
                        ->orderByRaw('CASE WHEN sched_time < ? THEN 1 ELSE 0 END', TwitterHelper::now(Auth::id()))
                        ->orderBy('sched_time', 'ASC')
                        ->orderBy('sched_method', 'DESC')
                        ->orderBy('updated_at', 'ASC')
                        ->get();

                        break;    

                case 'tweet-storms': 
                    $tweets = DB::table('posts')
                    ->select('*')
                    ->whereIn('id', function ($query) {
                        $query->select(DB::raw('MIN(id)'))
                        ->from('posts')
                        ->groupBy('post_type_code');
                    })
                    ->where('twitter_id', $id)
                    ->where('sched_time', '>', TwitterHelper::now(Auth::id()))
                    ->where('post_type', '=','tweet-storm-tweets')
                    ->orderBy('sched_time', 'ASC')
                    ->orderBy('sched_method', 'DESC')
                    ->get();
                    break;    
            }       
            // dd($tweets);
            return response()->json($tweets);
            // if ($tweets) {
            //     return response()->json(['status' => 200, 'message' => 'No tweets found', 'data' => $tweets]);
            // } else {
            //     return response()->json(['status' => 200, 'message' => 'No tweets found']);
            // }
        } catch (Exception $e) {
            $trace = $e->getTrace();
            $message = $e->getMessage();            
            // Handle the error
            // Log or display the error message along with file and line number
            return response()->json(['status' => '500', 'error' => $trace, 'message' => $message]);
        }
        
    }   
    
    public function getDatesByDayOfWeek($dayOfWeek, $month, $year)
    {
        $dates = [];

        $date = Carbon::createFromDate($year, $month, 1)->startOfMonth();

        while ($date->month == $month) {
            if ($date->isoFormat('dddd') == $dayOfWeek) {
                $dates[] = $date->copy();
            }
            $date->addDay();
        }

        return $dates;
    }

    public function postNowFromQueue(Request $request, $id)
    {    
        try {            
            // Find the post based on the provided ID
            $post_id = str_replace('post-now-', '', $id);
            $post = CommandModule::findOrFail($post_id);

            if ($post) {
                $getToken = TwitterHelper::getTwitterToken($request->twitter_id);            
                $twitterMeta = $getToken->toArray();
                $twitter_meta = $twitterMeta[0];

                // check access tokenW
                $this->tweet2twitter($twitter_meta, array('text' => urldecode($post->post_description)), "https://api.twitter.com/2/tweets");
            }
            
            //get time now 
            $utc = TwitterHelper::now(Auth::id());
            $datetime = $utc->format('Y-m-d H:i:s'); // save this to database for custom slot initially       

            // Update the desired fields with the request data
            $post->sched_method = 'send-now';
            $post->sched_time = $datetime;            
            
            // // Save the changes to the database
            $post->save();                                
            
            return response()->json(['status' => 200, 'message' => 'Post tweeted successfully!']);

        } catch (Exception $e) {
            $trace = $e->getTrace();
            $message = $e->getMessage();            
            // Handle the error
            // Log or display the error message along with file and line number
            return response()->json(['status' => '500', 'error' => $trace, 'message' => $message]);
        }
        
    }

    public function duplicateFromQueue(Request $request, $id)
    {  
        try {      
            $post_id = str_replace('duplicate-now-', '', $id);
            $post = CommandModule::whereNotIn('post_type', ['evergreen', 'promos', 'tweetstorms'])->findOrFail($post_id);
        
            // Duplicate the data
            $newRow = $post->replicate();
            // $newRow->save();

            // Optionally, you can modify any specific values before saving the new row
            $newRow->post_type_code = rand(10000, 99999);
            $newRow->save();

            // Redirect or return a response
            // ...
            return response()->json(['status' => 200, 'message' => 'Post duplicated successfully!']);

        } catch (Exception $e) {
            $trace = $e->getTrace();
            $message = $e->getMessage();            
            // Handle the error
            // Log or display the error message along with file and line number
            return response()->json(['status' => '500', 'error' => $trace, 'message' => $message]);
        }    
    }

    public function moveTopFromQueue(Request $request, $id) {
        try {
            // dd($id);
            $post_id = str_replace('move-top-', '', $id);
            $post = CommandModule::whereNotIn('post_type', ['evergreen', 'promos', 'tweetstorms'])->findOrFail($post_id);
           
            $nearestPost = CommandModule::whereNotIn('post_type', ['evergreen', 'promos', 'tweetstorms'])
                ->where('twitter_id', $request->twitter_id)
                ->where('sched_time', '>', TwitterHelper::now(Auth::id()))
                ->orderBy('sched_time', 'ASC')
                ->first();
            
            if ($nearestPost) {
                // dd($nearestPost->sched_time, $nearestPost->sched_method);
                $post->sched_time = $nearestPost->sched_time;
                $post->sched_method = 'rush-queue';
                $post->save();
            }
    
            // Return a response indicating success
            return response()->json(['status' => 200, 'message' => 'Sched time updated successfully']);    

        } catch (Exception $e) {
            $trace = $e->getTrace();
            $message = $e->getMessage();            
            // Handle the error
            // Log or display the error message along with file and line number
            return response()->json(['status' => '500', 'error' => $trace, 'message' => $message]);
        }    
    }


    // API to post and retweet to twitter
    function tweet2twitter($twitter_meta, $data, $endpoint) {

        // check access token
        $checkIfTokenExpired = TwitterHelper::isTokenExpired($twitter_meta['expires_in'], strtotime($twitter_meta['updated_at']), $twitter_meta['refresh_token'], $twitter_meta['access_token'], $twitter_meta['twitter_id']);  

        // send tweet
        $headers = array(
            'Authorization: Bearer ' . $checkIfTokenExpired['token'],
            'Content-Type: application/json'
        );

        $data = json_encode($data);
        
        $sendTweetNow = $this->apiRequest($endpoint, $headers, 'POST', $data );

        if ($sendTweetNow) {
            return response()->json(['status' => 200, 'message' => 'Your tweet has been posted']);
        } else {
            return response()->json(['status' => 500, 'message' => 'Failed to send tweet', 'data' => $sendTweetNow]);
        }
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

}
