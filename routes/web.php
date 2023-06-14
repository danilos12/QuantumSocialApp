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
// Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('c.login');
Route::post('/forgot-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [App\Http\Controllers\Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [App\Http\Controllers\Auth\ResetPasswordController::class, 'resetPassword'])->name('password.update');


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
Route::post('/schedule/save', [App\Http\Controllers\PostingController::class, 'schedule_save'])->name('schedule.save');
Route::post('/schedule/action/{slot_id}', [App\Http\Controllers\PostingController::class, 'schedule_action'])->name('schedule.action');
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
Route::get('/twitter/accts', [App\Http\Controllers\TwitterApi::class, 'getTwitterAccts']);
Route::post('/twitter/switchUser', [App\Http\Controllers\TwitterApi::class, 'switchedAccount'])->name('twitter.switchUser');
Route::post('/twitter/remove', [App\Http\Controllers\TwitterApi::class, 'removeTwitterAccount'])->name('twitter.remove');
Route::get('/twitter/details/{id}', [App\Http\Controllers\TwitterApi::class, 'twitterDetails'])->name('twitter.details');
Route::get('/twitter/{id}/filter/{type}', [App\Http\Controllers\TwitterApi::class, 'getTweetFilters'])->name('tweet.filter');
Route::post('/twitter/{id}/tweet-now', [App\Http\Controllers\TwitterApi::class, 'tweetNow'])->name('tweet.now');
Route::post('/twitter/{id}/tweet-schedule', [App\Http\Controllers\TwitterApi::class, 'tweetSchedule'])->name('tweet.filter');

Route::post('/settings', [App\Http\Controllers\GeneralSettingController::class, 'saveSettings'])->name('save-settings');
Route::post('/settings/twitter_api_creds/{user_id}', [App\Http\Controllers\GeneralSettingController::class, 'twitterApiCredentials'])->name('api_settings');
Route::post('/settings/timezone/{user_id}', [App\Http\Controllers\GeneralSettingController::class, 'timezoneSettings'])->name('timezone');
Route::post('/settings/membership/{user_id}', [App\Http\Controllers\GeneralSettingController::class, 'membershipSettings'])->name('membership');
Route::post('/settings/twitter_meta/{twitter_id}', [App\Http\Controllers\GeneralSettingController::class, 'twitterSettingsMeta'])->name('twitter_settings_meta');

Route::post('/cmd/save', [App\Http\Controllers\CommandmoduleController::class, 'create'])->name('cmd.save');
Route::post('/cmd/add-tag', [App\Http\Controllers\CommandmoduleController::class, 'addTagGroup'])->name('cmd.add_tag');
Route::post('/cmd/add-tag-item', [App\Http\Controllers\CommandmoduleController::class, 'addTagItem'])->name('cmd.add_tag_item');
Route::post('/cmd/post/tweet-now/{id}',[App\Http\Controllers\CommandmoduleController::class, 'postNowFromQueue'])->name('post.tweet');
Route::post('/cmd/post/duplicate-now/{id}',[App\Http\Controllers\CommandmoduleController::class, 'duplicateFromQueue'])->name('post.duplicate');
Route::post('/cmd/post/move-to-top/{id}',[App\Http\Controllers\CommandmoduleController::class, 'moveTopFromQueue'])->name('post.move');
Route::get('/cmd/get-tag-groups/{id}',[App\Http\Controllers\CommandmoduleController::class, 'getTagGroups'])->name('cmd.get_tag_groups');
Route::get('/cmd/get-tag-items',[App\Http\Controllers\CommandmoduleController::class, 'getTagItems'])->name('cmd.get_tag_items');
Route::get('/cmd/unselected',[App\Http\Controllers\CommandmoduleController::class, 'getUnselectedTwitterAccounts'])->name('cmd.unused');
Route::get('/cmd/{id}/post-type/{type}',[App\Http\Controllers\CommandmoduleController::class, 'getTweetsUsingPostTypes'])->name('cmd.post_type');

Route::get('/schedule/slots',[App\Http\Controllers\PostingController::class, 'getScheduledSlots'])->name('schedule.slot');

Route::get('/promos/get/{id}',[App\Http\Controllers\CommandmoduleController::class, 'getPromos'])->name('promos.get');

Route::post('/post/{switch}/{id}',[App\Http\Controllers\PostingController::class, 'switchFromQueue'])->name('post.switch');
Route::get('/post/sortbytype',[App\Http\Controllers\PostingController::class, 'sortPostbyType'])->name('sort.type');
Route::get('/post/getmonth',[App\Http\Controllers\PostingController::class, 'getMonth'])->name('get.month');
Route::get('/post/sortbymonth',[App\Http\Controllers\PostingController::class, 'sortPostbyMonth'])->name('sort.month');
Route::get('/post/edit/{id}',[App\Http\Controllers\PostingController::class, 'editPost'])->name('get.edit');
Route::post('/post/delete/{id}',[App\Http\Controllers\PostingController::class, 'deletePost'])->name('post.delete');
Route::post('/post/filter/',[App\Http\Controllers\PostingController::class, 'deleteQueue'])->name('post.delete');


Route::middleware(['web','guest', 'CheckSessionExpiration'])
    ->group(function () {
        Route::get('/session-login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])
            ->name('session-login')
            ->withoutMiddleware(['CheckSessionExpiration']);
        Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])
            ->withoutMiddleware(['CheckSessionExpiration']);
    });

