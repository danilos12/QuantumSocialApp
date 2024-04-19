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

class dashboardController extends Controller
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
		$title = 'Dashboard page';		
		
		
		$checkRole = MembershipHelper::tier($this->setDefaultId());

    $user = User::find($checkRole->user_id);	
		
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