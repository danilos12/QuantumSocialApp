<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommandModule;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use App\Helpers\MembershipHelper;
use App\Models\Members;
use App\Models\QuantumAcctMeta;
use App\Models\Tag_groups;
use App\Models\UT_AcctMngt;
use Illuminate\Support\Facades\Session;

class dashboardController extends Controller
{
      /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $defaultid;
    public function __construct()
    {
        if (Auth::guard('web')->check()) {
            $this->middleware('auth');

        }
        if(Auth::guard('member')->check()) {

            $this->middleware('member-access');


        }
        if(!Session::has('user_id') || !Session::has('user_email')) {

            $this->middleware('auth');


        }





    }

    protected function setDefaultId()
    {
        if (Auth::guard('web')->check()) {
            return $this->defaultid = Auth::id();
        }
        if (Auth::guard('member')->check()) {
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
		$title = 'Dashboard page';


		$checkRole = MembershipHelper::tier($this->setDefaultId());

<<<<<<< HEAD
		
		$user = User::find(Auth::id());	
		
		$countPosts = CommandModule::where('user_id', Auth::id())->count();
		$countHashtagGroups = Tag_groups::where('user_id', Auth::id())->count();		
		$countXaccts = UT_AcctMngt::where('user_id', Auth::id())->count();
		$countTeamMembers = Members::where('account_holder_id', Auth::id())->where('role', 'Member')->count();	
		$countAdmin = Members::where('account_holder_id', Auth::id())->where('role', 'Admin')->count();
		$countTrial = QuantumAcctMeta::where('user_id', Auth::id())->first();
		
    return view('dashboard')->with([
			'title' => $title, 
			'plan' => $checkRole ?? '', 
			'user' => $user, 
			'countPosts' => $countPosts, 
			'countXaccts' => $countXaccts, 
			'countHashtagGroups' => $countHashtagGroups, 
=======

		$user = User::find($this->setDefaultId());

		$countPosts = CommandModule::where('user_id', $this->setDefaultId())->count();
		$countHashtagGroups = Tag_groups::where('user_id', $this->setDefaultId())->count();
		$countXaccts = UT_AcctMngt::where('user_id', $this->setDefaultId())->count();
		$countTeamMembers = Members::where('account_holder_id', $this->setDefaultId())->where('role', 'Member')->count();
		$countAdmin = Members::where('account_holder_id',$this->setDefaultId())->where('role', 'Admin')->count();
		$countTrial = QuantumAcctMeta::where('user_id', $this->setDefaultId())->first();
        // dd($checkRole,$user);
        return view('dashboard')->with([
			'title' => $title,
			'plan' => $checkRole,
			'user' => $user,
			'countPosts' => $countPosts,
			'countXaccts' => $countXaccts,
			'countHashtagGroups' => $countHashtagGroups,
>>>>>>> main
			'countAdmin' => $countAdmin,
			'countTeamMembers' => $countTeamMembers,
			'countTrial' => $countTrial->trial_counter
		]);
    }

    public function help()
    {
		$title = 'Help page';
        return view('help')->with('title', $title);
    }

}
