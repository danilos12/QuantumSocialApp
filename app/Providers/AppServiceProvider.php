<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\TwitterToken;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Twitter;
use App\Models\User;
use DateTime;
use DateTimeZone;
use App\Helpers\TwitterHelper;
use App\Helpers\MembershipHelper;
use App\Models\TwitterSettings;
use Illuminate\Support\Facades\Route;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // share to all views
        View::composer('*', function ($view) {

            if (Auth::guard('web')->check()) {

                // to show no tweets found if 0 in general settings
                $count = Twitter::where(['user_id' => auth()->id(), 'deleted' => 0])->count();
                $view->with('acct_twitter_count', $count);

                $twitter = Twitter::where(['user_id' => auth()->id(), 'deleted' => 0])->get();

                // to loop all the twitter accts
                $view->with('twitter_accts', $twitter);

                $selectedUser = DB::table('twitter_accts')
                    ->join('ut_acct_mngt', 'twitter_accts.twitter_id', '=', 'ut_acct_mngt.twitter_id')
                    ->select('twitter_accts.*', 'ut_acct_mngt.*')
                    ->where('ut_acct_mngt.selected', "=", 1) // selected
                    ->where('ut_acct_mngt.user_id', "=", Auth::id())
                    ->where('twitter_accts.deleted', "=", 0)
                    ->first();

                $view->with('selected_user', $selectedUser);

                $token = TwitterToken::where(['user_id' => Auth::id(), 'twitter_id' => $selectedUser->twitter_id ?? 0 ])->first();
                if ($token) {
                    $view->with('refresh_token', $token->refresh_token ?? "");
                }

                $twitterID = $selectedUser->twitter_id ?? 0;
                $view->with('twitter_id', $twitterID);
                $view->with('twitter_name', $selectedUser->twitter_name ?? "");
                $view->with('twitter_usn', $selectedUser->twitter_username ?? "");
                $view->with('twitter_photo', $selectedUser->twitter_photo ?? "");
                $view->with('user_id', Auth::id());

                $individualTwitterApi = DB::table('settings_twitter_twapi')
                            ->select('*')
                            ->where('user_id', Auth::id())
                            ->first();
                $view->with('individualTwitterApi', $individualTwitterApi);

                // timezone
                $timezones = DB::table('timezones')->get();
                $view->with('timezones', $timezones);

                // retrieve timezone
                $mainUser = DB::table('users')
                            ->join('users_meta', 'users.id', '=', 'users_meta.user_id')
                            ->where('users.id', Auth::id())->first();
                $view->with('mainUser', $mainUser);


                // general settings sliders
                $generalSettings = DB::table('settings_general')->where('user_id', Auth::id())->first();
                $view->with('generalSetting', $generalSettings);

                // twitter settings DB
                $twitterSettings = DB::table('settings_twitter')
                                ->join('settings_twitter_meta', 'settings_twitter.twitter_id', '=', 'settings_twitter_meta.twitter_id')
                                ->join('ut_acct_mngt', 'settings_twitter.twitter_id', '=', 'ut_acct_mngt.twitter_id')
                                ->select('settings_twitter.*', 'ut_acct_mngt.selected', 'settings_twitter_meta.*')
                                ->where('settings_twitter.twitter_id', '=', $twitterID)
                                ->first();
                $view->with('twitterSetting', $twitterSettings);

                // API inside General settings
                $twitterApiMaster = DB::table('settings_general_twapi')
                        ->join('users', 'users.id', 'settings_general_twapi.user_id')
                        ->select('*')
                        ->where('users.id', Auth::id())
                        ->first();


                // Update the API data with the encrypted values
                // $twitterApiMaster->api_key = $encryptedApiKey;
                // $twitterApiMaster->api_secret = $encryptedApiSecret;
                $view->with('twitterApiMaster', $twitterApiMaster);

                // API inside General settings
                $twitterApiIndiv = DB::table('settings_twitter_twapi')
                        ->join('users', 'users.id', 'settings_twitter_twapi.user_id')
                        ->select('*')
                        ->where('users.id', Auth::id())
                        ->first();
                $view->with('twitterApiIndiv', $twitterApiIndiv);

                // membership
                $membership = DB::table('users_meta')->where('user_id', Auth::id())->first();
                $view->with('membership', $membership);

                $toggle = DB::table('users_meta')->where('user_id', Auth::id())->first();

                // membership
                $membership = DB::table('users_meta')->where('user_id', Auth::id())
                        ->join('plans', 'users_meta.subscription_id', 'plans.subscription_id')
                        ->first();
                // dd($membership);
                $view->with('membership', $membership);

                $toggle = DB::table('users_meta')->where('user_id', Auth::id())->first();
                $currentRoute = Route::current()->uri;
                if ($currentRoute === 'evergreen' || $currentRoute === 'promo' || $currentRoute === 'queue') {
                    $view->with('toggle', $toggle->{$currentRoute . '_switch'});
                } else {
                    $view->with('toggle', 0);
                }

                $getMembers = DB::table('members')
                ->join('users', 'members.account_holder_id', '=', 'users.id')
                ->select('users.*', 'members.*')
                ->where('members.account_holder_id', Auth::id())
                ->get();
                $view->with('team_members', $getMembers);




                $xmembersaccess = DB::table('members')
            ->select('members.*')
            ->where('members.account_holder_id', Auth::id())
            ->get();


            $xmembersaccessII = DB::table('member_xaccount')
            ->select('member_xaccount.*')
            ->where('member_xaccount.user_id', Auth::id())
            ->when(isset($selectedUser->twitter_id), function ($query) use ($selectedUser) {
                return $query->where('member_xaccount.mtwitter_id', $selectedUser->twitter_id);
            }, function ($query) {
                return $query->where('member_xaccount.mtwitter_id', 0);
            })
            ->get();





                $view->with('xmembersaccess', $xmembersaccess);
                $view->with('idscheck', $xmembersaccessII);




                $cntMembers = DB::table('members')
                    ->join('users', 'members.account_holder_id', '=', 'users.id')
                    ->select('users.*', 'members.*')
                    ->where('members.account_holder_id', Auth::id())
                    ->count();
                $view->with('cntmembers', $cntMembers);

                $hasRegularTweetsInQueue = DB::table('posts')
                    ->where('user_id', Auth::id())
                    ->where('sched_time', '>', TwitterHelper::now(Auth::id()))
                    ->where('post_type', 'regular-tweets')
                    ->exists();

                $view->with('hasRegularTweetsInQueue', $hasRegularTweetsInQueue);

                $checkRole = MembershipHelper::tier(Auth::id());

                $view->with('product_id', $checkRole->subscription_id);


                $hasCustomSlot = DB::table('schedule')
                    ->where('user_id', Auth::id())
                    ->get();
                $view->with('hasCustomSlot', $hasCustomSlot);



            }




            // formembers auth
             if (Auth::guard('member')->check()) {
                $user = Auth::guard('member')->user();
                $member_id = $user->id;


                $acct_hdid = DB::table('members')
                ->where('id', $member_id)
                ->value('account_holder_id');


                // $account_holder_idsss = 123123;

                // $view->with('acct_idss', $acct_hdid);
                // $view->with('memberid', $member_id);


                // to show no tweets found if 0 in general settings
                $count = Twitter::where(['user_id' => $acct_hdid, 'deleted' => 0])->count();
                $view->with('acct_twitter_count', $count);


                // to loop all the twitter accts





                $myid = Auth::guard('member')->user()->id;

                $memberxaccounts = DB::table('member_xaccount')
                    ->select('member_xaccount.mtwitter_id', 'member_xaccount.selected')
                    ->where('member_xaccount.member_id', $myid)
                    ->get();

                $mtwitterIds = $memberxaccounts->pluck('mtwitter_id')->toArray();
                $selectedstatus = $memberxaccounts->pluck('selected')->toArray();

                $twxaccts = DB::table('twitter_accts')
                    ->select('twitter_accts.*')
                    ->where('twitter_accts.user_id', $acct_hdid)
                    ->whereIn('twitter_accts.twitter_id', $mtwitterIds)
                    ->get();

                // Combining selected status with twxaccts

                $view->with('memberaccts', $twxaccts);


                $selectedUserObject = [];
                foreach ($twxaccts as $key => $twxacct) {
                    if ($selectedstatus[$key] == 1) { // Check if selected status is 1
                        $twxacct->selected = $selectedstatus[$key];
                        $selectedUserObject[] = $twxacct;
                    }
                }
                $selectedUser = reset($selectedUserObject);
                // $selectedUser = DB::table('twitter_accts')
                //     ->join('ut_acct_mngt', 'twitter_accts.twitter_id', '=', 'ut_acct_mngt.twitter_id')
                //     ->select('twitter_accts.*', 'ut_acct_mngt.*')
                //     ->where('ut_acct_mngt.selected', "=", 1)
                //     ->where('ut_acct_mngt.user_id', "=", $acct_hdid)
                //     ->where('twitter_accts.deleted', "=", 0)
                //     ->first();


                $view->with('selected_user', $selectedUser);

                $token = TwitterToken::where(['user_id' => $acct_hdid, 'twitter_id' => $selectedUser->twitter_id ?? 0 ])->first();
                if ($token) {
                    $view->with('refresh_token', $token->refresh_token ?? "");
                }

                $twitterID = $selectedUser->twitter_id ?? 0;

                $view->with('twitter_id', $twitterID);



                $view->with('twitter_name', $selectedUser->twitter_name ?? "");
                $view->with('twitter_usn', $selectedUser->twitter_username ?? "");
                $view->with('twitter_photo', $selectedUser->twitter_photo ?? "");
                $view->with('user_id', Auth::guard('member')->user()->id);





















                $individualTwitterApi = DB::table('settings_twitter_twapi')
                            ->select('*')
                            ->where('user_id', $acct_hdid)
                            ->first();
                $view->with('individualTwitterApi', $individualTwitterApi);

                // timezone
                $timezones = DB::table('timezones')->get();
                $view->with('timezones', $timezones);

                // retrieve timezone
                $mainUser = DB::table('users')
                            ->join('users_meta', 'users.id', '=', 'users_meta.user_id')
                            ->where('users.id', $acct_hdid)->first();
                $view->with('mainUser', $mainUser);


                // general settings sliders
                $generalSettings = DB::table('settings_general')->where('user_id', $acct_hdid)->first();
                $view->with('generalSetting', $generalSettings);

                // twitter settings DB
                $twitterSettings = DB::table('settings_twitter')
                                ->join('settings_twitter_meta', 'settings_twitter.twitter_id', '=', 'settings_twitter_meta.twitter_id')
                                ->join('ut_acct_mngt', 'settings_twitter.twitter_id', '=', 'ut_acct_mngt.twitter_id')
                                ->select('settings_twitter.*', 'ut_acct_mngt.selected', 'settings_twitter_meta.*')
                                ->where('settings_twitter.twitter_id', '=', $twitterID)
                                ->first();
                $view->with('twitterSetting', $twitterSettings);

                // API inside General settings
                $twitterApiMaster = DB::table('settings_general_twapi')
                        ->join('users', 'users.id', 'settings_general_twapi.user_id')
                        ->select('*')
                        ->where('users.id', $acct_hdid)
                        ->first();


                // Update the API data with the encrypted values
                // $twitterApiMaster->api_key = $encryptedApiKey;
                // $twitterApiMaster->api_secret = $encryptedApiSecret;
                $view->with('twitterApiMaster', $twitterApiMaster);

                // API inside General settings
                $twitterApiIndiv = DB::table('settings_twitter_twapi')
                        ->join('users', 'users.id', 'settings_twitter_twapi.user_id')
                        ->select('*')
                        ->where('users.id', $acct_hdid)
                        ->first();
                $view->with('twitterApiIndiv', $twitterApiIndiv);

                // membership
                $membership = DB::table('users_meta')->where('user_id', $acct_hdid)->first();
                $view->with('membership', $membership);

                $toggle = DB::table('users_meta')->where('user_id', $acct_hdid)->first();

                // membership
                $membership = DB::table('users_meta')->where('user_id', $acct_hdid)
                        ->join('plans', 'users_meta.subscription_id', 'plans.subscription_id')
                        ->first();

                $view->with('membership', $membership);

                $toggle = DB::table('users_meta')->where('user_id', $acct_hdid)->first();
                $currentRoute = Route::current()->uri;
                if ($currentRoute === 'evergreen' || $currentRoute === 'promo' || $currentRoute === 'queue') {
                    $view->with('toggle', $toggle->{$currentRoute . '_switch'});
                } else {
                    $view->with('toggle', 0);
                }


                $getMembers = DB::table('members')
                ->join('users', 'members.account_holder_id', '=', 'users.id')
                ->select('users.*', 'members.*')
                ->where('members.account_holder_id', $acct_hdid)
                ->get();
            // dd($getMembers);
            $view->with('team_members', $getMembers);







                $cntMembers = DB::table('members')
                    ->join('users', 'members.account_holder_id', '=', 'users.id')
                    ->select('users.*', 'members.*')
                    ->where('members.account_holder_id', $acct_hdid)
                    ->count();
                $view->with('cntmembers', $cntMembers);

                $hasRegularTweetsInQueue = DB::table('posts')
                    ->where('user_id', $acct_hdid)
                    ->where('sched_time', '>', TwitterHelper::now($acct_hdid))
                    ->where('post_type', 'regular-tweets')
                    ->exists();
                    // dd($hasRegularTweetsInQueue);
                $view->with('hasRegularTweetsInQueue', $hasRegularTweetsInQueue);




                $hasCustomSlot = DB::table('schedule')
                    ->where('user_id', $acct_hdid)
                    ->get();
                $view->with('hasCustomSlot', $hasCustomSlot);

                $twitter = Twitter::where(['user_id' => $acct_hdid, 'deleted' => 0])->get();
                // to loop all the twitter accts
                $view->with('twitter_accts', $twitter);










                    $xmembersaccess = DB::table('members')
            ->select('members.*')
            ->where('members.account_holder_id', Auth::id())
            ->get();


            $xmembersaccessII = DB::table('member_xaccount')
            ->select('member_xaccount.*')
            ->where('member_xaccount.user_id', Auth::id())
            ->when(isset($selectedUser->twitter_id), function ($query) use ($selectedUser) {
                return $query->where('member_xaccount.mtwitter_id', $selectedUser->twitter_id);
            }, function ($query) {
                return $query->where('member_xaccount.mtwitter_id', 0);
            })
            ->get();





                $view->with('xmembersaccess', $xmembersaccess);
                $view->with('idscheck', $xmembersaccessII);




            }
        });

    }


}
