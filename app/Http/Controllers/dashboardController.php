<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommandModule;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;


class dashboardController extends Controller
{
      /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware(['web', 'session_expired']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
		$title = 'Dashboard page';
        $hasRegularTweetsInQueue = CommandModule::where('sched_method', 'add-queue')
		->where('post_type', 'regular-tweets')
		->exists();
        // dd($hasRegularTweetsInQueue);
        $hasCustomSlot = Schedule::where('user_id', Auth::id())->get();  
        // dd($hasCustomSlot);   

		return view('dashboard', ['title' => $title, 'hasRegularTweetsInQueue' => $hasRegularTweetsInQueue]);
        // return view('dashboard')->with('title', $title);
    }
    
    public function help()
    {
		$title = 'Help page';
        return view('help')->with('title', $title);
    }
	
}