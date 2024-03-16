<?php

namespace App\Http\Controllers\MemberController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\MembershipHelper;
use App\Models\Tag_groups;
class MemberCommandmodule extends Controller
{
    public function __constructor(){
        $this->middleware('member-access');
    }


    public function index()
    {
        $title = 'Command Module';
        $userId = MembershipHelper::membercurrent();
        $hasRegularTweetsInQueue = CommandModule::where('user_id', $userId)
            ->where('sched_method', 'add-queue')
            ->where('post_type', 'regular-tweets')
            ->exists();

        return view('commandmodule', ['title' => $title, 'hasRegularTweetsInQueue' => $hasRegularTweetsInQueue]);
    }


    public function create(Request $request) {

        $checkRole = MembershipHelper::tier(MembershipHelper::membercurrent());

        // Check the count of posts in the database for your subscription
        $postCount = DB::table('posts')
            ->where('user_id', MembershipHelper::membercurrent())
            ->count();

        // Add the limitation: run the code only if the count of posts is less than 5
        if ($checkRole->mo_post_credits > $postCount) {
            try {
                $postData = $request->input('formData');
                $user_id = MembershipHelper::membercurrent();
                $main_twitter_id = $postData['twitter_id'];
                $getToken = TwitterHelper::getTwitterToken($main_twitter_id);
                // $twitterMeta = $getToken->toArray();
                $twitter_meta = $getToken->toArray();
                $utc = TwitterHelper::now($user_id);
                $url = isset($postData['retweet-link-input']) ? urldecode($postData['retweet-link-input']) : null;
                $tweet_id = basename(parse_url($url, PHP_URL_PATH));
                $checkToggle = QuantumAcctMeta::where('user_id', MembershipHelper::membercurrent())->first();
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
        $checkRole = MembershipHelper::tier(MembershipHelper::membercurrent());

        $tagCount = DB::table('tag_groups_meta')
            ->where('user_id', MembershipHelper::membercurrent())
            ->count();

        if ($checkRole->hashtag_group > $tagCount ) {
            try {
                $insert = Tag_groups::create([
                    'user_id' => MembershipHelper::membercurrent(),
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
                'user_id' => MembershipHelper::membercurrent(),
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

               $userid =  MembershipHelper::membercurrent();


            $tagGroups = Tag_groups::where(['user_id' => $userid, 'twitter_id' => $id])->get();

            return response()->json([$tagGroups]);
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
                ->where('ut_acct_mngt.user_id', "=", MembershipHelper::membercurrent())
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
                            ->where('user_id', MembershipHelper::membercurrent())
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



}
