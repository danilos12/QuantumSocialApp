<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\CommandModule;
use App\Models\Bulk_post;
use App\Models\Bulk_meta;
use App\Models\Tag_groups;
use App\Models\Tag_items;
use App\Models\TwitterToken;
use Carbon\Carbon;
use Carbon\CarbonTimeZone;
use App\Helpers\TwitterHelper;
use App\Helpers\MembershipHelper;
use App\Models\QuantumAcctMeta;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


// use DateTime;
// use Date;
// use Illuminate\Support\Facades\Log;
// use Illuminate\Support\Facades\Session;


class CommandmoduleController extends Controller
{
       /**
     * Create a new controller instance.
     *
     * @return void
     */
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
        if (Auth::guard('member')->check() && Auth::guard('member')->user()->role == 'Admin') {
            return $this->defaultid = MembershipHelper::membercurrent();
        }
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

        $checkRole = MembershipHelper::tier($this->setDefaultId());
        
        $postCredit = $checkRole->mo_post_credits === -1 ? 'unli' : $checkRole->mo_post_credits; 

        $postCount = DB::table('posts')
            ->where('user_id', $this->setDefaultId())
            ->whereMonth('created_at', now()->month)
            ->count();

        $trialCredit = DB::table('users_meta')
            ->where('user_id', $this->setDefaultId())
            ->value('trial_credits');

        $tokens = DB::table('settings_general_twapi')
            ->where('user_id',  $this->setDefaultId())
            ->first();

        if ($trialCredit == 0 && (!$tokens || !$tokens->api_key 
            || !$tokens->api_secret || !$tokens->bearer_token 
            || !$tokens->oauth_id || !$tokens->oauth_secret)) {
            return response()->json(['status' => 401, 'message' => 'Trial ended. Please input tokens'], 401);
        }

        if (is_int($postCredit) && $checkRole->mo_post_credits <= $postCount) {
            $html = view('modals.upgrade')->render();
            return response()->json(['status' => 402, 'message' => 'Post count limit reached.', 'html' => $html]);
        }

        $checkTwitter = DB::table('ut_acct_mngt')->where('user_id', $this->setDefaultId())->where('selected', 1)->first();

		if ($checkTwitter === null) {
			$message = 'You need to add your social media account first to proceed with your post queue.';
            return response()->json(['status' => 403, 'message' => 'Post is not possible, please connect your social media first.', 'html' => $message]);
		}

        try {
            $postData = $request->input('formData');
            $user_id = $this->setDefaultId();
            $main_twitter_id = $postData['twitter_id'];
            $getToken = TwitterHelper::getTwitterToken($main_twitter_id, $user_id);
            $twitter_meta = json_decode(json_encode($getToken), true); 

            $utc = Carbon::now('UTC');
            $url = isset($postData['retweet-link-input']) ? urldecode($postData['retweet-link-input']) : null;
            $tweet_id = basename(parse_url($url, PHP_URL_PATH));
            $checkToggle = QuantumAcctMeta::where('user_id', $this->setDefaultId())->first();
            $datetime = $utc->format('Y-m-d H:i:s'); // save this to database for custom slot initially
            $sched_method = null;
            $sched_time = $utc->format('Y-m-d H:i:s');

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
                'active' => ($postData['scheduling-options'] === 'send-now') ? 1 : $checkToggle->queue_switch,
                'social_media' => $postData['social_media'] // 1 => twitter, 2 => facebook, 3= instagram
            ];


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

                    case 'set-countdown':
                        $countDown = rtrim($postData['ct-set-countdown'], '/s');
                        $countDownWithWords = $postData['c-set-countdown'] . ' ' . $countDown;

                        // modify the UTC datetime object by adding the countdown time
                        $utcDatetime = $utc->modify($countDownWithWords);
                        
                        // format the resulting datetime object as a string in the  'YYYY-MM-DD HH:MM:SS' format
                        $scheduled_time = $utcDatetime->format('Y-m-d H:i:s');
                        $sched_time = $scheduled_time;
                        break;

                    case 'custom-time':
                        $timezoned = DB::table('users_meta')
                            ->where('user_id', $this->setDefaultId())
                            ->first();

                        $localTimeZone = new CarbonTimeZone($timezoned->timezone);

                        $date = $postData['ct-time-date'];
                        $hour = $postData['ct-hour'];
                        $minute = $postData['ct-min'];
                        $amPm = $postData['ct-am-pm'];

                        $dateTimeString = "$date $hour:$minute $amPm";
                        $dateTime = Carbon::createFromFormat('d-m-Y h:i A', $dateTimeString, $localTimeZone);
                        
                        // Convert to UTC
                        $utcDateTime = $dateTime->setTimezone('UTC');                        

