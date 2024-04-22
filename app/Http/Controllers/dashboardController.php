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
            $this->middleware('unauthorized');

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
    $user = User::find($checkRole->user_id);	

    // check if subscription is active
    // if ($checkRole->status !== 1 && $checkRole->trial_counter < 1) {
		// 	$message = 'Your account is inactive. Please update your payment to continue using the features.';
		// 	return view('dashboard', compact('message', 'title', 'user', 'countPosts', 'countXaccts', 'countHashtagGroups', 'countAdmin', 'countTeamMembers', 'countTrial'));
    //         // return response()->json(['status' => 500, 'stat' => 'warning', 'message' => 'Your account is inactive. Please update your payment to continue using the features.']);
    // }

		
		$countPosts = CommandModule::where('user_id', $this->setDefaultId())->whereMonth('created_at', now()->month)->count();
		$countHashtagGroups = Tag_groups::where('user_id', $this->setDefaultId())->count();		
		$countXaccts = UT_AcctMngt::where('user_id', $this->setDefaultId())->count();
		$countTeamMembers = Members::where('account_holder_id', $this->setDefaultId())->where('role', 'Member')->count();	
		$countAdmin = DB::table('users')
            ->join('members', 'members.account_holder_id', '=', 'users.id')
            ->where('members.account_holder_id', $this->setDefaultId())
            ->count();         
            
		$countTrial = QuantumAcctMeta::where('user_id', $this->setDefaultId())->first();
		
    return view('dashboard')->with([
			'title' => $title, 
			'plan' => $checkRole ?? '', 
			'user' => $user, 
			'countPosts' => $countPosts, 
			'countXaccts' => $countXaccts, 
			'countHashtagGroups' => $countHashtagGroups, 
			'countAdmin' => ($countAdmin === 0) ? 1 : $countAdmin + 1,
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
