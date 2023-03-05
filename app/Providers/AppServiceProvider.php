<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Twitter;
use App\Models\TwitterSettingsMeta;
use App\Models\UT_AcctMngt;
use App\Models\TwitterToken;
use Illuminate\Support\Facades\Auth;




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
            $view->with('acct_twitter_count', Twitter::where('user_id', auth()->id())->count());
            $view->with('twitter_accts', Twitter::where('user_id', auth()->id())->get());
            $twit = Twitter::where('user_id', auth()->id())->get();
            $view->with('twitter', $twit);         
            
            $selectedUser = UT_AcctMngt::where(['user_id' => Auth::id(), 'selected' => 1])->first();
            if ($selectedUser !== null) {
                $twitterSelectedUser = Twitter::where('twitter_id', $selectedUser->getAttribute('twitter_id'))->first();
                $view->with('user', $twitterSelectedUser);         
                $view->with('selected_user', $selectedUser);         
            }
            
            $twitterSettingsMentions = TwitterSettingsMeta::where(['twitter_id' => $selectedUser->getAttribute('twitter_id')])->get();

            // dd($twitterSettingsMentions->toArray());
            $view->with('twitter_settings', $twitterSettingsMentions);         
        });

    }
}
