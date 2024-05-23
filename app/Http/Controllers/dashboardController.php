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
use App\Models\Twitter;
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
    public function index(Request $request)
    {
      $title = 'Dashboard';

      // $isNewUser = !$request->session()->has('onboard_done') && !$request->session()->has('onboard_later');
      // if ($isNewUser) {
      //     $onboardingModalHtml = view('modals.onboard')->render();
      // } else {
      //     $onboardingModalHtml = '';
      // }
      

      $checkRole = MembershipHelper::tier($this->setDefaultId());
      $user = User::find($checkRole->user_id);

      $countPosts = CommandModule::where('user_id', $this->setDefaultId())->whereMonth('created_at', now()->month)->count();
      // $countPosts = 20000;
      // $countPosts = strlen((string)$countPosts);
      // dd($countPosts);
      $countHashtagGroups = Tag_groups::where('user_id', $this->setDefaultId())->count();
      $countXaccts = Twitter::where('user_id', $this->setDefaultId())->count();
      $countTeamMembers = Members::where('account_holder_id', $this->setDefaultId())->where('role', 'Member')->count();
      $countAdmin = Members::where('account_holder_id', $this->setDefaultId())->where('role', 'Admin')->count();

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

    public function privacyPolicy()
    {
      $title = 'Privacy Policy';
        return view('privacy')->with('title', $title);
    }

    public function onboarded(Request $request) {

      if ($request->input('data') === 'onboard_done') {      
        DB::table('user_onboard')->where('user_id', $this->setDefaultId())->update(['onboarded' => 1]);
        return response()->json(['status' => 'success', 'message' => 'onboard done']);
      } else {
        $request->session()->put('onboard_later', true);
        return response()->json(['status' => 'success', 'message' => 'onboard later']);
      }     
    }

    public function checkOnboard(Request $request) {

      $check = DB::table('user_onboard')->where('user_id', $this->setDefaultId())->first();
      
      if ($check->onboarded === 0 && !$request->session()->has('onboard_later')) {
        $html = view('modals.onboard')->render();
        return response()->json(['status' => 200, 'message' => 'Onboard modal showing.', 'html' => $html]);
        // return view('dashboard', compact('onboarding'));
      } else if ($check->onboarded === 0 && $request->session()->has('onboard_later')) { 
        return response()->json(['status' => 200, 'message' => 'Onboard modal showed but until next session.']);
      }
      else {
        return response()->json(['status' => 200, 'message' => 'Onboard modal already done.']);
      }
      
    }

}
