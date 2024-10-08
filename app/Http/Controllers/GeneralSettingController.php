<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Swift_TransportException;
use Illuminate\Support\Facades\Log;
use App\Models\Twitter;
use App\Models\TwitterToken;
use App\Helpers\MembershipHelper;
use App\Helpers\WP;
use App\Models\TwitterSettings;
use App\Models\TwitterSettingsMeta;
use App\Models\GeneralSettings;
use App\Models\MasterTwitterApiCredentials;
use App\Models\QuantumAcctMeta;
use App\Models\TwitterApiCredentials;
use App\Http\Controllers\dashboardController;
use App\Models\UT_AcctMngt;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\TeamMemberReg;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDO;



class GeneralSettingController extends Controller
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

    public function saveSettings(Request $request) {

        $key = $request->input('meta_key');
        $value = $request->input('meta_value');
        $id = $request->input('id');


        try {
            $settings = null;
            switch ($id) {
                case "general-settings":
                    $userId = $request->input('user_id');
                    $settings = GeneralSettings::where('user_id', $userId)->update([$key => $value]);

                    $html = $this->renderTwitterAPiAccordion();

                    break;

                case "twitter-settings":
                    $twitterId = $request->input('twitter_id');
                    $settings = TwitterSettings::where('twitter_id' , $twitterId)->update([$key => $value]);

                    $html = TwitterSettings::where(['twitter_id' => $twitterId, $key => $value])->pluck($key)->first();
                    break;
            }

            if ($settings) {
                return response()->json(['status' => 200, 'stat' => 'success', 'html' => $html, 'message' => "Data has been updated"]);
            } else {
                return response()->json(['status' => 400, 'stat' => 'warning', 'message' => 'Failed to update your membership.']);
            }

        } catch(Exception $e) {
            $trace = $e->getTrace();
            $message = $e->getMessage();
            // Handle the error
            // Log or display the error message along with file and line number
            return response()->json(['status' => 500, 'error' => $trace, 'message' => $message]);
        }

    }

    public function generalAndTwitterSettings() {
        $html = $this->renderTwitterAPiAccordion();
        return response()->json(['status' => 200, 'stat' => 'success', 'html' => $html, 'message' => "Data has been updated"]);
    }

    public function getTwitterForm(Request $request) {
        try {
            TwitterSettings::join('ut_acct_mngt', 'ut_acct_mngt.twitter_id', 'settings_twitter.twitter_id')
                ->where('ut_acct_mngt.user_id', $this->setDefaultId())
                ->update(['toggle_10' => $request->toggle]);

            // Retrieve the updated toggle_10 value
            $settings = TwitterSettings::join('ut_acct_mngt', 'ut_acct_mngt.twitter_id', 'settings_twitter.twitter_id')
                ->where('ut_acct_mngt.user_id', $this->setDefaultId())
                ->first();

            $toggle_10 = $settings->toggle_10;

            if ($toggle_10 === 1) {
                // Find the existing record or create a new one
                $credentials = TwitterApiCredentials::updateOrCreate(
                    ['user_id' => $this->setDefaultId()],
                    [
                        'twitter_id' => null,
                        'api_key' => null,
                        'api_secret' => null,
                        'bearer_token' => null,
                        'access_token' => null,
                        'token_secret' => null,
                    ]
                );

                $html = view('twitterapi-form')->render();
                return response()->json(['status' => 200, 'toggle' => 1, 'stat' => 'success', 'html' => $html, 'message' => "Enter your API credentials for this Twitter Account."]);
            } else {
                $html = 'You are currently using Master API Credentials.<br> <span style="font-weight: 200; font-style=italic">(Turn this on to add account level credentials form).</span>';
                return response()->json(['status' => 200, 'toggle' => 0, 'stat' => 'success', 'html' => $html]);
            }


        } catch (Exception $e) {
            $trace = $e->getTrace();
            $message = $e->getMessage();
            // Handle the error
            // Log or display the error message along with file and line number
            return response()->json(['status' => 500, 'error' => $trace, 'message' => $message]);
        }
    }

    public function renderTwitterAPiAccordion() {
        $lastSavedData = GeneralSettings::where('user_id', $this->setDefaultId())->first();
        $html= '';

        if ($lastSavedData->toggle_1 === 1 && $lastSavedData->toggle_7 === 1)
        {
            $html = view('master-api-and-twapi')->render();
        }
        else if ($lastSavedData->toggle_1 === 0 && $lastSavedData->toggle_7 === 1)
        {
            $html = view('master-api-or-twapi')->render();
        }
        else
        {
            $html = null;
        // }

        return $html;
    }
    }
    public function saveTwitterApi(Request $request, $twitter_id) {

        try {

            $saveTwitterApi = TwitterApiCredentials::where('user_id', $this->setDefaultId())->first();
            $saveTwitterApi->twitter_id = $twitter_id;
            $saveTwitterApi->api_key = $request->input('api_key');
            $saveTwitterApi->api_secret = $request->input('api_secret');
            $saveTwitterApi->bearer_token = $request->input('bearer_token');
            $saveTwitterApi->access_token = $request->input('access_token');
            $saveTwitterApi->token_secret = $request->input('token_secret');


            if ($saveTwitterApi) {
                return response()->json(['status' => 200, 'stat' => 'success', 'message' => 'Credentials are updated']);
            } else {
                return response()->json(['status' => 400, 'stat' => 'danger', 'message' => 'Failed to update credentials']);
            }

        } catch (Exception $e) {
            $trace = $e->getTrace();
            $message = $e->getMessage();
            // Handle the error
            // Log or display the error message along with file and line number
            return response()->json(['status' => 500, 'stat' => 'danger', 'error' => $trace, 'message' => $message]);
        }

    }


    public function twitterApiCredentials(Request $request, $id)
    {
        try {

            if ($request->input('form_recipient') === 'onboard') {
                // Create a new Request object and merge the data
                $newRequest = new Request();
                $newRequest->merge(['data' => 'onboard_done']);
    
                // Instantiate the DashboardController (preferably through Laravel's container)
                $dashboard = app(DashboardController::class);
    
                // Call the onboarded method and capture its output
                $result = $dashboard->onboarded($newRequest);


                if ($result instanceof \Illuminate\Http\Response) {
                    return $result;
                }
            }

            $userId = $this->setDefaultId();
            $api = MasterTwitterApiCredentials::firstOrCreate(['user_id' => $this->setDefaultId()]);


            if (Auth::guard('web')->check() || (Auth::guard('member')->user()->admin_access == 1)) {

                $api->fill($request->all());
                $api->save();

                $apiCredentialsProvided = $request->has(['api_key', 'api_secret', 'bearer_token', 'oauth_id', 'oauth_secret']);
                if ($apiCredentialsProvided) {
                    DB::table('users_meta')
                        ->where('user_id', $userId)
                        ->update(['trial_credits' => 0]);
                }


                return response()->json(['status' => 200, 'stat' => 'success', 'message' => 'Master API Credentials are successfully ' . ($api->wasRecentlyCreated ? 'saved' : 'updated')]);
            } else {
                // Unauthorized user
                return response()->json(['stat' => 'danger', 'message' => 'You are not allowed to modify this']);
            }
        } catch (\Exception $e) {
            // Handle exceptions
            $trace = $e->getTrace();
            $message = $e->getMessage();

            return response()->json(['status' => 500, 'error' => $trace, 'message' => $message]);
        }
    }

    public function membershipSettings(Request $request, $id) {
        try {
            $tw = QuantumAcctMeta::where('user_id', $id)->first();
            $tw->subscription = $request->input('subscription');
            $tw->save();

            // Retrieve the recently saved data
            $updatedSubscription = $tw->subscription;

            if ($updatedSubscription) {
                return response()->json(['status' => 200, 'data' => $updatedSubscription,  'stat' => 'success', 'message' => 'Membership updated successfully']);
            } else {
                return response()->json(['status' => 400, 'stat' => 'danger', 'message' => 'Failed to update your membership.']);
            }

        } catch (Exception $e) {
            $trace = $e->getTrace();
            $message = $e->getMessage();
            // Handle the error
            // Log or display the error message along with file and line number
            return response()->json(['status' => 500, 'error' => $trace,  'stat' => 'danger', 'message' => $message]);
        }
    }

    public function timezoneSettings(Request $request, $id) {
        try {
            $tw = QuantumAcctMeta::where('user_id', $id)->first();
            $tw->timezone = $request->input('timezone');
            $tw->save();

            // Retrieve the recently saved data
            $updatedTimezone = $tw->timezone;

            if ($updatedTimezone) {
                return response()->json(['status' => 200, 'data' => $updatedTimezone, 'stat' => 'success' ,'message' => 'Timezone updated successfully']);
            } else {
                return response()->json(['status' => 400, 'stat' => 'danger', 'message' => 'Failed to update your timezone.']);
            }

        } catch (Exception $e) {
            $trace = $e->getTrace();
            $message = $e->getMessage();
            // Handle the error
            // Log or display the error message along with file and line number
            return response()->json(['status' => 500, 'stat' => 'danger' , 'error' => $trace, 'message' => $message]);
        }
    }

    public function selectAccount(Request $request, $id) {
        try {
            $twitterId = $request->input('twitter_id');
            $selectAcct = $request->input('selected');

            // update to be selected
            UT_AcctMngt::where(['twitter_id'=> $twitterId, 'user_id' => $this->setDefaultId()])->update(['selected' => $selectAcct]);
            $updatedRecord = UT_AcctMngt::where(['twitter_id' => $twitterId, 'user_id' => $this->setDefaultId()])->select('twitter_id')->first();

            // Retrieve the twitter_id value from the updated record
            $twitterId = $updatedRecord->twitter_id;

            // set others to false
            UT_AcctMngt::where('user_id', $this->setDefaultId())->where('twitter_id', '!=', $twitterId)->update(['selected' => 0]);

            // retrieve updated data
            $selectedAcct = UT_AcctMngt::where(['twitter_id' => $twitterId, 'user_id' => $this->setDefaultId()])->pluck('selected');

            return response()->json(['status' => 200, 'data' => $selectedAcct, 'message' => 'Twitter account is now updated']);

        } catch (Exception $e) {
            $trace = $e->getTrace();
            $message = $e->getMessage();
            // Handle the error
            // Log or display the error message along with file and line number
            return response()->json(['status' => 500, 'error' => $trace, 'message' => $message]);
        }
    }

    public function twitterSettingsMeta(Request $request, $twitter_id) {
        try {
            $api = MasterTwitterApiCredentials::firstOrNew(['user_id' => $this->setDefaultId()]);

            if (Auth::guard('web')->check() || (Auth::guard('member')->user()->admin_access == 1)) {
                if (!$api->exists) {
                    $api->api_key = $request->input('api_key', '')??'';
                    $api->api_secret = $request->input('api_secret', '')??'';
                    $api->bearer_token = $request->input('bearer_token')??'';
                    $api->oauth_id = $request->input('oauth_id')??'';
                    $api->oauth_secret = $request->input('oauth_secret')?? '';
                    $api->callback_url = $request->input('callback_url') ?? '';
                    $api->user_id = $this->setDefaultId();
                    $api->save();
                    return response()->json(['status' => 200, 'stat' => 'success', 'message' => 'Master API Credentials are successfully saved']);
                } else {
                    $api->update($request->all());
                    return response()->json(['status' => 200, 'stat' => 'success', 'message' => 'Master API Credentials are successfully updated']);
                }
            } else {
                return response()->json(['stat' => 'danger', 'message' => 'You are not allowed to modify this']);
            }
        } catch (Exception $e) {
            $trace = $e->getTrace();
            $message = $e->getMessage();
            return response()->json(['status' => 500, 'error' => $trace, 'message' => $message]);
        }

    }
    
    public function cancelSubscription(Request $request) {
        try {
             // Validate first the email provided
            $email = $request->input('quantum_social_email');
            $subscription = WP::getUserSubscription($email);          
                       
            if (!$subscription) {
                return response()->json(['status' => 404, 'message' => 'Subscription not found']);
            }

            $dbConnection = WP::external_db_connection();
            $table_prefix = 'wp_ftvis8_';
    
            // Prepare the UPDATE query
            $update = $dbConnection->prepare("
                UPDATE {$table_prefix}posts 
                SET 
                    post_status = 'wc-cancelled'
                WHERE 
                    ID = :id
                AND
                    post_type = 'shop_subscription'
            ");
    
            $update->bindParam(':id', $subscription['ID'], PDO::PARAM_INT);
    
            // Execute the query
            $update->execute();
    
            // Check if the update was successful
            if ($update->rowCount() > 0) {
                 // delete all associated data in laravel linked to this acct 
                $laravelUserID = DB::table('users')->where('email', $email)->value('id');   

                if (!$this->deleteAssocQuantumdata($laravelUserID)) {
                    return response()->json(['status' => 403, 'message' => 'Failed to delete Quantum account linked data']);
                }
                
                return response()->json(['status' => 200, 'stat' => 'success', 'message' => 'Subscription cancelled successfully. You will be logged out automatically.']);
            } else {
                return response()->json(['status' => 400, 'stat' => 'warning', 'message' => 'No rows updated']);
            }

        } catch(Exception $e) {
            $trace = $e->getTrace();
            $message = $e->getMessage();
            return response()->json(['status' => 500, 'error' => $trace, 'message' => $message]);
        }
    }

    public function deleteAssocQuantumdata($laravelUserID) {                    

        try {
            // Begin transaction
            DB::beginTransaction();
    
            // Perform deletions and track their success
            $deleteUserMeta = DB::table('users_meta')->where('user_id', $laravelUserID)->delete();
            $deleteSettingsToggler = DB::table('settings_toggler_general')->where('user_id', $laravelUserID)->delete();
            $deleteUserOnboard = DB::table('user_onboard')->where('user_id', $laravelUserID)->delete();
            $deleteLinkedTwitter = DB::table('ut_acct_mngt')->where('user_id', $laravelUserID)->delete();
            $deleteTwitterData = DB::table('twitter_accts')->where('user_id', $laravelUserID)->delete();
            $deleteTwitterMetaData = DB::table('twitter_meta')->where('user_id', $laravelUserID)->delete();
            $deleteUserData = DB::table('users')->where('id', $laravelUserID)->delete();
            $deletePostsData = DB::table('posts')->where('user_id', $laravelUserID)->delete();
    
            // Check if all deletions were successful
            if (
                $deleteUserMeta === false || 
                $deleteSettingsToggler === false || 
                $deleteUserOnboard === false || 
                $deleteLinkedTwitter === false || 
                $deleteTwitterData === false || 
                $deleteTwitterMetaData === false || 
                $deleteUserData === false ||
                $deletePostsData === false
            ) {
                // Rollback transaction if any deletion failed
                DB::rollBack();
                return response()->json(['success' => false, 'message' => 'Failed to delete user data.'], 500);
            }
    
            // Commit transaction if all deletions succeeded
            DB::commit();
            return response()->json(['success' => true, 'message' => 'User data deleted successfully.'], 200);
        } catch (\Exception $e) {
            // Rollback transaction on error
            DB::rollBack();
    
            // Log the error for debugging
            Log::error('Error deleting user data: ' . $e->getMessage());
    
            return response()->json(['success' => false, 'message' => 'An error occurred while deleting user data.'], 500);
        }
    }

    public function addNewMember(Request $request) {



            // Your existing code for adding a new member and sending an email goes here...
            if( Auth::guard('web')->check() || Auth::guard('member')->user()->admin_access == 1){
                $userId = $this->setDefaultId();

                $html = view('modals.upgrade')->render();

            // Retrieve the subscription status from the users_meta table
            $subscription = DB::table('users_meta')
                ->leftJoin('members', 'users_meta.user_id', '=', 'members.account_holder_id')
                ->select('users_meta.subscription_id')
                ->where('users_meta.user_id', $userId)
                ->first();
            $subs_id = $subscription->subscription_id;


                $email = $request->input('emails');


            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return response()->json(['message' => 'Invalid email address provided', 'stat' => 'warning']);
            }
            // Count the members with roles 'Admin' and 'Member'
            $adminCount = DB::table('members')->where('role', 'Admin')->where('account_holder_id',$userId)->count();
            $memberCount = DB::table('members')->where('role', 'Member')->where('account_holder_id',$userId)->count();

            $existingUser = DB::table('members')->where('email', $request->input('emails'))->exists();




            // Validate the email address

            if ($existingUser) {
                return response()->json(['message' => 'Email already exists','stat'=> 'warning']);
            }
            $adminaccess = null;
            $randomPassword = Str::random(10);
            if($request->input('roles')=="Admin"){
                $adminaccess = true;
            }else{
                $adminaccess= false;
            }
            $relational = [
                'account_holder_id' => $userId,
                'fullname' => $request->input('fullname'),
                'email' => $request->input('emails'),
                'role' => $request->input('roles'),
                'api_access' => $request->input('api_access'),
                'admin_access' => $adminaccess,
                'password' => $randomPassword,
                'isverified' => false,
                'tokens' => ''
            ];


            $plans1 =  DB::table('plans')->where('id', 1)->first();
            $plans2 =  DB::table('plans')->where('id', 2)->first();
            $plans3 =  DB::table('plans')->where('id', 3)->first();
            $plans4 =  DB::table('plans')->where('id', 4)->first();

            // Check the subscription type and count limits
            // solar subscription
        if ($subs_id == 1 ) {

            if($memberCount < $plans1->tm_count && $relational['role'] === 'Member' ){
                try{
                        DB::beginTransaction();
                        $userMngt = DB::table('members')->insert($relational);
                        if ($userMngt) {
                            Mail::to($request->input('emails'))->send(new TeamMemberReg($request->input('fullname')));
                            DB::commit();
                            return response()->json(['subscription'=>'galactic_member','message' => 'New member is added', 'stat' => 'success']);
                        } else {
                            return response()->json(['message' => 'New member is not added', 'stat' => 'warning']);
                        }
                } catch (Swift_TransportException $e) {
                    // Handle the Swift_TransportException
                    return response()->json(['message' => 'Failed to send email, please check recipient email address', 'stat' => 'warning']);
                }
            }elseif($adminCount < $plans1->admin_count && $relational['role'] === 'Admin'){
                try{

                            DB::beginTransaction();
                             $userMngt = DB::table('members')->insert($relational);
                    if ($userMngt) {
                             Mail::to($request->input('emails'))->send(new TeamMemberReg($request->input('fullname')));
                             DB::commit();
                        return response()->json(['subscription'=>'galactic_member','message' => 'New member is added', 'stat' => 'success']);
                    }
                     else {
                        return response()->json(['message' => 'New member is not added', 'stat' => 'warning']);
                    }
                } catch (Swift_TransportException $e) {
                    // Handle the Swift_TransportException
                    return response()->json(['message' => 'Failed to send email, please check recipient email address', 'stat' => 'warning']);
                }

        }  else{
            return response()->json(['stat' => 'warning','status' => 403, 'message' => 'You have exceeded the numbers of member/admin', 'html' => $html]);
        }
}


// end of solar

// galactic subscription

if ($subs_id == 2 ) {


    if($memberCount < $plans2->tm_count && $relational['role'] === 'Member' ){
        try{
            DB::beginTransaction();
            $userMngt = DB::table('members')->insert($relational);

            if ($userMngt) {
                Mail::to($request->input('emails'))->send(new TeamMemberReg($request->input('fullname')));
                DB::commit();
                return response()->json(['subscription'=>'galactic_member','message' => 'New member is added', 'stat' => 'success']);
            } else {
                return response()->json(['message' => 'New member is not added', 'stat' => 'warning']);
            }
        } catch (Swift_TransportException $e) {
            // Handle the Swift_TransportException
            return response()->json(['message' => 'Failed to send email, please check recipient email address', 'stat' => 'warning']);
        }
        }elseif($adminCount < $plans2->admin_count && $relational['role'] === 'Admin'){
            try{
                DB::beginTransaction();
                $userMngt = DB::table('members')->insert($relational);
                if ($userMngt) {
                    Mail::to($request->input('emails'))->send(new TeamMemberReg($request->input('fullname')));
                    DB::commit();
                    return response()->json(['subscription'=>'galactic_member','message' => 'New member is added', 'stat' => 'success']);
                } else {
                    return response()->json(['message' => 'New member is not added', 'stat' => 'warning']);
                }
            } catch (Swift_TransportException $e) {
                // Handle the Swift_TransportException
                return response()->json(['message' => 'Failed to send email, please check recipient email address', 'stat' => 'warning']);
            }

        }else{

            return response()->json(['stat' => 'warning','status' => 403, 'message' => 'You have exceeded the numbers of member/admin', 'html' => $html]);

        }
}



// end of galactic
        // astral subscription

        if ($subs_id == 3 ) {

            if($memberCount < $plans3->tm_count && $relational['role'] === 'Member' ){
                try{
                DB::beginTransaction();
                $userMngt = DB::table('members')->insert($relational);
            if ($userMngt) {
                    Mail::to($request->input('emails'))->send(new TeamMemberReg($request->input('fullname')));
                    DB::commit();
                return response()->json(['subscription'=>'galactic_member','message' => 'New member is added', 'stat' => 'success']);
            } else {
                return response()->json(['message' => 'New member is not added', 'stat' => 'warning']);
            }
        } catch (Swift_TransportException $e) {
            // Handle the Swift_TransportException
            return response()->json(['message' => 'Failed to send email, please check recipient email address', 'stat' => 'warning']);
        }
        }
        elseif($adminCount < $plans3->admin_count && $relational['role'] === 'Admin')
        {
            try{

                        DB::beginTransaction();
                        $userMngt = DB::table('members')->insert($relational);
                    if ($userMngt) {
                        Mail::to($request->input('emails'))->send(new TeamMemberReg($request->input('fullname')));
                        DB::commit();
                        return response()->json(['subscription'=>'galactic_member','message' => 'New member is added', 'stat' => 'success']);
                    } else {
                        return response()->json(['message' => 'New member is not added', 'stat' => 'warning']);
                    }
                } catch (Swift_TransportException $e) {
                    // Handle the Swift_TransportException
                    return response()->json(['message' => 'Failed to send email, please check recipient email address', 'stat' => 'warning']);
                }

        }else
        {

            return response()->json(['stat' => 'warning','status' => 403, 'message' => 'You have exceeded the numbers of member/admin', 'html' => $html]);

        }
}

// end of astral
            }else{
                return response()->json(['message' => 'You are not allowed to add members please ask permission to owner', 'stat' => 'warning']);
            }

}
    public function _getedit(Request $request){



          $getMember =  DB::table('members')
                ->select('fullname as skla','email as komgks','role as lokei','api_access as kolaj','isverified as ldrof')
                ->where('id', $request->input('edit_id'))
                ->first();


            return response()->json(['server'=>$getMember,'message' => $request->input('edit_id'), 'stat' => 'warning']);




}



    public function fetchMembers(Request $request) {
        try {
            $getMembers =  DB::table('user_mngt')
                ->join('users', 'user_mngt.user_id', '=', 'users.id')
                ->select('users.*', 'user_mngt.*')
                ->where('user_mngt.main_id', $this->setDefaultId())
                ->get();


            return response()->json(['status' => 200, 'message' => 'Fetching the data', 'data' => $getMembers]);
        } catch (Exception $e) {
            $trace = $e->getTrace();
            $message = $e->getMessage();
            // Handle the error
            // Log or display the error message along with file and line number
            return response()->json(['status' => 500, 'error' => $trace, 'message' => $message]);
        }
    }

    public function _editMember(Request $request) {

        if(Auth::guard('web')->check() || Auth::guard('member')->user()->admin_access == 1){
            $adminaccess = null;
            if(  $request->input('roles')=='Admin'){
                    $adminaccess = true;
            }else{
                $adminaccess = false;
            }

        $editdataverified = [
            'fullname'=>$request->input('fullname'),
            'role'=>$request->input('roles'),
            'api_access'=>$request->input('api_access'),
            'admin_access'=>$adminaccess
        ];


        $editdatanotverified = [
            'fullname'=>$request->input('fullname'),
            'role'=>$request->input('roles'),
            'api_access'=>$request->input('api_access'),
            'admin_access'=>$adminaccess
        ];

        $member_id = $request->input('user_id');
        $isverified = DB::table('members')->where('email',$request->input('emails'))->value('isverified');

        if ($isverified) {
            DB::table('members')->where('id',$member_id)->update($editdataverified);
            return response()->json(['message' => "Email is already verified you can't edit it. Everything is updated except email",'status_m'=>'Warning!', 'stat' => 'warning']);
        }

       $updatedata =  DB::table('members')->where('id',$member_id)->update($editdatanotverified);
        if($updatedata){
            return response()->json(['status_m'=>'Success!', 'stat'=> 'success', 'message' => 'User updated successfully']);
        }else{

            return response()->json(['stat'=> 'warning','status_m'=>'Warning!', 'message' => 'Member is not updated'],422);
        }
    }else{
        return response()->json(['status_m'=>'Warning!', 'stat'=> 'warning', 'message' => 'You are not allowed to edit the member, please ask permission to owner']);
    }

}






    public function _updateMember(Request $request, $id) {
        try {
            $editUser = User::where('id', $id)->update([
                'firstname' => $request->input('firstname'),
                'lastname' => $request->input('lastname'),
                'email' => $request->input('email'),
            ]);


            if ($editUser) {
                return response()->json(['status' => 200, 'stat'=> 'success', 'message' => 'User updated successfully']);
            } else {
                return response()->json(['status' => 500, 'stat'=> 'danger', 'message' => 'Error in updating the data']);
            }

        } catch (Exception $e) {
            $trace = $e->getTrace();
            $message = $e->getMessage();
            // Handle the error
            // Log or display the error message along with file and line number
            return response()->json(['status' => 500, 'error' => $trace, 'message' => $message]);
        }
    }

    public function _deleteMember($id) {
        try {
            if(Auth::guard('web')->check()|| Auth::guard('member')->user()->admin_access == 1){


            $deleteUser = DB::table('members')->where('id', $id)->delete();

            if ($deleteUser) {
                return response()->json(['status' => 200, 'stat' => 'success', 'message' => 'Member deleted successfully.']);
            } else {
                return response()->json(['status' => 200, 'stat' => 'warning', 'message' => 'Member is not deleted successfully.']);
            }
        }else{
            return response()->json(['status' => 200, 'stat' => 'warning', 'message' => 'You are not allowed to delete this member']);
        }
        } catch (Exception $e) {
            $trace = $e->getTrace();
            $message = $e->getMessage();
            // Handle the error
            // Log or display the error message along with file and line number
            return response()->json(['status' => 500, 'error' => $trace, 'message' => $message]);
        }
    }
    public function _apiaccess(Request $request){
        try {

        if(Auth::guard('web')->check()||Auth::guard('member')->user()->admin_access == 1){
            DB::beginTransaction();
            $apiaccess = DB::table('members')->where('id', $request->input('id'))->update(['api_access' => $request->input('api_access')]);
            $roleaccess = DB::table('members')->where('id', $request->input('id'))->value('role');

            if ($apiaccess && $request->input('api_access')=== true && $roleaccess == 'Admin' ) {
                DB::commit();
                return response()->json(['stat' => 'success', 'message' => 'Admin is allowed to access api']);
            } elseif ($apiaccess && $request->input('api_access')=== false && $roleaccess == 'Admin' ){
                DB::commit();
                return response()->json(['stat' => 'success', 'message' => 'Admin is not allowed to access api']);
            }
             else {
                return response()->json(['stat' => 'warning', 'message' => 'Member is not allowed to access api']);
            }
        }else{
            return response()->json(['stat' => 'warning', 'message' => 'You are not allowed to update this please ask permission to owner']);
        }
        } catch (Exception $e) {
            $trace = $e->getTrace();
            $message = $e->getMessage();
            // Handle the error
            // Log or display the error message along with file and line number
            return response()->json(['status' => 500, 'error' => $trace, 'message' => $message]);
        }
    }
    public function _adminaccess(Request $request){


        try {
            if(Auth::guard('web')->check() || Auth::guard('member')->user()->admin_access == 1){


            $apiaccess = DB::table('members')->where('id', $request->input('id'))->update(['admin_access' => $request->input('admin_access'),'role'=>'Admin']);

            if ($apiaccess && $request->input('admin_access') === true) {
                return response()->json(['stat' => 'success', 'message' => 'Admin Access Successful']);
            } else {
               $updates= DB::table('members')->where('id', $request->input('id'))->update(['admin_access' => $request->input('admin_access'),'role'=>'Member','api_access'=>0]);
               if($updates){
                return response()->json(['stat' => 'success','api_access'=>false, 'message' => 'Admin Access is now updated']);
               }

            }
        }else{
            return response()->json(['stat' => 'warning', 'message' => 'You are not allowed to modify this']);
        }
        } catch (Exception $e) {
            $trace = $e->getTrace();
            $message = $e->getMessage();
            // Handle the error
            // Log or display the error message along with file and line number
            return response()->json(['status' => 500, 'error' => $trace, 'message' => $message]);
        }
    }
}
