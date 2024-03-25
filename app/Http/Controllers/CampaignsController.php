<?php

namespace App\Http\Controllers;
use App\Models\CommandModule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Helpers\MembershipHelper;
class CampaignsController extends Controller
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
		$title = 'Promo Tweets';
        $userId = $this->setDefaultId(); //To check current user loggedin User ID dria
        $hasRegularTweetsInQueue = CommandModule::where('user_id', $userId)
        ->where('sched_method', 'add-queue')
        ->where('post_type', 'regular-tweets')
        ->exists();
		return view('promo', ['title' => $title, 'hasRegularTweetsInQueue' => $hasRegularTweetsInQueue]);
        // return view('promo-tweets')->with('title', $title);
    }

	 public function promo_tweets()
    {
		$title = 'Promo Tweets';
        $userId = $this->setDefaultId(); //To check current user loggedin User ID dria
        $hasRegularTweetsInQueue = CommandModule::where('user_id', $userId)
        ->where('sched_method', 'add-queue')
        ->where('post_type', 'regular-tweets')
        ->exists();
		return view('promo-tweets', ['title' => $title, 'hasRegularTweetsInQueue' => $hasRegularTweetsInQueue]);
        // return view('promo-tweets')->with('title', $title);
    }

	 public function evergreen_tweets()
    {
		$title = 'Evergreen Tweets';
		$slug = 'evergreen-tweets';
        $userId = $this->setDefaultId(); //To check current user loggedin User ID dria
        $hasRegularTweetsInQueue = CommandModule::where('user_id', $userId)
        ->where('sched_method', 'add-queue')
        ->where('post_type', 'regular-tweets')
        ->exists();
		return view('evergreentweets', ['title' => $title, 'hasRegularTweetsInQueue' => $hasRegularTweetsInQueue]);
        // return view('evergreentweets')->with('title', $title)->with('slug', $slug);
    }

	public function tweet_storms()
    {
		$title = 'Tweet Storms';
        // $userId = Auth::id(); //To check current user loggedin User ID dria
        // $hasRegularTweetsInQueue = CommandModule::where('user_id', $userId)
        // ->where('sched_method', 'add-queue')
        // ->where('post_type', 'regular-tweets')
        // ->exists();
		// return view('tweetstorms', ['title' => $title, 'hasRegularTweetsInQueue' => $hasRegularTweetsInQueue]);
        return view('tweetstorms')->with('title', $title);
    }

	public function tag_groups()
    {
     


		$title = 'Tag Groups';
        $userId = $this->setDefaultId(); //To check current user loggedin User ID dria
        $hasRegularTweetsInQueue = CommandModule::where('user_id', $userId)
        ->where('sched_method', 'add-queue')
        ->where('post_type', 'regular-tweets')
        ->exists();
		return view('tags-groups', ['title' => $title, 'hasRegularTweetsInQueue' => $hasRegularTweetsInQueue]);


    }

}