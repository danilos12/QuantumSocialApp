<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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
                $api->user_id = Auth::id();
                $api->api_key = $request->input('api_key');
                $api->api_secret = $request->input('api_secret');
                $api->bearer_token = $request->input('bearer_token');
                $api->oauth_id = $request->input('oauth_id');
                $api->oauth_secret = $request->input('oauth_secret');
                $api->save();
                return response()->json(['status' => 200, 'stat' => 'success', 'message' => 'Master API Credentials are succesfully saved']);
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
            $findParentUser = User::find(Auth::id())->first(); 

            $insertNewMember = [
                'firstname' => $request->input('fname'),
                'lastname' => $request->input('lname'),
                'email' => $request->input('email'),
                'password' => $findParentUser->password,
            ];
            $saveMember = User::create($insertNewMember);

            $relational = [
                'main_id' => Auth::id(),
                'main_acct' => 0,
                'sub_acct'  => 1,
                'user_id' => $saveMember->id
            ];
            $userMngt = DB::table('user_mngt')->insert($relational);

            if ($saveMember && $userMngt) {
                return response()->json(['status' => 200, 'message' => 'New member added successfully']);
            }

        } catch(Exception $e) {
            $trace = $e->getTrace();
            $message = $e->getMessage();            
            // Handle the error
            // Log or display the error message along with file and line number
            return response()->json(['status' => 500, 'error' => $trace, 'message' => $message]);
        }
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

    public function _editMember($id) {
        try {                        
            $getMember = User::find($id);           
                
            if ($getMember) {
                return response()->json(['status' => 200, 'data' => $getMember]);
            }

        } catch (Exception $e) {
            $trace = $e->getTrace();
            $message = $e->getMessage();            
            // Handle the error
            // Log or display the error message along with file and line number
            return response()->json(['status' => 500, 'error' => $trace, 'message' => $message]);         
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
                return response()->json(['status' => 200, 'message' => 'User updated successfully']);
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
            $deleteUser = User::where('id', $id)->delete();

            if ($deleteUser) {
                return response()->json(['status' => 200, 'message' => 'User deleted successfully.']);
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
