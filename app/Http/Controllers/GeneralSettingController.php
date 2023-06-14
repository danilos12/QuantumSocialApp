<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Twitter;
use App\Models\TwitterToken;
use App\Models\TwitterSettings;
use App\Models\TwitterSettingsMeta;
use App\Models\GeneralSettings;
use App\Models\QuantumAcctMeta;
use App\Models\TwitterApiCredentials;
use App\Models\UT_AcctMngt;
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

                    $lastSavedData = GeneralSettings::where(['user_id' => $userId, $key => $value])->pluck($key)->first();
                    break;
                
                case "twitter-settings":                    
                    $twitterId = $request->input('twitter_id');
                    $settings = TwitterSettings::where('twitter_id' , $twitterId)->update([$key => $value]);
                    
                    $lastSavedData = TwitterSettings::where(['twitter_id' => $twitterId, $key => $value])->pluck($key)->first();
                    break;
            } 
              
            if ($settings) {
                return response()->json(['status' => 200, 'message' => "Data has been updated"]);                                                                       
            }

        } catch(Exception $e) {
            $trace = $e->getTrace();
            $message = $e->getMessage();            
            // Handle the error
            // Log or display the error message along with file and line number
            return response()->json(['status' => '409', 'error' => $trace, 'message' => $message]);
        }
        
    }    
    

    public function twitterApiCredentials(Request $request, $id) {
        try {
            $api = TwitterApiCredentials::firstOrNew(['user_id' => Auth::user()->id]);
            
            if ($api->exists) {
                $api->user_id = Auth::id();
                $api->api_key = $request->input('api_key');
                $api->api_secret = $request->input('api_secret');
                $api->bearer_token = $request->input('bearer_token');
                $api->oauth_id = $request->input('oauth_id');
                $api->oauth_secret = $request->input('oauth_secret');
                $api->save();
                return response()->json(['status' => 200, 'message' => 'Master API Credentials are succesfully updated']);
            } else {
                $api->user_id = Auth::id();
                $api->api_key = $request->input('api_key');
                $api->api_secret = $request->input('api_secret');
                $api->bearer_token = $request->input('bearer_token');
                $api->oauth_id = $request->input('oauth_id');
                $api->oauth_secret = $request->input('oauth_secret');
                $api->save();
                return response()->json(['status' => 200, 'message' => 'Master API Credentials are succesfully saved']);
            }
            
        } catch (Exception $e) {
            $trace = $e->getTrace();
            $message = $e->getMessage();            
            // Handle the error
            // Log or display the error message along with file and line number
            return response()->json(['status' => '409', 'error' => $trace, 'message' => $message]);
        }
    }

    public function membershipSettings(Request $request, $id) {
        try {
            $tw = QuantumAcctMeta::where('user_id', $id)->first();
            $tw->subscription = $request->input('subscription');
            $tw->save();

            // Retrieve the recently saved data
            $updatedSubscription = $tw->subscription;
            
            return response()->json(['status' => 200, 'data' => $updatedSubscription,  'stat' => 'success', 'message' => 'Membership updated successfully']);
        } catch (Exception $e) {
            $trace = $e->getTrace();
            $message = $e->getMessage();            
            // Handle the error
            // Log or display the error message along with file and line number
            return response()->json(['status' => '409', 'error' => $trace,  'stat' => 'error', 'message' => $message]);
        }
    }
    
    public function timezoneSettings(Request $request, $id) {
        try {
            $tw = QuantumAcctMeta::where('user_id', $id)->first();
            $tw->timezone = $request->input('timezone');   
            $tw->save();

            // Retrieve the recently saved data
            $updatedTimezone = $tw->timezone;            
            return response()->json(['status' => 200, 'data' => $updatedTimezone, 'stat' => 'success' ,'message' => 'Timezone updated successfully']);
          
        } catch (Exception $e) {
            $trace = $e->getTrace();
            $message = $e->getMessage();            
            // Handle the error
            // Log or display the error message along with file and line number
            return response()->json(['status' => '409', 'stat' => 'error' , 'error' => $trace, 'message' => $message]);
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
            return response()->json(['status' => '409', 'error' => $trace, 'message' => $message]);
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
            }

            
        } catch (Exception $e) {
            $trace = $e->getTrace();
            $message = $e->getMessage();            
            // Handle the error
            // Log or display the error message along with file and line number
            return response()->json(['status' => '409', 'stat' => 'success', 'error' => $trace, 'message' => $message]);
        }
    }
}
