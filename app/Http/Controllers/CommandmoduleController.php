<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommandModule;
use Illuminate\Support\Facades\Auth;
use Exception;


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
        dd($request);
        try {
            $insert = CommandModule::insert([
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

    public function promoTweets($post_type) {
        dd('test');
    } 
}
