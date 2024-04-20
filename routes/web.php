<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\testingapi;
use Illuminate\Support\Facades\Auth;
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





Route::get('/login/member', function () {
    // Redirect authenticated users to member home
    if(Auth::guard('member')->check()) {
        return redirect()->route('memberhome');
    }
    return view('auth.memberlogin');
})->name('tomemberauth');

Route::post('/login/member', [App\Http\Controllers\Auth\MemberLoginController::class, 'login'])->name('forauth');
Route::post('/logout/member', [App\Http\Controllers\Auth\MemberLoginController::class, 'logout'])->name('memberlogout');


// Auth::routes();
Auth::routes(['register' => false]);









// Route::post('/forgot-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
// Routes accessible only to authenticated members


// Password reset routes
Route::get('password/reset', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::get('password/reset/{token}', [App\Http\Controllers\Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/email', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::post('/change-password', [App\Http\Controllers\Auth\ChangePasswordController::class, 'updatePassword'])->name('change.password');
Route::post('/reset-password', [App\Http\Controllers\Auth\ResetPasswordController::class, 'resetPassword'])->name('password.update');
// Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');






// dashboard controller
Route::get('/help', [App\Http\Controllers\dashboardController::class, 'help'])->name('help');
Route::get('/', [App\Http\Controllers\dashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard', [App\Http\Controllers\dashboardController::class, 'index'])->name('dashboard');
// Route::get('/testing',function(){return view('testpage');})->name('memberbanner')->name('testpage')->middleware('auth');

Route::get('/get-upgrade-modal', [App\Http\Controllers\HomeController::class, 'upgrademodal'])->name('upgradecheckout');


// Profile controller
Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profiles');
Route::get('/profile/edit-password', [App\Http\Controllers\ProfileController::class, 'edit_password'])->name('edit-password');
Route::post('/profile/edit-password', [App\Http\Controllers\ProfileController::class, 'updatePassword'])->name('update-password');



// Posting Controller
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
Route::get('/bulk-queue', [App\Http\Controllers\PostingController::class, 'bulk_queue'])->name('bulk-queue');
Route::get('/schedule/slots',[App\Http\Controllers\PostingController::class, 'getScheduledSlots'])->name('schedule.slot');
Route::post('/post/status/{switch}/{id}',[App\Http\Controllers\PostingController::class, 'switchFromQueue'])->name('post.switch');
Route::get('/post/sortbytype',[App\Http\Controllers\PostingController::class, 'sortPostbyType'])->name('sort.type');
Route::get('/post/getmonth',[App\Http\Controllers\PostingController::class, 'getMonth'])->name('get.month');
Route::get('/post/sortbymonth',[App\Http\Controllers\PostingController::class, 'sortPostbyMonth'])->name('sort.month');
Route::get('/post/edit/{id}',[App\Http\Controllers\PostingController::class, 'editPost'])->name('post.edit');
Route::post('/post/update/{id}',[App\Http\Controllers\PostingController::class, 'editPostData'])->name('post.edit');
Route::post('/post/delete/{id}',[App\Http\Controllers\PostingController::class, 'deletePost'])->name('post.delete');
Route::get('/post/bulk_edit/{id}',[App\Http\Controllers\PostingController::class, 'editBulk'])->name('post.bulk_edit'); // retrieve modal
Route::put('/post/bulk_edit/{id}',[App\Http\Controllers\PostingController::class, 'editBulk'])->name('post.bulk_edit'); // update data in modal
Route::post('/post/duplicate/{id}',[App\Http\Controllers\PostingController::class, 'duplicatePost'])->name('post.duplicate');
Route::get('/post/evergreen/retrieve/{id}',[App\Http\Controllers\PostingController::class, 'retrieveSpecialPost'])->name('post.special');






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
Route::get('/trending', [App\Http\Controllers\TrendingtopicsController::class, 'index'])->name('trending-topics');

// twitter API/twitter/redirect/
Route::get('/twitter/redirect/{id}', [App\Http\Controllers\Controller::class, 'checkTwitterCreds']);
Route::get('/twitter/oauth', [App\Http\Controllers\Controller::class, 'twitterOAuthCallback']);
Route::get('/post/popup',[App\Http\Controllers\Controller::class, 'modalPopup'])->name('modal');


// get Tweets or Twitter Api Controller
Route::get('/twitter/getTweets/{id}', [App\Http\Controllers\TwitterApi::class, 'getTweets'])->name('getTweets');
Route::get('/tweets/{id}', [App\Http\Controllers\TwitterApi::class, 'tweets'])->name('tweets');
Route::get('/twitter/accts', [App\Http\Controllers\TwitterApi::class, 'getTwitterAccts']);
Route::post('/twitter/switchUser', [App\Http\Controllers\TwitterApi::class, 'switchedAccount'])->name('twitter.switchUser');
Route::post('/twitter/remove', [App\Http\Controllers\TwitterApi::class, 'removeTwitterAccount'])->name('twitter.remove');
Route::get('/twitter/details/{id}', [App\Http\Controllers\TwitterApi::class, 'twitterDetails'])->name('twitter.details');
Route::get('/twitter/{id}/filter/{type}', [App\Http\Controllers\TwitterApi::class, 'getTweetFilters'])->name('tweet.filter');
Route::get('/twitter/{id}/filter/{type}/get-more-tweets', [App\Http\Controllers\TwitterApi::class, 'getTweetMoreTweets'])->name('tweet.more');
Route::post('/twitter/{id}/tweet-now', [App\Http\Controllers\TwitterApi::class, 'tweetNow'])->name('tweet.now');
Route::post('/twitter/{id}/tweet-schedule', [App\Http\Controllers\TwitterApi::class, 'tweetSchedule'])->name('tweet.filter');
Route::post('/twitter/assignmember', [App\Http\Controllers\TwitterApi::class, 'addmemberxaccts'])->name('togglexmember');



// General settings controller
Route::post('/settings', [App\Http\Controllers\GeneralSettingController::class, 'saveSettings'])->name('save-settings');
Route::post('/settings/twitter_api_creds/{user_id}', [App\Http\Controllers\GeneralSettingController::class, 'twitterApiCredentials'])->name('api_settings');
Route::post('/settings/timezone/{user_id}', [App\Http\Controllers\GeneralSettingController::class, 'timezoneSettings'])->name('timezone');
Route::post('/settings/membership/{user_id}', [App\Http\Controllers\GeneralSettingController::class, 'membershipSettings'])->name('membership');
Route::post('/settings/twitter_meta/{twitter_id}', [App\Http\Controllers\GeneralSettingController::class, 'twitterSettingsMeta'])->name('twitter_settings_meta');
Route::get('/settings/twitter_toggle', [App\Http\Controllers\GeneralSettingController::class, 'generalAndTwitterSettings'])->name('twitter_toggle');
Route::get('/settings/twitter_form', [App\Http\Controllers\GeneralSettingController::class, 'getTwitterForm'])->name('twitter_form');
Route::post('/settings/twitter_api/save/{twitter_id}', [App\Http\Controllers\GeneralSettingController::class, 'saveTwitterApi'])->name('twitter_api.save');
Route::get('/settings/members', [App\Http\Controllers\GeneralSettingController::class, 'fetchMembers']);
Route::post('/settings/_add_new', [App\Http\Controllers\GeneralSettingController::class, 'addNewMember'])->name('member.add');
Route::post('/settings/members/_edit', [App\Http\Controllers\GeneralSettingController::class, '_editMember'])->name('member.edit');
Route::post('/settings/members/_getedit', [App\Http\Controllers\GeneralSettingController::class, '_getedit'])->name('get.edit');
Route::post('/settings/members/_update/{id}', [App\Http\Controllers\GeneralSettingController::class, '_updateMember'])->name('member.edit');
Route::post('/settings/members/_delete/{id}', [App\Http\Controllers\GeneralSettingController::class, '_deleteMember'])->name('member.delete');
Route::post('/settings/members/_apiaccess', [App\Http\Controllers\GeneralSettingController::class, '_apiaccess'])->name('member.apiaccess');
Route::post('/settings/members/_adminaccess', [App\Http\Controllers\GeneralSettingController::class, '_adminaccess'])->name('member.adminaccess');


// Command Module Controller
Route::get('/command-module', [App\Http\Controllers\CommandmoduleController::class, 'index'])->name('command-module');
Route::post('/cmd/save', [App\Http\Controllers\CommandmoduleController::class, 'create'])->name('cmd.save');
Route::post('/cmd/add-tag', [App\Http\Controllers\CommandmoduleController::class, 'addTagGroup'])->name('cmd.add_tag');
Route::post('/cmd/add-tag-item', [App\Http\Controllers\CommandmoduleController::class, 'addTagItem'])->name('cmd.add_tag_item');
Route::post('/cmd/post/tweet-now',[App\Http\Controllers\CommandmoduleController::class, 'postNowFromQueue'])->name('post.tweet');
Route::post('/cmd/post/move-to-top',[App\Http\Controllers\CommandmoduleController::class, 'moveTopFromQueue'])->name('post.move');
Route::get('/cmd/get-tag-groups/{id}',[App\Http\Controllers\CommandmoduleController::class, 'getTagGroups'])->name('cmd.get_tag_groups');
Route::get('/cmd/get-tag-items',[App\Http\Controllers\CommandmoduleController::class, 'getTagItems'])->name('cmd.get_tag_items');
Route::get('/cmd/get-tag-items-json',[App\Http\Controllers\CommandmoduleController::class, 'getTagItems'])->name('cmd.get_tag_items');
Route::get('/cmd/unselected',[App\Http\Controllers\CommandmoduleController::class, 'getUnselectedTwitterAccounts'])->name('cmd.unused');
Route::get('/cmd/{id}/post-type/{type}',[App\Http\Controllers\CommandmoduleController::class, 'getTweetsUsingPostTypes'])->name('cmd.post_type');
Route::get('/cmd/get-custom-slot',[App\Http\Controllers\CommandmoduleController::class, 'getCustomSlot'])->name('cmd.get-custom-slot');
Route::post('/bulk/upload', [App\Http\Controllers\CommandmoduleController::class, 'upload'])->name('bulk-upload');
Route::get('/promos/get/{id}',[App\Http\Controllers\CommandmoduleController::class, 'getPromos'])->name('promos.get');
Route::post('/reload-meta/scrape',[App\Http\Controllers\CommandmoduleController::class, 'scrapeMeta'])->name('scrape');


// Route::post('/cmd/post/duplicate/{id}',[App\Http\Controllers\CommandmoduleController::class, 'duplicateFromQueue'])->name('post.duplicate');
// Route::put('/post/bulk_update/{id}',[App\Http\Controllers\PostingController::class, 'editBulkPost'])->name('post.bulk_update'); // update data in modal

Route::get('/su/admin', [App\Http\Controllers\SuperAdminController::class, 'index'])->name('superadmin');
Route::get('/su/admin/users', [App\Http\Controllers\SuperAdminController::class, 'getAllOwners'])->name('su.users');
Route::get('/su/admin/admins', [App\Http\Controllers\SuperAdminController::class, 'getAllAdmins'])->name('su.admins');
Route::get('/su/admin/members', [App\Http\Controllers\SuperAdminController::class, 'getAllMembers'])->name('su.members');
Route::get('/su/admin/plans', [App\Http\Controllers\SuperAdminController::class, 'getAllPlans'])->name('su.plans');
Route::get('/su/admin/phpinfo', [App\Http\Controllers\SuperAdminController::class, 'phpInfo']);
// Add more routes as needed



Route::middleware(['web','guest','session_expired'])
    ->group(function () {
        Route::get('/session-login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])
            ->name('session-login')
            ->withoutMiddleware(['session_expired']);
        Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])
            ->withoutMiddleware(['session_expired']);

    });




    Route::get('/team-registration', function () {
        return view('emails.team_members_registration');
    })->name('memberregistration');
    Route::post('/team-registration', [App\Http\Controllers\TeamMemberRegistration::class, 'team_member_reg'])->name('tocontroller');






    Route::middleware('member-access')->group(function(){

        Route::get('/member/home',function()
        {return view('layouts.membersdashboard')->with('title','Home');})->name('memberhome')->withoutMiddleware(['session_expired']);;
        Route::get('/member/promo',function(){

            return view('promo-tweets')->with('title','Promo');});
        Route::get('/member/banner',function(){return view('layouts.app');})->name('memberbanner');






    });
