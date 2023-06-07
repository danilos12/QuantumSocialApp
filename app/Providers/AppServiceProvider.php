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

            if (auth()->check()) {

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
    
                // twitter settings DB 
                $twitterSettings = DB::table('qts_tweetmeta')
                                ->join('ut_acct_mngt', 'qts_tweetmeta.twitter_id', '=', 'ut_acct_mngt.twitter_id')
                                ->select('qts_tweetmeta.*', 'ut_acct_mngt.selected')
                                ->where('qts_tweetmeta.twitter_id', '=', $twitterID)
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
                
                $toggle = DB::table('twitter_meta')->where('user_id', Auth::id())->where('twitter_id', $twitterID)->first();     
                // dd($toggle);
                $view->with('toggle', $toggle ? $toggle->queue_switch : null);                       
                           
                // // api 
                // $twitter_tkn = TwitterToken::where('twitter_id', $twitterID)->first();                
                // $twitterDetails = TwitterHelper::getTwitterdetails($twitter_tkn);

                // // dd($twitterDetails);
                // $view->with('api_tdetails', $twitterDetails);            

            }        
        });

    }

    
}
