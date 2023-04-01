<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Twitter;
use App\Models\TwitterToken;
use App\Models\TwitterSettingsMeta;
use App\Models\GeneralSettingsMeta;
use App\Models\QuantumAcctMeta;
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
            switch ($id) {
                case "general-settings":
                    $userId = $request->input('user_id');
                    $settings = GeneralSettingsMeta::where(['user_id' => $userId, 'meta_key' => $key])->update(['meta_value' => $value]);

                    if (!$settings) {
                        return response()->json(['success' => false, 'message' => 'Failed to update settings']);
                    }

                    $lastSavedData = GeneralSettingsMeta::where(['user_id' => $userId, 'meta_key' => $key])->pluck('meta_value')->first();

                    return response()->json(['success' => true, 'data' => $lastSavedData]);
                
                case "twitter-settings":
                    $twitterId = $request->input('twitter_id');
                    $settings = TwitterSettingsMeta::where(['twitter_id' => $twitterId, 'meta_key' => $key])->update(['meta_value' => $value]);

                    if (!$settings) {
                        return response()->json(['success' => false, 'message' => 'Failed to update settings']);
                    }
                    
                    $lastSavedData = TwitterSettingsMeta::where(['twitter_id' => $twitterId, 'meta_key' => $key])->pluck('meta_value')->first();
                    // dd($lastSavedData);
                    return response()->json(['success' => true, 'data' => $lastSavedData]);
    
                case "quantum-general-settings":
                    $subs = $request->input('subscription');

                    QuantumAcctMeta::where('user_id', $request->input('user_id'))->update(['subscription' => $subs]);

                    // dd($request);
                    $retrieveSubs = QuantumAcctMeta::where('user_id', Auth::id())->pluck('subscription');
    
                    return response()->json(['success' => true, 'data' => $retrieveSubs]);
                
                case "timezone":
                    $timezone = $request->input('timezone');
                    $userId = $request->input('user_id');
    
                    QuantumAcctMeta::where('user_id', Auth::id())->update(['timezone' => $timezone]);
                    $retrieveTimezone = QuantumAcctMeta::where('user_id', Auth::id())->pluck('timezone');

                    return response()->json(['success' => true, 'data' => $retrieveTimezone]);
                
                case "select-account":
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

                    return response()->json(['success' => true, 'data' => $selectedAcct, 'message' => 'Twitter account is now updated']);

                case "auto-reply-button": 
                    $twitterId = $request->input('twitterId');   
                    
                    $settings = TwitterSettingsMeta::where([ 'twitter_id' => $twitterId, 'meta_key' => 'auto-reply-text'])->update(['meta_value' => $request->input('value') ]);

                    if (!$settings) {
                        return response()->json(['success' => false, 'message' => 'Failed to update settings']);
                    }
                    return response()->json(['success' => true, 'data' => 'Data is updated']);
                    
                case "thread-ender-button":
                    $twitterId = $request->input('twitterId');   
                    $settings = TwitterSettingsMeta::where(['twitter_id' => $twitterId, 'meta_key' => 'text-dft-ender'])->update(['meta_value' => $request->input('value') ]);
                    
                    if (!$settings) {
                        return response()->json(['success' => false, 'message' => 'Failed to update settings']);
                    }
                    return response()->json(['success' => true, 'data' => 'Data is updated']);
                    
                    
                case "save-evergreen-clHeRetweets":
                    $twitterId = $request->input('twitterId');
                    $retweet = $request->input('retweet');
                    $likes = $request->input('likes');

                    $updateRT = TwitterSettingsMeta::where(['twitter_id' => $twitterId, 'meta_key' => 'eg_rt_retweets' ])->update(['meta_value' => $retweet  ]);
                    $updateLikes = TwitterSettingsMeta::where(['twitter_id' => $twitterId, 'meta_key' => 'eg_rt_likes'])->update(['meta_value' => $likes ]);

                    if (!$updateRT && !$updateLikes) {
                        return response()->json(['success' => false, 'message' => 'Failed to update settings']);
                    }
                    return response()->json(['success' => true, 'data' => 'Data is updated']);
                    
                case "save-evergreen-rtHeRetweets":
                    $twitterId = $request->input('twitterId');
                    $retweet = $request->input('retweet');
                    $likes = $request->input('likes');

                    $updateRT = TwitterSettingsMeta::where(['twitter_id' => $twitterId, 'meta_key' => 'he_rt_retweets' ])->update(['meta_value' => $retweet  ]);
                    $updateLikes = TwitterSettingsMeta::where(['twitter_id' => $twitterId, 'meta_key' => 'he_rt_likes'])->update(['meta_value' => $likes ]);

                    if (!$updateRT && !$updateLikes) {
                        return response()->json(['success' => false, 'message' => 'Failed to update settings']);
                    }
                    return response()->json(['success' => true, 'data' => 'Data is updated']);
                    
                case "save-autoRt":
                    $twitterId = $request->input('twitterId');
                    $time = $request->input('time');
                    $frame = $request->input('frame');
                    $ite = $request->input('ite');

                    $updateTime = TwitterSettingsMeta::where(['twitter_id' => $twitterId, 'meta_key' => 'rt_auto_time'])->update(['meta_value' => $time]);
                    $updateFrame = TwitterSettingsMeta::where(['twitter_id' => $twitterId, 'meta_key' => 'rt_auto_retweets'])->update(['meta_value' =>  $frame]);
                    $updateIte = TwitterSettingsMeta::where(['twitter_id' => $twitterId, 'meta_key' => 'rt_auto_like'])->update(['meta_value' => $ite]);

                    if (!$updateTime || !$updateFrame || !$updateIte) {
                        return response()->json(['success' => false, 'message' => 'Failed to update settings']);
                    }
                    return response()->json(['success' => true, 'data' => 'Data is updated']);
                    
                case "save-rtRm":
                    $twitterId = $request->input('twitterId');
                    $time = $request->input('time');
                    $frame = $request->input('frame');

                    $updateTime = TwitterSettingsMeta::where(['twitter_id' => $twitterId, 'meta_key' => 'rt_auto_rm_time'])->update(['meta_value' => $time]);
                    $updateFrame = TwitterSettingsMeta::where(['twitter_id' => $twitterId, 'meta_key' => 'rt_auto_rm_frame'])->update(['meta_value' => $frame]);

                    if (!$updateTime && !$updateFrame) {
                        return response()->json(['success' => false, 'message' => 'Failed to update settings']);
                    }
                    return response()->json(['success' => true, 'data' => 'Data is updated']);

                case "save-viral-autocm":
                    $twitterId = $request->input('twitterId');
                    $settings = TwitterSettingsMeta::where(['twitter_id' => $twitterId, 'meta_key' => 'text_comment_offer'])->update(['meta_value' => $request->input('value')]);

                    if (!$settings) {
                        return response()->json(['success' => false, 'message' => 'Failed to update settings']);
                    }
                    return response()->json(['success' => true, 'data' => $settings]);

                case "save-autodm":
                    $twitterId = $request->input('twitterId');
                    $settings = TwitterSettingsMeta::where(['twitter_id' => $twitterId, 'meta_key' => 'text_ender_dm'])->update(['meta_value' => $request->input('value')]);

                    if (!$settings) {
                        return response()->json(['success' => false, 'message' => 'Failed to update settings']);
                    }
                    return response()->json(['success' => true, 'data' => 'Data is updated']);
                        
                default:
                    throw new Exception('Id not found in cases.');    
            } 
        } catch(Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
        
    }    
    
}