                        // Format the DateTime object as a UTC string
                        $sched_time = $utcDateTime->format('Y-m-d H:i:s');

                        break;

                    case 'custom-slot':
                        $timezoned = DB::table('users_meta')
                            ->where('user_id', $this->setDefaultId())
                            ->first();

                        $localTimeZone = new CarbonTimeZone($timezoned->timezone);

                        $dateTime = Carbon::parse(urldecode($postData['custom-slot-datetime']), $localTimeZone);
                        
                        // Convert to UTC
                        $utcDateTime = $dateTime->setTimezone('UTC');                        

                        // Format the DateTime object as a UTC string
                        $sched_time = $utcDateTime->format('Y-m-d H:i:s');
                        break;

                    case 'rush-queue':
                        $count = DB::table('posts')
                            ->where('twitter_id', $main_twitter_id)
                            ->where('user_id', $user_id)
                            ->whereNotIn('sched_method', ['send-now', 'save-draft'])
                            ->count();

                        $firstTweet = DB::table('posts')
                            ->where('twitter_id', $main_twitter_id)
                            ->whereNotIn('sched_method', ['send-now', 'save-draft'])
                            ->where('sched_time', '>', TwitterHelper::now($user_id))
                            ->orderBy('sched_time', 'ASC')
                            ->first();

                            // dd($count, $firstTweet, $utc->modify($firstTweet->sched_time), $datetime);



