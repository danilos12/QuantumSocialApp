<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\url_decode;
use Exception;
use App\Models\CommandModule;
use Illuminate\Support\Facades\DB;
use App\Models\Tag_groups;
use App\Models\Tag_items;


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
        try {            
            $postData = $request->all();
            $user_id = Auth::id();
            $main_twitter_id = $postData['twitter_id'];

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
                'sched_time' => $postData['scheduling-cdmins'] ?? null,          
                'post_type_code' => rand(10000, 99999),
            ];
            CommandModule::create($insertData);

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
                }
            }

            // Return success response
            return response()->json(['status' => '201', 'message' => 'Data has been created.']);

        } catch (Exception $e) {
            Log::error('Error creating data: ' . $e->getMessage());
            return response()->json(['status' => '409', 'error' => 'Failed to create data.']);
   
        }
    }

    // public function promoTweets($post_type) {
    //     dd('test');
    // } 
    
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

    public function getUnselectedTwitterAccounts(Request $request) {

        $getUnselectedTwitter = DB::table('twitter_accts')
                ->join('ut_acct_mngt', 'twitter_accts.twitter_id', '=', 'ut_acct_mngt.twitter_id')
                ->select('twitter_accts.*', 'ut_acct_mngt.*')
                ->where('ut_acct_mngt.selected', "=", 0) // selected
                ->where('ut_acct_mngt.user_id', "=", Auth::id())
                ->where('twitter_accts.deleted', "=", 0)
                ->get();

        return response()->json($getUnselectedTwitter);
    }
}
