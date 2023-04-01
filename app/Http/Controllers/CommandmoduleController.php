<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            $insert = CommandModule::create([
                'user_id' => Auth::id(),
                'twitter_id' => $request->input('twitter_id'),
                'post_type' => $request->input('post_type_tweets'),
                'post_description' => $request->input('tweet_text_area'),
                'tweetlink' => $request->input('tweetlink'),
                'rt_time' => $request->input('num-custom-cm'),
                'rt_frame' => $request->input('time-custom-cm'),
                'rt_ite' => $request->input('iterations-custom-cm'),
                'promo_id' => $request->input('promo_id'),
                'sched_method' => $request->input('scheduling-method'),
                'sched_time' => $request->input('scheduling-cdmins'),
            ]);
    
            if ($insert) {
                // Return success response
                return response()->json(['status' => '201', 'message' => 'Data has been created.']);
            } else {
                // Return error response
                return response()->json(['status' => '400', 'message' => 'Bad request']);
            }

        } catch (Exception $e) {
            return response()->json(['status' => '409', 'error' => $e]);
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
        $tagGroups = Tag_groups::where(['user_id' => Auth::id(), 'twitter_id' => $id])->get();
        // $tagItems = Tag_items::where(['user_id' => Auth::id(), 'twitter_id' => $id])->get();

        // $getTag = DB::table('tag_groups_meta')
        //     ->join('tag_items_meta', 'tag_groups_meta.twitter_id', '=', 'tag_items_meta.twitter_id')
        //     ->select('tag_groups_meta.tag_group_mkey', 'tag_items_meta.tag_meta_key')
        //     ->where('tag_groups_meta.tag_group_mkey', "=", "tag_1")
        //     ->where('tag_items_meta.tag_meta_key', "=", "_tag_1")
        //     ->orWhere('tag_items_meta.tag_meta_key', "=", "tag_1")
        //     ->first();

        return response()->json($tagGroups);
    }
    
    public function getTagItems(Request $request) {
        $twitterId = $request->input('twitter_id');
        $tagId = $request->input('tag_id');

        $tagItems = Tag_items::where(['twitter_id' => $twitterId, 'tag_meta_key' => $tagId])->get();
        return response()->json($tagItems);
    }
}
