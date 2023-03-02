<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Twitter;
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
            $view->with('twitter', Twitter::where('user_id', auth()->id())->get());         
            
            $selectedUser = UT_AcctMngt::where(['user_id' => Auth::id(), 'selected' => 1])->first();
            $twitterSelectedUser = Twitter::where('twitter_id', $selectedUser->getAttribute('twitter_id'))->first();
            $view->with('user', $twitterSelectedUser);         

        });

    }
}
