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

        if(Auth::guard('member')->check()){
            $user = Members::find(Auth::guard('member')->user()->id);

        }else{
            $user = User::find($this->setDefaultId());
        }


		$countPosts = CommandModule::where('user_id', $this->setDefaultId())->count();
		$countHashtagGroups = Tag_groups::where('user_id', $this->setDefaultId())->count();
		$countXaccts = UT_AcctMngt::where('user_id', $this->setDefaultId())->count();
		$countTeamMembers = Members::where('account_holder_id', $this->setDefaultId())->where('role', 'Member')->count();
		$countAdmin = Members::where('account_holder_id',$this->setDefaultId())->where('role', 'Admin')->count();
		$countTrial = QuantumAcctMeta::where('user_id', $this->setDefaultId())->first();
        // dd($user->email);
        return view('dashboard')->with([
			'title' => $title,
			'plan' => $checkRole,
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
