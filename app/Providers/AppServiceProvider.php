<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\TwitterToken;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Twitter;
use App\Models\TwitterSettingsMeta;
use App\Models\UT_AcctMngt;
use App\Models\User;
use DateTime;
use DateTimeZone;



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

            // dd($selectedUser);   
            $view->with('selected_user', $selectedUser);       


            // twitter settings DB 
            $twitterSettings = DB::table('qts_tweetmeta')
                            ->join('ut_acct_mngt', 'qts_tweetmeta.twitter_id', '=', 'ut_acct_mngt.twitter_id')
                            ->select('qts_tweetmeta.*', 'ut_acct_mngt.selected')
                            ->get();
            $view->with('twitter_settings', $twitterSettings);
            
            // main quantum user 
            $main_user = User::find(Auth::id());
            $view->with('main_user', $main_user);

            // timezone 
            $timezones = DB::table('timezones')->get();
            $view->with('timezones', $timezones);

            // retrieve timezone
            $getTimezone = DB::table('users_meta')->where('user_id', Auth::id())->first();
            // dd($getTimezone);
            $view->with('getTimezone', $getTimezone);
            
            // general settings sliders
            $generalSettings = DB::table('qgs_settingsmeta')->where('user_id', Auth::id())->get();
            $view->with('generalSettings', $generalSettings);
            
            // membership 
            $membership = DB::table('users_meta')->where('user_id', Auth::id())->first();            
            $view->with('membership', $membership);
            
            // // social account settings of selected user 
            // if ($selectedUser !== null) {
            //     $metas = TwitterSettingsMeta::where(['user_id' => Auth::id(), 'twitter_id' => $selectedUser->twitter_id])->get();
            //     $view->with('meta', $metas);
            // }

        });

    }
}
