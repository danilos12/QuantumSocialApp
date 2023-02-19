<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CampaignsController extends Controller
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
		$title = 'Promo Tweets';
        return view('promo-tweets')->with('title', $title);
    }
	
	 public function promo_tweets()
    {
		$title = 'Promo Tweets';
        return view('promo-tweets')->with('title', $title);
    }
	
	 public function evergreen_tweets()
    {
		$title = 'Evergreen Tweets';
		$slug = 'evergreen-tweets';
        return view('evergreentweets')->with('title', $title)->with('slug', $slug);
    }
	
	public function tweet_storms()
    {
		$title = 'Tweet Storms';
        return view('tweetstorms')->with('title', $title);
    }
	
	public function tag_groups()
    {
		$title = 'Tag Groups';
        return view('tags-groups')->with('title', $title);
    }
	
}
