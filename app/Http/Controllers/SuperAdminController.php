<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controller;
use Illuminate\View\Factory as ViewFactory;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\CommandModule;
use App\Models\Schedule;
use Illuminate\Support\Facades\Cache;
use App\Helpers\MembershipHelper;
use App\Models\Members;
use App\Models\QuantumAcctMeta;
use App\Models\Tag_groups;
use App\Models\Twitter;
use App\Models\UT_AcctMngt;
use Illuminate\Support\Facades\Session;



class SuperAdminController extends Controller
{
    private $view;

    public function __construct(ViewFactory $view)
    {
        $this->view = $view;
        $this->middleware('unauthorized');
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
        
        
        $title = 'Super Admin Data';    
        return view('super-admin')->with(['title' => $title]);
    }
	
    public function getAllOwners()
    {
		
        $title = 'Account Owners';      
        
        
        $getAll = DB::table('users')
        ->join('users_meta', 'users.id', '=', 'users_meta.user_id')
        ->join('plans', 'users_meta.subscription_id', '=', 'plans.subscription_id')
        ->get();        

        
        return view('su-admin.owners')->with(['title' => $title, 'getAll' => $getAll]);
    }
	
	public function getAllAdmins()
    {
        $title = 'Admins';      
        
        $getAll = DB::table('users')
        ->join('users_meta', 'users.id', '=', 'users_meta.user_id')
        ->join('plans', 'users_meta.subscription_id', '=', 'plans.subscription_id')
        ->get();        

        
        return view('su-admin.admin')->with(['title' => $title, 'getAll' => $getAll]);
    }	

	public function getAllMembers()
    {
        $title = 'Members';      
        
        $getAll = DB::table('members')
        // ->join('users_meta', 'users.id', '=', 'users_meta.user_id')
        // ->join('plans', 'users_meta.subscription_id', '=', 'plans.subscription_id')
        ->get();        

        return view('su-admin.members', ['title' => $title, 'getAll' => $getAll]);
        
        // return view('super-admin')->with(['title' => $title, 'getAll' => $getAll]);
    }	
	
    public function getAllPlans()
    {
        $title = 'Plans';      
        
        $getAll = DB::table('plans')
        // ->join('users_meta', 'users.id', '=', 'users_meta.user_id')
        // ->join('plans', 'users_meta.subscription_id', '=', 'plans.subscription_id')
        ->get();        

        
        return view('su-admin.plans')->with(['title' => $title, 'getAll' => $getAll]);
    }	

    public function phpInfo() {
        dd(phpinfo());
    }

    public function guideTest() {
        $title = 'Dashboard';

        // $isNewUser = !$request->session()->has('onboard_done') && !$request->session()->has('onboard_later');
        // if ($isNewUser) {
        //     $onboardingModalHtml = view('modals.onboard')->render();
        // } else {
        //     $onboardingModalHtml = '';
        // }
        
  
        $checkRole = MembershipHelper::tier(Auth::id());
        $user = User::find($checkRole->user_id);
  
        $countPosts = CommandModule::where('user_id', Auth::id())->whereMonth('created_at', now()->month)->count();
        // $countPosts = 20000;
        // $countPosts = strlen((string)$countPosts);
        // dd($countPosts);
        $countHashtagGroups = Tag_groups::where('user_id', Auth::id())->count();
        $countXaccts = Twitter::where('user_id', Auth::id())->count();
        $countTeamMembers = Members::where('account_holder_id', Auth::id())->where('role', 'Member')->count();
        $countAdmin = Members::where('account_holder_id', Auth::id())->where('role', 'Admin')->count();
  
        $countTrial = QuantumAcctMeta::where('user_id', Auth::id())->first();
  
        return view('dashboard2')->with([
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
}
