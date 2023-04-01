<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controller;
use App\Http\Controllers\TwitterApi;
use Illuminate\Support\Facades\View;
use Illuminate\View\Factory as ViewFactory;
use Illuminate\Support\Facades\Auth;
use App\Models\UT_AcctMngt;
use App\Models\Twitter;


class ProfileController extends Controller
{
    private $view;

    public function __construct(ViewFactory $view)
    {
        $this->view = $view;
    }
   /**
     * Create a new controller instance.
     *
     * @return void
     */   
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
		$title = 'Profile page';

        // $info = UT_AcctMngt::where(['user_id' => Auth::id(), 'selected' => 1])->first();

        $tweets = [];
        // if ($info) {
            
        //     $twitterApi = new TwitterApi();
        //     $tweets = $twitterApi->getTweets($info->twitter_id);
        // } else {
        //     $tweets = [];
        // }

        // dd($tweets);

        return view('profile', ['title' => $title, 'tweets' => $tweets]);
    }
	
	public function edit_password()
    {
		$title = 'Edit Password';
        return view('change-password')->with('title', $title);
    }
	
	public function updatePassword(Request $request)
{
        # Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);


        #Match The Old Password
        if(!Hash::check($request->old_password, auth()->user()->password)){
            return back()->with("error", "Old Password Doesn't match!");
        }


        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with("status", "Password changed successfully!");
	}

}
