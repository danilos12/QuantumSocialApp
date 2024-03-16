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
use App\Helpers\TwitterHelper;
use App\Helpers\MembershipHelper;
use App\Models\QuantumAcctMeta;
use App\Models\Schedule;
use App\Models\User;

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

        $checkRole = MembershipHelper::tier(Auth::id());

        // Check the count of posts in the database for your subscription
        $postCount = DB::table('posts')
            ->where('user_id', Auth::id())
            ->count();

        // Add the limitation: run the code only if the count of posts is less than 5
        if ($checkRole->mo_post_credits > $postCount) {
            try {
                $postData = $request->input('formData');
                $user_id = Auth::id();
                $main_twitter_id = $postData['twitter_id'];
                $getToken = TwitterHelper::getTwitterToken($main_twitter_id);
                // $twitterMeta = $getToken->toArray();
                $twitter_meta = $getToken->toArray();
                $utc = TwitterHelper::now($user_id);
                $url = isset($postData['retweet-link-input']) ? urldecode($postData['retweet-link-input']) : null;
                $tweet_id = basename(parse_url($url, PHP_URL_PATH));
                $checkToggle = QuantumAcctMeta::where('user_id', Auth::id())->first();
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
                    'active' => $checkToggle->queue_switch
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
                            $utcFormat = $utc->modify($countDownWithWords);

                            // format the resulting datetime object as a string in the  'YYYY-MM-DD HH:MM:SS' format
                            $scheduled_time = $utcFormat->format('Y-m-d H:i:s');
                            $sched_time = $scheduled_time;
                            break;

                        case 'custom-time':
                            // Refactor this section to reduce duplication
                            // dd($postData);
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
                // $responses;
                foreach ($postData['textarea'] as $textarea) {
                    $insertData['post_description'] = $textarea;
                    $insertData['sched_method'] = $sched_method;
                    $insertData['sched_time'] = $sched_time;

                    // $insertData['post_type'] = 'tweet-storm-tweets';


                    // // Post tweet if scheduling option is "send-now"
                    if ($postData['scheduling-options'] === 'send-now') {
                        if ($postData['post_type_tweets'] === "retweet-tweets") {
                            $responses = $this->tweet2twitter($twitter_meta, array('tweet_id' => $tweet_id), "https://api.twitter.com/2/users/" . $main_twitter_id . "/retweets");
                        }  else {
                            $responses = $this->tweet2twitter($twitter_meta, array('text' => urldecode($textarea)), "https://api.twitter.com/2/tweets");
                        }

                        if ($responses->getOriginalContent()['status'] === 500) {
                            return response()->json(['status' => 500, 'message' => $responses->getOriginalContent()['message'] . ' and saved to database']);
                        } else {
                            CommandModule::create($insertData);
                            return response()->json(['status' => 200, 'message' => $responses->getOriginalContent()['message'] . ' and saved to database']);
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
        else {
            // Return a response indicating that the limitation has been reached
            $html = view('modals.upgrade')->render();
            return response()->json(['status' => 403, 'message' => 'Post count limit reached.', 'html' => $html]);
        }
    }


    public function addTagGroup(Request $request) {
        $checkRole = MembershipHelper::tier(Auth::id());

        $tagCount = DB::table('tag_groups_meta')
            ->where('user_id', Auth::id())
            ->count();

        if ($checkRole->hashtag_group > $tagCount ) {
            try {
                $insert = Tag_groups::create([
                    'user_id' => Auth::id(),
                    'twitter_id' => $request->input('twitter_id'),
                    'tag_group_mkey' => "_" . strtolower(str_replace(' ', '_', $request->input('myInput'))), //add underscore in the beginner always
                    'tag_group_mvalue' => $request->input('myInput'),
                ]);

                if ($insert) {
                    // Return success response
                    return response()->json(['status' => 200, 'data' => $insert, 'message' => 'Tag group added successfully']);
                }

            } catch (Exception $e) {
                return response()->json(['status' => '400', 'message' => $e]);
            }
        } else {
            // Return a response indicating that the limitation has been reached
            $html = view('modals.upgrade')->render();
            // return view('modals.upgrade', compact('showUpgradeModal'));
            return response()->json(['status' => 403, 'message' => 'Post count limit reached.', 'html' => $html]);
        }
    }

    public function addTagItem(Request $request) {
        try {
            $insert = Tag_items::create([
                'user_id' => Auth::id(),
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

            // dd($getUnselectedTwitter);

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

    public function getTweetsUsingPostTypes(Request $request, $id, $post_type) {
        try {
            $tweets = '';
            $type = ($request->input('category')) ? (($request->input('category') === 'type') ? 'type' : 'month') : '';

            switch ($post_type) {
                case 'posted':
                    // dd(TwitterHelper::now(Auth::id()));
                    $tweets = DB::table('posts')
                        ->where('twitter_id', $id)
                        // ->where('sched_time', '<', TwitterHelper::now(Auth::id()))
                        ->where('active', 1)
                        ->where('sched_method', 'send-now')
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
                            ->when($type, function ($query) use ($type, $request) {
                                if ($type === 'month') {
                                    return $query->whereRaw("DATE_FORMAT(sched_time, '%b-%Y') = ?", $request->input('type'));
                                } else {
                                    return $query->whereRaw("posts.post_type = ?", $request->input('type'));
                                }

                                return $query;
                            })
                            ->orderBy('sched_time', 'ASC')
                            ->orderBy('sched_method', 'DESC')
                            ->get();

                    $schedules = Schedule::where('user_id', Auth::id())->get();

                    $recurringDates = [];
                    $r = [];
                    $currentMonth = now()->month;
                    $currentYear = now()->year;
                    // dd($posts, $r, $currentMonth, $currentYear);

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
                case 'bulk-queue':
                    $tweets = DB::table('bulk_post')
                        ->leftJoin('twitter_accts', 'bulk_post.user_id', '=', 'twitter_accts.user_id')
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
                            ['bulk_post.user_id', '=', Auth::id()],
                            ['bulk_post.post_type', '=', 'regular-tweets'],
                            ['bulk_post.sched_method', '=', 'bulk-queue']
                        ])
                        ->orderBy('bulk_post.sched_time', 'ASC')
                        ->get();

                        // dd($tweets);
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
                $getToken = TwitterHelper::getTwitterToken($request->input('twitter_id'));
                // $twitterMeta = $getToken->toArray();

                // check access tokenW
                $this->tweet2twitter($getToken, array('text' => urldecode($post->post_description)), "https://api.twitter.com/2/tweets");
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
            // 'Authorization: Bearer ' . 11,
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

    public function upload(Request $request)
    {
		if ($request->hasFile('csv_file')) {
            // get the file
			$file = $request->file('csv_file');

            // parse the data in csv
			$csvData = $this->parse($file);

            // after getting the data from the csv, parse first the link to get the meta details, then add it into the database
            foreach ($csvData as $key => $data) {
                $timestamp = mktime($data['hour'], $data['minute'], '00', $data['month'], $data['day'], $data['year']);
                // Format the timestamp as desired
                $formattedDateTime = date("Y-m-d H:i:s", $timestamp);

                $insertData = Bulk_post::create([
                    'user_id' =>  Auth::id(),
                    'twitter_id' => $request->input('twitter_id'),
                    'post_type' => 'regular-tweets',
                    'post_description' => $data['post_description'],
                    'sched_method' => 'bulk-queue',
                    'sched_time' => $formattedDateTime,
                    'link_url' => isset($data['link_url']) ? $data['link_url'] : null,
                    'image_url' => isset($data['image_url']) ? $data['image_url'] : null,
                ]);

                if ($insertData) {
                    // Check if the record already exists
                    $findMeta = Bulk_meta::where('link_url', $insertData['link_url'])->first();

                    if (!$findMeta) {
                        // The record does not exist, so scrape the meta tags
                        $metaTags = $this->scrapeMetaTags($data['link_url']);

                        $metaData = [
                            'meta_title' => $metaTags['og:title'],
                            'meta_description' => $metaTags['og:description'],
                            'meta_image' => $metaTags['og:image'],
                            'link_url' => $data['link_url'],
                        ];

                        // Create a new record in the database
                        Bulk_meta::create($metaData);

                    }
                }

            }

            return response()->json(['message' => 'CSV data saved successfully'], 200);
        } else {
            return response()->json(['message' => 'No file uploaded'], 400);
        }

        return redirect()->back()->with('message', 'CSV file uploaded and processed successfully.');
    }

    function scrapeMeta(Request $request) {
        $findMeta = Bulk_meta::where('link_url', $request->input('url'))->first();

        if ($findMeta) {
            $metaTags = $this->scrapeMetaTags($request->input('url'));

            $findMeta->update([
                'meta_title' => $metaTags['og:title'],
                'meta_description' => $metaTags['og:description'],
                'meta_image' => $metaTags['og:image'],
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
