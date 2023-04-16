<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
Route::get('/', function () {
    return view('welcome');
});
*/

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [App\Http\Controllers\dashboardController::class, 'index'])->name('dashboard');
Route::get('/command-module', [App\Http\Controllers\CommandmoduleController::class, 'index'])->name('command-module');
Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profiles');
Route::get('/profile/edit-password', [App\Http\Controllers\ProfileController::class, 'edit_password'])->name('edit-password');
Route::post('/profile/edit-password', [App\Http\Controllers\ProfileController::class, 'updatePassword'])->name('update-password');

Route::get('/posting', [App\Http\Controllers\PostingController::class, 'index'])->name('posting');
Route::get('/queue', [App\Http\Controllers\PostingController::class, 'queue'])->name('queue');
Route::get('/drafts', [App\Http\Controllers\PostingController::class, 'drafts'])->name('drafts');
Route::get('/posted', [App\Http\Controllers\PostingController::class, 'posted'])->name('posted');
Route::get('/schedule', [App\Http\Controllers\PostingController::class, 'slot_scheduler'])->name('slot-scheduler');
Route::match(['get', 'post'], '/add-new-slot', [App\Http\Controllers\PostingController::class, 'add_new_slot'])->name('add-new-slot');

Route::get('/tweet-stormer', [App\Http\Controllers\PostingController::class, 'tweet_stormer'])->name('tweet-stormer');
Route::get('/bulk', [App\Http\Controllers\PostingController::class, 'bulk_uploader'])->name('bulk-uploader');

Route::get('/campaigns', [App\Http\Controllers\CampaignsController::class, 'index'])->name('campaigns');
Route::get('/promo', [App\Http\Controllers\CampaignsController::class, 'promo_tweets'])->name('promo-tweets');
Route::get('/evergreen', [App\Http\Controllers\CampaignsController::class, 'evergreen_tweets'])->name('evergreen-tweets');
Route::get('/tweet-storms', [App\Http\Controllers\CampaignsController::class, 'tweet_storms'])->name('tweet-storms');
Route::get('/tag-groups', [App\Http\Controllers\CampaignsController::class, 'tag_groups'])->name('tag-groups');


Route::get('/engagement', [App\Http\Controllers\EngagementController::class, 'index'])->name('engagement');
Route::get('/engage', [App\Http\Controllers\EngagementController::class, 'c_engage'])->name('social-engage');
Route::get('/mentions', [App\Http\Controllers\EngagementController::class, 'c_mentions'])->name('social-mentions');
Route::get('/user-feeds', [App\Http\Controllers\EngagementController::class, 'c_user_feeds'])->name('social-user-feeds');
Route::get('/user-lists', [App\Http\Controllers\EngagementController::class, 'c_user_lists'])->name('social-user-lists');
Route::get('/hashtag-feeds', [App\Http\Controllers\EngagementController::class, 'c_hashtag_feeds'])->name('social-hashtag-feeds');
Route::get('/help', [App\Http\Controllers\dashboardController::class, 'help'])->name('help');

Route::get('/trending', [App\Http\Controllers\TrendingtopicsController::class, 'index'])->name('trending-topics');

// twitter API
Route::get('/twitter/redirect', [App\Http\Controllers\Controller::class, 'twitterOAuth']);
Route::get('/twitter/oauth', [App\Http\Controllers\Controller::class, 'twitterOAuthCallback']);

// get Tweets
Route::get('/twitter/getTweets/{id}', [App\Http\Controllers\TwitterApi::class, 'getTweets'])->name('getTweets');
Route::get('/tweets/{id}', [App\Http\Controllers\TwitterApi::class, 'tweets'])->name('tweets');

Route::post('/twitter/switchUser/{twitter_id}', [App\Http\Controllers\TwitterApi::class, 'switchedAccount'])->name('twitter.switchUser');
Route::post('/twitter/remove', [App\Http\Controllers\TwitterApi::class, 'removeTwitterAccount'])->name('twitter.remove');
Route::get('/twitter/details/{id}', [App\Http\Controllers\TwitterApi::class, 'twitterDetails'])->name('twitter.details');
Route::get('/twitter/{id}/filter/{type}', [App\Http\Controllers\TwitterApi::class, 'getTweetFilters'])->name('tweet.filter');

Route::post('/settings', [App\Http\Controllers\GeneralSettingController::class, 'saveSettings'])->name('save-settings');

Route::post('/cmd/save', [App\Http\Controllers\CommandmoduleController::class, 'create'])->name('cmd.save');
Route::post('/cmd/add-tag', [App\Http\Controllers\CommandmoduleController::class, 'addTagGroup'])->name('cmd.add_tag');
Route::post('/cmd/add-tag-item', [App\Http\Controllers\CommandmoduleController::class, 'addTagItem'])->name('cmd.add_tag_item');
Route::get('/cmd/get-tag-groups/{id}',[App\Http\Controllers\CommandmoduleController::class, 'getTagGroups'])->name('cmd.get_tag_groups');
Route::get('/cmd/get-tag-items',[App\Http\Controllers\CommandmoduleController::class, 'getTagItems'])->name('cmd.get_tag_items');
Route::get('/cmd/unselected',[App\Http\Controllers\CommandmoduleController::class, 'getUnselectedTwitterAccounts'])->name('cmd.unused');
Route::get('/cmd/{id}/post-type/{type}',[App\Http\Controllers\CommandmoduleController::class, 'getTweetsUsingPostTypes'])->name('cmd.post_type');

Route::get('/promos/get/{id}',[App\Http\Controllers\CommandmoduleController::class, 'getPromos'])->name('promos.get');




Route::middleware(['web','guest', 'CheckSessionExpiration'])
    ->group(function () {
        Route::get('/session-login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])
            ->name('session-login')
            ->withoutMiddleware(['CheckSessionExpiration']);
        Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])
            ->withoutMiddleware(['CheckSessionExpiration']);
    });

