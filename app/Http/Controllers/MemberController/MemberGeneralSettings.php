<?php
namespace App\Http\Controllers\MemberController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\MembershipHelper;
use App\Models\Tag_groups;
use App\Models\GeneralSettings;
use App\Models\Twitter;
use App\Models\TwitterToken;
use App\Models\TwitterSettings;
use App\Models\TwitterSettingsMeta;
use App\Models\MasterTwitterApiCredentials;
use App\Models\QuantumAcctMeta;
use App\Models\TwitterApiCredentials;
use App\Models\UT_AcctMngt;


class MemberGeneralSettings extends Controller
{
    public function __construct(){
        $this->middleware('member-access');
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


    public function twitterApiCredentials(Request $request, $id) {
        try {
            $api = MasterTwitterApiCredentials::firstOrNew(['user_id' => MembershipHelper::membercurrent()]);

            if ($api->exists) {
                $api->user_id = MembershipHelper::membercurrent();
                $api->api_key = $request->input('api_key');
                $api->api_secret = $request->input('api_secret');
                $api->bearer_token = $request->input('bearer_token');
                $api->oauth_id = $request->input('oauth_id');
                $api->oauth_secret = $request->input('oauth_secret');
                $api->save();
                return response()->json(['status' => 200, 'stat' => 'success', 'message' => 'Master API Credentials are succesfully updated']);
            } else {
                $api = new MasterTwitterApiCredentials($request->all());
                $api->user_id = MembershipHelper::membercurrent();
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
            UT_AcctMngt::where(['twitter_id'=> $twitterId, 'user_id' => MembershipHelper::membercurrent()])->update(['selected' => $selectAcct]);
            $updatedRecord = UT_AcctMngt::where(['twitter_id' => $twitterId, 'user_id' => MembershipHelper::membercurrent()])->select('twitter_id')->first();

            // Retrieve the twitter_id value from the updated record
            $twitterId = $updatedRecord->twitter_id;

            // set others to false
            UT_AcctMngt::where('user_id', MembershipHelper::membercurrent())->where('twitter_id', '!=', $twitterId)->update(['selected' => 0]);

            // retrieve updated data
            $selectedAcct = UT_AcctMngt::where(['twitter_id' => $twitterId, 'user_id' => MembershipHelper::membercurrent()])->pluck('selected');

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
            $userId = MembershipHelper::membercurrent();

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
            $hasaccess;
            $randomPassword = Str::random(10);
            if($request->input('Admin')==='Admin'){
                $hasaccess = true;
            }else{
                $hasaccess= false;
            }
            $relational = [
                'account_holder_id' => MembershipHelper::membercurrent(),
                'fullname' => $request->input('fullname'),
                'email' => $request->input('emails'),
                'role' => $request->input('roles'),
                'api_access' => $request->input('api_access'),
                'admin_access' => $hasaccess,
                'password' => $randomPassword,
                'isverified' => false,
                'tokens' => ''
            ];



            // Check the subscription type and count limits
            // solar subscription
        if ($subs_id == 1 ) {

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

if ($subs_id == 2 ) {

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

        if ($subs_id == 3 ) {

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

}