                        $sched_time = ($count > 0) ? $firstTweet->sched_time : $datetime;
                        break;
                    case 'save-draft':
                        $sched_time = $utc->format('Y-m-d H:i:s');
                        $sched_method = 'save-draft';
                        break;
                }
            } else {
                $sched_time = $utc->format('Y-m-d H:i:s');
                $sched_method = 'save-draft';
            }

            // Save data for main account 
            // $responses = array();
            $messages = '';
            foreach ($postData['textarea'] as $textarea) {
                $insertData['post_description'] = $textarea;
                $insertData['sched_method'] = $sched_method;
                $insertData['sched_time'] = $sched_time;
                // $insertData['post_type'] = 'tweet-storm-tweets';


                // Post tweet if scheduling option is "send-now"
                if ($postData['scheduling-options'] === 'send-now') {
                    if ($postData['post_type_tweets'] === "retweet-tweets") {
                        $responses = TwitterHelper::tweet2twitter($twitter_meta, array('tweet_id' => $tweet_id), "https://api.twitter.com/2/users/" . $main_twitter_id . "/retweets");

                        if ($responses->getStatusCode() === 200) {
                            $insertData['active'] = 1;
                            CommandModule::create($insertData);
    
                            $messages = $responses->getOriginalContent()['message'] . ' and saved to database';
                            return response()->json(['status' => 200, 'stat' => 'success', 'message' => $responses->getOriginalContent()['message'] . ' and saved to database']);

                        } else {
                            return response()->json(['status' => $responses->getStatusCode(), 'stat' => 'warning', 'message' => $responses->getOriginalContent()['message']]);
                        }

                        // if ($responses->getOriginalContent()['status'] === 500) {
                        //     return response()->json(['status' => 500, 'stat' => 'warning', 'message' => $responses->getOriginalContent()['message'] . ' and saved to database']);
                        // } elseif ($responses->getOriginalContent()['status'] === 403) {
                        //     return response()->json(['status' => 403, 'stat' => 'warning', 'message' => $responses->getOriginalContent()['message']]);
                        // } else {
                        //     $insertData['active'] = 1;
                        //     CommandModule::create($insertData);

                        //     $messages = $responses->getOriginalContent()['message'] . ' and saved to database';
                        // }
                    }  else {
                        $responses = TwitterHelper::tweet2twitter($twitter_meta, array('text' => urldecode($textarea)), "https://api.twitter.com/2/tweets");

                        if ($responses->getStatusCode() === 200) {
                            $insertData['active'] = 1;
                            CommandModule::create($insertData);
    
                            $messages = $responses->getOriginalContent()['message'] . ' and saved to database';
                            return response()->json(['status' => 200, 'stat' => 'success', 'message' => $responses->getOriginalContent()['message'] . ' and saved to database']);
                            // dd($messages);
                        } else {
                            return response()->json(['status' => $responses->getStatusCode(), 'stat' => 'warning', 'message' => $responses->getOriginalContent()['message']]);
                        }
                        // if ($responses->getOriginalContent()['status'] === 500) {
                        //     return response()->json(['status' => 500, 'stat' => 'warning', 'message' => $responses->getOriginalContent()['message'] . ' and saved to database']);
                        // }  elseif ($responses->getOriginalContent()['status'] === 403) {
                        //     return response()->json(['status' => 403, 'stat' => 'warning', 'message' => $responses->getOriginalContent()['message']]);
                        // }else {
                        //     $insertData['active'] = 1;
                        //     CommandModule::create($insertData);

                        //     $messages = $responses->getOriginalContent()['message'] . ' and saved to database';
                        // }
                    }

                } else {
                    CommandModule::create($insertData);
                }

                // Save crosstweet data
                $crosstweetData = $insertData;
                if (!empty($postData['crosstweet'])) {
                    foreach ($postData['crosstweet'] as $key => $account) {
                        $crosstweetData['post_description'] = $textarea;

                        $crosstweetId = str_replace('twitterId-', '', $account);
                        $crosstweetData['twitter_id'] = $crosstweetId;
                        $crosstweetData['crosstweets_accts'] = $key;

                        $twitter_meta_cross = TwitterToken::where('twitter_id', $crosstweetId )->first();

                        // Post tweet if scheduling option is "send-now"
                        if ($postData['scheduling-options'] === 'send-now') {
                            if ($postData['post_type_tweets'] === "retweet-tweets") {
                                $responses = TwitterHelper::tweet2twitter($twitter_meta_cross, array('tweet_id' => $tweet_id), "https://api.twitter.com/2/users/" . $crosstweetId . "/retweets");
                            } else {
                                $responses = TwitterHelper::tweet2twitter($twitter_meta_cross, array('text' => urldecode($textarea)), "https://api.twitter.com/2/tweets");

                                if ($responses->getStatusCode() === 200) {
                                    CommandModule::create($crosstweetData);
                                    $messages = $responses->getOriginalContent()['message'] . ' and saved to database';
                                } else {
                                    return response()->json(['status' => 500, 'stat' => 'warning', 'message' => $responses->getOriginalContent()['message'] . ' and saved to database']);
                                }
                            }
                        } else {
                            CommandModule::create($crosstweetData);
                        }
                    }
                }
            }

            // Retrieve the last saved data
            $lastSavedData = CommandModule::latest()->first();


            if ($trialCredit) {
                $newTrialCredit = $trialCredit - 1;
                DB::table('users_meta')
                    ->where('user_id', $this->setDefaultId())
                    ->update(['trial_credits' => $newTrialCredit]);    
            }
            
            // Return success response
            return response()->json(['status' => 200, 'stat' => 'success',  'message' => 'Post has been created. ' . $messages, 'tweet' => $lastSavedData]);

        } catch (Exception $e) {
            $trace = $e->getTrace();
            $message = $e->getMessage();
            // Handle the error
            // Log or display the error message along with file and line number
            return response()->json(['status' => 500, 'error' => $trace, 'message' => $message, 'stat' => 'warning']);
        }

    }


    public function addTagGroup(Request $request) {

        $checkRole = MembershipHelper::tier($this->setDefaultId());

        if ($checkRole->status !== 1 || $checkRole->trial_counter < 1) {
            return response()->json(['status' => 500,  'stat' => 'warning', 'message' => 'Your account is inactive. Please update your payment to continue using the features.']);
        }

        $tagGroup = $checkRole->hashtag_group === -1 ? 'unli' : $checkRole->hashtag_group; 
    
        $tagCount = DB::table('tag_groups_meta')->where('user_id', $this->setDefaultId())->count();        

        if (is_int($tagGroup) && $checkRole->hashtag_group <= $tagCount) {
            $html = view('modals.upgrade')->render();
            return response()->json(['status' => 403, 'message' => 'Post count limit reached.', 'html' => $html]);
        }

        try {
            $insert = Tag_groups::create([
                'user_id' => Auth::id(),
                'twitter_id' => $request->input('twitter_id'),
                'tag_group_mkey' => "_" . strtolower(str_replace(' ', '_', $request->input('myInput'))), //add underscore in the beginner always
                'tag_group_mvalue' => $request->input('myInput'),
            ]);

            if ($insert) {
                // Return success response
                return response()->json(['status' => 200,  'stat' => 'success', 'data' => $insert, 'message' => 'Tag group added successfully']);
            }

        } catch (Exception $e) {
            return response()->json(['status' => '400', 'message' => $e]);
        }

    }

    public function removeTagGroup(Request $request)
    {                
        try {            
            $tagGroupId = $request->input('tag_group_id');

            $tagGroup = Tag_groups::find($tagGroupId);

            if (!$tagGroup) {
                return response()->json([ 'stat' => 'warning', 'message' => 'Tag group not found'], 404);
            }

            $tagGroup->delete();

            return response()->json([ 'stat' => 'success', 'message' => 'Tag group removed successfully'], 200);
        } catch (Exception $e)  {
            return response()->json(['status' => '500', 'message' => $e]);

        }
    }

    public function addTagItem(Request $request) {
        try {            
            $insert = Tag_items::create([
                'user_id' => $this->setDefaultId(),
                'twitter_id' => $request->input('twitter_id'),
                'tag_meta_key' => $request->input('tag_id'),
                'tag_meta_value' => $request->input('hashtag'),
            ]);

            if ($insert) {
                return response()->json(['status' => 200, 'hashtag' => $insert]);
            }
        } catch (Exception $e)  {
            return response()->json(['status' => '500', 'message' => $e]);

        }

    }

    public function removeTagItem(Request $request) {
        try {            
            $tagItemId = $request->input('tag_group_id');

            $tagItem = Tag_items::where('tag_meta_value', $tagItemId);
    
            if (!$tagItem) {
                return response()->json([ 'stat' => 'warning', 'message' => 'Tag item not found'], 404);
            }
    
            $tagItem->delete();
    
            return response()->json([ 'stat' => 'success', 'message' => 'Tag item removed successfully', 'item_removed' => $tagItemId], 200);    
        } catch (Exception $e)  {
            return response()->json(['status' => '500', 'message' => $e]);

        }

    }

    public function getTagGroups($id) {

        
        // for hashtag Groups no twitter linked
        $checkTwitter = MembershipHelper::twitterAcct(auth()->id()); 
        if ($checkTwitter < 1) {
            return response()->json(['stat' => 'warning', 'status' => 500, 'message' => 'Your account is not linked to any X accounts, please add one in the general settings to proceed.' ]);
        }

        $checkRole = MembershipHelper::tier($this->setDefaultId()); 

        $tagGroups = Tag_groups::where('user_id', $this->setDefaultId())->count();
        $tagGroupsPerX = Tag_groups::where(['user_id' => $this->setDefaultId(), 'twitter_id' => $id])->get();        
        
        // // 2 < 2 && 1 < 2                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        $tagGroups, $tagGroupsPerX);
        // if (count($tagGroups) < $checkRole->hashtag_group && count($tagGroupsPerX) < count($tagGroups) ) {
        //     return response()->json(['stat' => 'warning', 'status' => 500, 'message' => 'huhuhu' ]);
        // };

        try {
            return response()->json(['tagGroups' => $tagGroupsPerX, 'status' => 200]);
        }  catch (Exception $e) {
            return response()->json(['status' => 400, 'message' => $e]);
        }
    }

    public function getTagItems(Request $request) {
        try {            
            $twitterId = $request->input('twitter_id');
            $tagId = $request->input('tag_id');

            if ($request->input('copy')) {
                // Fetch tag items from the database
                $tagItems = Tag_items::where(['twitter_id' => $twitterId, 'tag_meta_key' => $tagId])->get();

                // Count the number of tag items
                $tagItemCount = $tagItems->count();

                $tags = ''; // Initialize variable to store tag items

                // Check if there are any tag items before looping
                if ($tagItemCount > 0) {
                    // Loop through each tag item and concatenate them into a string
                    foreach ($tagItems as $tagItem) {
                        $tags .= '#' . $tagItem->tag_meta_value . ' '; // Assuming tag_meta_value contains the tag value
                    }

                    // Return response with tag items
                    return response()->json(['stat' => 'success', 'tags' => $tags, 'message' => 'Tags are copied to your clipboard.', 'status' => 200]);
                } else {
                    // No tag items found, handle accordingly
                    return response()->json(['stat' => 'warning', 'message' => 'No tag items found.', 'status' => 402]);
                }

            } else {
                $tagItems = Tag_items::where(['twitter_id' => $twitterId, 'tag_meta_key' => $tagId])->get();
                return response()->json($tagItems);
            };

        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => 'Error getting the tags']);
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

    public function getCustomSlot(Request $request) {
        try {

            $getCustomSlot = DB::table('schedule')
                            ->join('days', 'days.day', '=', 'schedule.slot_day')
                            ->select('schedule.*', 'days.*')
                            ->where('user_id', Auth::id())
                            ->where('schedule.post_type', $request->post_type)
                            ->orderBy('days.id', 'ASC')
                            ->get();
            // dd($getCustomSlot);
        } catch(Exception $e) {
            $trace = $e->getTrace();
            $message = $e->getMessage();
            // Handle the error
            // Log or display the error message along with file and line number
            return response()->json(['status' => '500', 'error' => $trace, 'message' => $message]);
        }

        return response()->json($getCustomSlot);
    }

    public function getTweetsUsingPostTypes(Request $request, $id, $post_type) {

        try {
            $tweets = '';
            $type = ($request->input('category')) ? (($request->input('category') === 'type') ? 'type' : 'month') : '';
            
            $timezoned = DB::table('users_meta')
                        ->where('user_id', $this->setDefaultId())
                        ->first();

            switch ($post_type) {
                case 'posted':
                    $currentDateTime = Carbon::now($timezoned->timezone);                    
                    

                    $posts = DB::table('posts')
                        ->where('twitter_id', $id)
                        ->where('sched_time', '<', TwitterHelper::now(Auth::id()))
                        // ->where('active', 1)
                        ->where('sched_method', 'send-now')
                        ->get();
                  
                    $tweets = $posts->map(function($tweet) use($timezoned) {
                        $tweet->sched_time = Carbon::createFromFormat('Y-m-d H:i:s', $tweet->sched_time, 'UTC')
                                                    ->setTimezone($timezoned->timezone)
                                                    ->format('Y-m-d H:i:s');
                        return $tweet;
                    })->sortBy('sched_time')->values()->toArray();

                    break;

                case 'save-draft':
                    $posts = CommandModule::where(['twitter_id' => $id, 'sched_method' => $post_type])->get();

                    
                    $tweets = $posts->map(function($tweet) use($timezoned) {
                        $tweet->sched_time = Carbon::createFromFormat('Y-m-d H:i:s', $tweet->sched_time, 'UTC')
                                                    ->setTimezone($timezoned->timezone)
                                                    ->format('Y-m-d H:i:s');
                        return $tweet;
                    })->sortBy('sched_time')->values()->toArray();

                    break;

                case 'queue':
                    $timezoned = DB::table('users_meta')
                                ->where('user_id', $this->setDefaultId())
                                ->first();
                    // dd(TwitterHelper::now($this->setDefaultId()));

                    $posts = DB::table('posts')
                            ->select('*')
                            // ->whereIn('id', function ($query) {
                            //     $query->select(DB::raw('MIN(id)'))
                            //     ->from('posts')
                            //     ->groupBy('post_type_code');
                            // })
                            ->where('twitter_id', $id)
                            ->where('user_id', $this->setDefaultId())
                            // ->where('sched_time', '>=', TwitterHelper::now($this->setDefaultId()))
                            ->where('posts.post_type', '!=','evergreen-tweets')
                            ->where('posts.post_type', '!=','promos-tweets')
                            // ->when($type, function ($query) use ($type, $request) {
                            //     if ($type === 'month') {
                            //         return $query->whereRaw("DATE_FORMAT(sched_time, '%b-%Y') = ?", $request->input('type'));
                            //     } else {
                            //         return $query->whereRaw("posts.post_type = ?", $request->input('type'));
                            //     }

                            //     return $query;
                            // })
                            ->orderBy('sched_time', 'ASC')
                            ->orderBy('sched_method', 'DESC')
                            ->get();

                            // dd($posts, $id, $this->setDefaultId());

                    $schedules = Schedule::where('user_id', $this->setDefaultId())->get();

                    // if (count($schedules) > 0) {

                        $recurringDates = [];
    
                        foreach ($schedules as $schedule) {
                            $dayOfWeek = Carbon::parse($schedule->slot_day)->dayOfWeek;
                            $time = Carbon::parse($schedule->hour . ':' . $schedule->minute_at . ' ' . $schedule->ampm);
    
                            // $startDate = Carbon::create($currentYear, $currentMonth)->startOfMonth()->subMonths(2);
                            // $endDate = Carbon::create($currentYear, $currentMonth)->endOfMonth();
                            $startDate = Carbon::now()->startOfMonth();
                            $endDate = Carbon::now()->addMonths(1)->endOfMonth();
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
                        // dd($mergedData);
                        $currentDateTime = Carbon::now($timezoned->timezone);
                        // dd($currentDateTime);
                        $tweetSorted = collect($mergedData)->filter(function ($tweet) use ($currentDateTime) {
                            // dd($currentDateTime->timezone);
                            $dateTime = Carbon::createFromFormat('Y-m-d H:i:s', $tweet->sched_time, 'UTC')->setTimezone($currentDateTime->timezone);
                            $tweetDateTime = Carbon::parse($dateTime);
                            // dd($tweetDateTime);
    
                           
                            return $tweetDateTime->greaterThan($currentDateTime);
                        });
        

                        $tweets = $tweetSorted->map(function($tweet) use($timezoned) {
                            
                            // Convert sched_time to +08:00 timezone
                            // if ($tweet->sched_method === 'set-countdown' || $tweet->sched_method === 'rush-queue') {
                            $tweet->sched_time = Carbon::createFromFormat('Y-m-d H:i:s', $tweet->sched_time, 'UTC')
                                                        ->setTimezone($timezoned->timezone)
                                                        ->format('Y-m-d H:i:s');
                            //     return $tweet; 
                            // } else {
                                return $tweet;
                            // }
                        })->sortBy('sched_time')->values()->toArray();
    
                        
                        // $tweets = $tweetSorted->sortBy('sched_time')->values()->toArray();
                        // dd($tweets);
                    // } else {
                    //     $tweets = $posts;
                    // }

                    break;

                case 'evergreen':
                    $tweets = DB::table('posts')
                        ->select('*')
                        ->where('twitter_id', $id)
                        // ->whereIn('id', function ($query) {
                        //     $query->select(DB::raw('MIN(id)'))
                        //     ->from('posts')
                        //     ->groupBy('post_type_code');
                        // })
                        // ->where('sched_time', '>', TwitterHelper::now(Auth::id()))
                        // ->where('active', $checkToggle->queue_switch)
                        ->where('post_type', '=','evergreen-tweets')
                        ->orderByRaw('CASE WHEN sched_time < ? THEN 1 ELSE 0 END', TwitterHelper::now($this->setDefaultId()))
                        ->orderBy('sched_time', 'ASC')
                        ->orderBy('sched_method', 'DESC')
                        ->orderBy('updated_at', 'ASC')
                        ->get();
                        break;


                case 'promo':
                    $tweets = DB::table('posts')
                        ->select('*')
                        ->where('twitter_id', $id)
                        // ->whereIn('id', function ($query) {
                        //     $query->select(DB::raw('MIN(id)'))
                        //     ->from('posts')
                        //     ->groupBy('post_type_code');
                        // })
                        // ->where('sched_time', '>', TwitterHelper::now(Auth::id()))
                        // ->where('active', $checkToggle->queue_switch)
                        ->where('post_type', '=','promos-tweets')
                        ->orderByRaw('CASE WHEN sched_time < ? THEN 1 ELSE 0 END', TwitterHelper::now($this->setDefaultId()))
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
                        ->where('sched_time', '>', TwitterHelper::now($this->setDefaultId()))
                        ->where('post_type', '=','tweet-storm-tweets')
                        ->orderBy('sched_time', 'ASC')
                        ->orderBy('sched_method', 'DESC')
                        ->get();
                    break;
                case 'bulk-queue':
                    $tweets = DB::table('bulk_post')
                        ->leftJoin('twitter_accts', 'bulk_post.twitter_id', '=', 'twitter_accts.twitter_id')
                        ->leftJoin('bulk_meta', 'bulk_post.link_url', '=', 'bulk_meta.link_url')
                        ->select(
                            'bulk_post.*',
                            'twitter_accts.twitter_name as xname',
                            'twitter_accts.twitter_photo as xphoto',
                            'twitter_accts.twitter_username as xusername',
                            'bulk_meta.meta_title as meta_title',
                            'bulk_meta.meta_description as meta_description',
                            'bulk_meta.meta_image as meta_image'
                        )
                        ->where([
                            ['bulk_post.twitter_id', '=', $id],
                            ['bulk_post.user_id', '=', $this->setDefaultId()],
                            ['bulk_post.post_type', '=', 'regular-tweets'],
                            ['bulk_post.sched_method', '=', 'bulk-queue']
                        ])
                        ->orderBy('bulk_post.sched_time', 'ASC')
                        ->get();

                        // dd($tweets->toSql());
                    break;
            }

            if ($tweets) {
                // return response()->json(['status' => 200, 'data' => $tweets]);
                return response()->json($tweets);
            } else {
                return response()->json(['status' => 204, 'message' => 'No tweets found']);
            }
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

    public function postNowFromQueue(Request $request)
    {
        try {
            // Find the post based on the provided ID
            $post_id = str_replace('postNow-', '', $request->input('post'));
            $post = CommandModule::findOrFail($post_id);

            if ($post) {
                $getToken = TwitterHelper::getTwitterToken($request->input('twitter_id'), $this->setDefaultId());
                $twitter_meta = json_decode(json_encode($getToken), true); 

                // check access tokenW
                TwitterHelper::tweet2twitter($twitter_meta, array('text' => urldecode($post->post_description)), "https://api.twitter.com/2/tweets");
            }

            //get time now
            $utc = TwitterHelper::now($this->setDefaultId());
            $datetime = $utc->format('Y-m-d H:i:s'); // save this to database for custom slot initially

            // Update the desired fields with the request data
            $post->sched_method = 'send-now';
            $post->sched_time = $datetime;

            // // Save the changes to the database
            $post->save();

            return response()->json(['status' => 200, 'stat' => 'success', 'message' => 'Post tweeted successfully!']);

        } catch (Exception $e) {
            $trace = $e->getTrace();
            $message = $e->getMessage();
            // Handle the error
            // Log or display the error message along with file and line number
            return response()->json(['status' => '500', 'stat' => 'warning', 'error' => $trace, 'internal_message' => $message, 'message' => 'Error when posting to Twitter']);
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

    public function upload(Request $request) {

        if ($request->hasFile('csv_file')) {

            $validator = Validator::make($request->all(), [
                'csv_file' => 'required|mimes:csv,txt|max:10240', // Adjust max file size as needed
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
            }

            $monthMap = [
                'January' => 1, 'Jan' => 1, 'February' => 2, 'Feb' => 2, 'March' => 3, 'Mar' => 3,
                'April' => 4, 'Apr' => 4, 'May' => 5, 'June' => 6, 'Jun' => 6,
                'July' => 7, 'Jul' => 7, 'August' => 8, 'Aug' => 8, 'September' => 9, 'Sep' => 9,
                'October' => 10, 'Oct' => 10, 'November' => 11, 'Nov' => 11, 'December' => 12, 'Dec' => 12
            ];

            $path = $request->file('csv_file')->getRealPath();
            $csvData = file_get_contents($path);
            $lines = explode("\n", $csvData);
            $header = str_getcsv(array_shift($lines)); // Extract header
            $errorRows = [];
            $error= [];

            $allowedHosts = ['example.com', 'another-example.com']; // Replace with your allowed hosts

            foreach ($lines as $index => $line) {
                $values = str_getcsv($line);
                if (count($values) !== count($header)) {
                    // Skip rows with mismatched number of columns
                    $errorRows[] = $index + 1; // Record the row number with missing values
                    continue;
                }

                $record = array_combine($header, $values); // Combine header and data

                // Convert month name to numeric value if needed
                if (isset($record['month']) && array_key_exists($record['month'], $monthMap)) {
                    $record['month'] = $monthMap[$record['month']];
                }

                
                $validator = Validator::make($record, [
                    'post_description' => 'required',
                    'year' => 'required|digits:4',
                    'month' => 'required|digits_between:1,2|between:1,12', // Ensure month is between 1 and 12
                    'day' => 'required',
                    'hour' => 'required|between:1,23', // Assuming hour is in 24-hour format, restrict between 1 and 23
                    'minute' => 'required|digits:2|between:0,59', // Minutes should be between 0 and 59  
                    // 'hour' => 'required|digits:1|between:1,23', // Assuming hour is in 24-hour format, restrict between 1 and 23
                    // 'minute' => 'required|digits:2|between:0,59', // Minutes should be between 0 and 59
                    // 'image_url' => [
                    //     Rule::requiredIf(function () use ($record) {
                    //         return empty($record['link_url']) && empty($record['image_url']); // image_url is required if both image_url and link_url are empty
                    //     }),
                    // ],
                    // 'link_url' => [
                    //     Rule::requiredIf(function () use ($record) {
                    //         return empty($record['image_url']); // link_url is required if image_url is empty
                    //     }),
                    // ],
                    'image_url' => [
                        'required_without_all:link_url',
                        function ($attribute, $value, $fail) {
                            if (!$this->endsWith($value, ['.png', '.jpg'])) {
                                $fail("The $attribute must be a URL ending with .png or .jpg.");
                            }
                        },
                    ],
                    'link_url' => [
                        'required_without_all:image_url',
                        'url',
                        function ($attribute, $value, $fail) use ($record) {
                            if (!empty($record['image_url'])) {
                                $fail("The $attribute must not have a value if image_url is provided.");
                            }
                            // Custom validation rule to check if URL has a domain
                            if (!$this->isValidDomainUrl($value)) {
                                $fail("The $attribute must be a valid URL with a domain.");
                            }
                        },
                    ],

                ]);

                if ($validator->fails()) {
                    // Handle validation errors for each row
                    // For example, log errors or store them in an array to display later
                    // $error[] = $validator->errors()->all();
                    $error[$index + 1] = $validator->errors()->all();
                }
            }


            if (!empty($error)) {
                return response()->json(['status' => 402, 'errors' => $error]);
            } else {

                $file = $request->file('csv_file');
                $csvData = $this->parse($file);

                $monthMap = [
                    'January' => 1, 'Jan' => 1, 'February' => 2, 'Feb' => 2, 'March' => 3, 'Mar' => 3,
                    'April' => 4, 'Apr' => 4, 'May' => 5, 'June' => 6, 'Jun' => 6,
                    'July' => 7, 'Jul' => 7, 'August' => 8, 'Aug' => 8, 'September' => 9, 'Sep' => 9,
                    'October' => 10, 'Oct' => 10, 'November' => 11, 'Nov' => 11, 'December' => 12, 'Dec' => 12
                ];

                foreach ($csvData as $key => $data) {

                    // Convert month name to numeric value if needed
                    if (isset($data['month']) && array_key_exists($data['month'], $monthMap)) {
                        $data['month'] = $monthMap[$data['month']];
                    }
                    
                   // Validation passed, save the data to the database
                    $timestamp = mktime($data['hour'], $data['minute'], '00', $data['month'], $data['day'], $data['year']);
                    $formattedDateTime = date("Y-m-d H:i:s", $timestamp);

                    $insertData = Bulk_post::create([
                        'user_id' => Auth::id(),
                        'twitter_id' => $request->input('twitter_id'),
                        'post_type' => 'regular-tweets',
                        'post_description' => $data['post_description'],
                        'sched_method' => 'bulk-queue',
                        'sched_time' => $formattedDateTime,
                        'link_url' => $data['link_url'],
                        'image_url' => $data['image_url'],
                    ]);

                    // Create Bulk_meta record if it doesn't exist
                    if ($insertData['link_url'] !== '') {
                        $findMeta = Bulk_meta::where('link_url', $insertData['link_url'])->first();
                        if (!$findMeta) {
                            $metaTags = $this->scrapeMetaTags($data['link_url']);
                            $metaData = [
                                'meta_title' => $metaTags['og:title'] || $metaTags['og:site_name'],
                                'meta_description' => $metaTags['og:description'],
                                'meta_image' => $metaTags['og:image'],
                                'link_url' => $data['link_url'],
                            ];
                            Bulk_meta::create($metaData);
                        }
                    }

                }

                return response()->json(['status' => 200, 'message' =>'Bulk posts and meta details are saved successfully.']);
            }

        } else {
            return  response()->json(['status' => 500, 'message' => 'No CSV file found']);
        }

    }

    protected function endsWith($haystack, $needles) {
        foreach ((array) $needles as $needle) {
            if ($needle !== '' && substr($haystack, -strlen($needle)) === $needle) {
                return true;
            }
        }
        return false;
    }

    protected function isValidDomainUrl($url) {
        // Check if the URL has a valid domain
        return preg_match('/^(https?:\/\/)?([\da-z.-]+)\.([a-z.]{2,6})([\/\w .-]*)*\/?$/', $url);
    }

    function scrapeMeta(Request $request) {
        $findMeta = Bulk_meta::where('link_url', $request->input('url'))->first();

        if ($findMeta) {
            $metaTags = $this->scrapeMetaTags($request->input('url'));

            $defaultImage = env('APP_URL') . '/public/ui-images/default_og.jpg';

            $findMeta->update([
                'meta_title' => $metaTags['og:title'] ?? 'Default Title',
                'meta_description' => $metaTags['og:description'] ?? 'Default Description',
                'meta_image' => $metaTags['og:image'] ?? $defaultImage,
            ]);

            return response()->json([
                'status' => 200,
                'message' => 'Meta tags updated successfully',
            ]);
        }

        return response()->json([
            'status' => 500,
            'message' => 'Meta tags not found',
        ]);

    }


    function scrapeMetaTags($url) {
        // Fetch the HTML content of the URL
        $html = file_get_contents($url);

        // Create an array to store the meta tags
        $metaTags = array();

        // Use a regular expression to match meta tags
        preg_match_all('/<meta\s+([^>]*?)\s*\/?>/i', $html, $matches);

        // Loop through the matches and extract the meta tag attributes
        foreach ($matches[1] as $match) {
            // Use a regular expression to match the attribute name and value
            preg_match('/\b(?:name|property|http-equiv)="([^"]*)"\s+content="([^"]*)"/i', $match, $attributes);

            // If the attribute name and value are found, add them to the meta tags array
            if (isset($attributes[1]) && isset($attributes[2])) {
                $metaTags[$attributes[1]] = $attributes[2];
            }
        }

        // Return the meta tags array
        return $metaTags;
    }

    private function parse($p) {

        // Open the CSV file
        $fileHandle = fopen($p, 'r');

        // Initialize an empty array to store the parsed CSV data
        $parsedCsvData = [];

        // Read the first row (header row) and discard it
        $headerRow = fgetcsv($fileHandle);

        // Loop through each remaining row
        while (($row = fgetcsv($fileHandle)) !== false) {
            // Combine the header row and the current row into an associative array
            $rowData = array_combine($headerRow, $row);

            // Use the first column as the array key
            $key = $row[0];

            // Add the row data to the parsed CSV data array using the first column as the key
            $parsedCsvData[$key] = $rowData;
        }


        // Close the file
        fclose($fileHandle);
        return $parsedCsvData;
    }

}
