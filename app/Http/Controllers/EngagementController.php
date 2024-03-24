<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EngagementController extends Controller
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

  
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
		$title = 'Engage';
        return view('engage')->with('title', $title);
    }

	 public function c_engage()
    {
		$title = 'Engage';
        return view('engage')->with('title', $title);
    }

	 public function c_mentions()
    {
		$title = 'Mentions';
        return view('mentions')->with('title', $title);
    }

	public function c_user_feeds()
    {
		$title = 'User Feeds';
        return view('user-feeds')->with('title', $title);
    }

	public function c_user_lists()
    {
		$title = 'User Lists';
        return view('user-lists')->with('title', $title);
    }

	public function c_hashtag_feeds()
    {
		$title = 'Hashtag Feeds';
        return view('hashtag-feeds')->with('title', $title);
    }


}
