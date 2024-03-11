<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Swift_TransportException;
use Illuminate\Support\Facades\Log;
use App\Models\Twitter;
use App\Models\TwitterToken;
use App\Models\TwitterSettings;
use App\Models\TwitterSettingsMeta;
use App\Models\GeneralSettings;
use App\Models\MasterTwitterApiCredentials;
use App\Models\QuantumAcctMeta;
use App\Models\TwitterApiCredentials;
use App\Models\UT_AcctMngt;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\TeamMemberReg;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



class GeneralSettingController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
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
                return response()->json(['status' => 400, 'stat' => 'danger', 'message' => 'Failed to update your membership.']);
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
                ->where('ut_acct_mngt.user_id', Auth::id())
                ->update(['toggle_10' => $request->toggle]);

            // Retrieve the updated toggle_10 value
            $settings = TwitterSettings::join('ut_acct_mngt', 'ut_acct_mngt.twitter_id', 'settings_twitter.twitter_id')
                ->where('ut_acct_mngt.user_id', Auth::id())
                ->first();

            $toggle_10 = $settings->toggle_10;

            if ($toggle_10 === 1) {
                // Find the existing record or create a new one
                $credentials = TwitterApiCredentials::updateOrCreate(
                    ['user_id' => Auth::id()],
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
        $lastSavedData = GeneralSettings::where('user_id', Auth::id())->first();
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
        }

        return $html;
    }

    public function saveTwitterApi(Request $request, $twitter_id) {

        try {
            // dd($request, $twitter_id);
            $saveTwitterApi = TwitterApiCredentials::where('user_id', Auth::id())->first();
            $saveTwitterApi->twitter_id = $twitter_id;
            $saveTwitterApi->api_key = $request->input('api_key');
            $saveTwitterApi->api_secret = $request->input('api_secret');
            $saveTwitterApi->bearer_token = $request->input('bearer_token');
            $saveTwitterApi->access_token = $request->input('access_token');
            $saveTwitterApi->token_secret = $request->input('token_secret');
            $saveTwitterApi->save();

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

    public function twitterApiCredentials(Request $request, $id) {
        try {
            $api = MasterTwitterApiCredentials::firstOrNew(['user_id' => Auth::user()->id]);

            if ($api->exists) {
                $api->user_id = Auth::id();
                $api->api_key = $request->input('api_key');
                $api->api_secret = $request->input('api_secret');
                $api->bearer_token = $request->input('bearer_token');
                $api->oauth_id = $request->input('oauth_id');
                $api->oauth_secret = $request->input('oauth_secret');
                $api->save();
                return response()->json(['status' => 200, 'stat' => 'success', 'message' => 'Master API Credentials are succesfully updated']);
            } else {
                $api = new MasterTwitterApiCredentials($request->all());
                $api->user_id = Auth::id();
                $api->save();
                return response()->json(['status' => 200, 'stat' => 'success', 'message' => 'Master API Credentials are successfully saved']);
            }

        } catch (Exception $e) {
            $trace = $e->getTrace();
            $message = $e->getMessage();
            // Handle the error
            // Log or display the error message along with file and line number
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
            UT_AcctMngt::where(['twitter_id'=> $twitterId, 'user_id' => Auth::id()])->update(['selected' => $selectAcct]);
            $updatedRecord = UT_AcctMngt::where(['twitter_id' => $twitterId, 'user_id' => Auth::id()])->select('twitter_id')->first();

            // Retrieve the twitter_id value from the updated record
            $twitterId = $updatedRecord->twitter_id;

            // set others to false
            UT_AcctMngt::where('user_id', Auth::id())->where('twitter_id', '!=', $twitterId)->update(['selected' => 0]);

            // retrieve updated data
            $selectedAcct = UT_AcctMngt::where(['twitter_id' => $twitterId, 'user_id' => Auth::id()])->pluck('selected');

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
            $settings = [];
            foreach ($request->request as $parameter) {
                $key = $parameter['key'];
                $value = $parameter['value'];

                $settings = TwitterSettingsMeta::where('twitter_id', $twitter_id)->update([$key => $value]);
            }

            if ($settings) {
                return response()->json(['status' => 200, 'stat' => 'success', 'message' => 'Data is updated']);
            } else {
                return response()->json(['status' => 400, 'stat' => 'danger', 'message' => 'Failed to update.']);
            }

        } catch (Exception $e) {
            $trace = $e->getTrace();
            $message = $e->getMessage();
            // Handle the error
            // Log or display the error message along with file and line number
            return response()->json(['status' => 500, 'stat' => 'danger', 'error' => $trace, 'message' => $message]);
        }
    }




    public function addNewMember(Request $request) {
        try {
            // Your existing code for adding a new member and sending an email goes here...
            $userId = Auth::id();

            // Retrieve the subscription status from the users_meta table
            $subscription = DB::table('users_meta')
                ->leftJoin('members', 'users_meta.user_id', '=', 'members.account_holder_id')
                ->select('users_meta.subscription')
                ->where('users_meta.user_id', $userId)
                ->groupBy('users_meta.subscription')
                ->first();


                $email = $request->input('emails');
            // Check if the subscription exists and handle accordingly
            if (!$subscription->subscription) {
                return response()->json(['message' => 'Subscription not found', 'stat'=> 'warning']);
            }
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
            $hasaccess;
            $randomPassword = Str::random(10);
            if($request->input('Admin')==='Admin'){
                $hasaccess = true;
            }else{
                $hasaccess= false;
            }
            $relational = [
                'account_holder_id' => Auth::id(),
                'fullname' => $request->input('fullname'),
                'email' => $request->input('emails'),
                'role' => $request->input('roles'),
                'api_access' => $request->input('api_access'),
                'admin_access' => $hasaccess,
                'password' => $randomPassword,
                'isverified' => false,
                'tokens' => ''
            ];



            // // Check the subscription type and count limits
// solar subscription
        if ($subscription->subscription == 'solar' ) {
            if($memberCount < 0 && $relational['role'] === 'Member' ){

                    $userMngt = DB::table('members')->insert($relational);
                    if ($userMngt) {
                        Mail::to($request->input('emails'))->send(new TeamMemberReg($request->input('fullname')));
                        return response()->json(['subscription'=>'galactic_member','message' => 'New member is added', 'stat' => 'success']);
                    } else {
                        return response()->json(['message' => 'New member is not added', 'stat' => 'warning']);
                    }
            }elseif($adminCount < 1 && $relational['role'] === 'Admin'){


                        $userMngt = DB::table('members')->insert($relational);
                    if ($userMngt) {
                        Mail::to($request->input('emails'))->send(new TeamMemberReg($request->input('fullname')));
                        return response()->json(['subscription'=>'galactic_member','message' => 'New member is added', 'stat' => 'success']);
                    } else {
                        return response()->json(['message' => 'New member is not added', 'stat' => 'warning']);
                    }

        }  else{
            return response()->json(['message' => 'You have exceeded the numbers of member/admin', 'stat' => 'warning']);
        }
}


// end of solar

// galactic subscription

if ($subscription->subscription == 'galactic' ) {
    if($memberCount < 5 && $relational['role'] === 'Member' ){

            $userMngt = DB::table('members')->insert($relational);

            if ($userMngt) {
                Mail::to($request->input('emails'))->send(new TeamMemberReg($request->input('fullname')));
                return response()->json(['subscription'=>'galactic_member','message' => 'New member is added', 'stat' => 'success']);
            } else {
                return response()->json(['message' => 'New member is not added', 'stat' => 'warning']);
            }
        }elseif($adminCount < 3 && $relational['role'] === 'Admin'){


                    $userMngt = DB::table('members')->insert($relational);

                if ($userMngt) {
                    Mail::to($request->input('emails'))->send(new TeamMemberReg($request->input('fullname')));
                    return response()->json(['subscription'=>'galactic_member','message' => 'New member is added', 'stat' => 'success']);
                } else {
                    return response()->json(['message' => 'New member is not added', 'stat' => 'warning']);
                }

        }else{
            return response()->json(['message' => 'You have exceeded the numbers of member/admin', 'stat' => 'warning']);
    }
}



// end of galactic
        // astral subscription

        if ($subscription->subscription == 'astral' ) {
            if($memberCount < 10 && $relational['role'] === 'Member' ){

                $userMngt = DB::table('members')->insert($relational);
            if ($userMngt) {
                Mail::to($request->input('emails'))->send(new TeamMemberReg($request->input('fullname')));
                return response()->json(['subscription'=>'galactic_member','message' => 'New member is added', 'stat' => 'success']);
            } else {
                return response()->json(['message' => 'New member is not added', 'stat' => 'warning']);
            }
        }
        elseif($adminCount < 5 && $relational['role'] === 'Admin')
        {


                    $userMngt = DB::table('members')->insert($relational);
                    if ($userMngt) {
                        Mail::to($request->input('emails'))->send(new TeamMemberReg($request->input('fullname')));
                        return response()->json(['subscription'=>'galactic_member','message' => 'New member is added', 'stat' => 'success']);
                    } else {
                        return response()->json(['message' => 'New member is not added', 'stat' => 'warning']);
                    }

        }else
        {
            return response()->json(['message' => 'You have exceeded the numbers of member/admin', 'stat' => 'warning']);
        }
}

// end of astral

        } catch (Swift_TransportException $e) {
            // Handle the Swift_TransportException
            return response()->json(['message' => 'Failed to send email, please check recipient email address', 'stat' => 'warning']);
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
                ->where('user_mngt.main_id', Auth::id())
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
        $editdataverified = [
            'fullname'=>$request->input('fullname'),
            'role'=>$request->input('roles'),
            'api_access'=>$request->input('api_access'),
        ];
        $editdatanotverified = [
            'fullname'=>$request->input('fullname'),
            'email'=>$request->input('emails'),
            'role'=>$request->input('roles'),
            'api_access'=>$request->input('api_access'),
        ];
        $member_id = $request->input('user_id');
        $isverified = DB::table('members')->where('email',$request->input('emails'))->value('isverified');

        if ($isverified) {
            DB::table('members')->where('id',$member_id)->update($editdataverified);
            return response()->json(['message' => "Email is already verified you can't edit it. Everything is updated except email",'status_m'=>'Warning!', 'stat' => 'warning']);
        }

       $updatedata =  DB::table('members')->where('id',$member_id)->update($editdatanotverified);
        if($updatedata){
            return response()->json(['data_server' => $editdata,'status_m'=>'Success!', 'stat'=> 'success', 'message' => 'User updated successfully']);
        }else{

            return response()->json(['stat'=> 'warning','status_m'=>'Warning!', 'message' => 'Member is not updated'],422);
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
            $deleteUser = DB::table('members')->where('id', $id)->delete();

            if ($deleteUser) {
                return response()->json(['status' => 200, 'stat' => 'success', 'message' => 'Member deleted successfully.']);
            } else {
                return response()->json(['status' => 200, 'stat' => 'danger', 'message' => 'Member is not deleted successfully.']);
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
            $apiaccess = DB::table('members')->where('id', $request->input('id'))->update(['api_access' => $request->input('api_access')]);

            if ($apiaccess && $request->input('api_access')=== true) {
                return response()->json(['stat' => 'success', 'message' => 'Member is allowed to access api']);
            } else {
                return response()->json(['stat' => 'warning', 'message' => 'Member is not allowed to access api']);
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
            $apiaccess = DB::table('members')->where('id', $request->input('id'))->update(['admin_access' => $request->input('admin_access')]);

            if ($apiaccess && $request->input('admin_access')=== true) {
                return response()->json(['stat' => 'success', 'message' => 'Admin Access Successful']);
            } else {
                return response()->json(['stat' => 'warning', 'message' => 'Admin Access not Allowed']);
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
