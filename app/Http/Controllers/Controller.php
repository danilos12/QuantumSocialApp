<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Twitter;
use App\Models\TwitterToken;
use App\Models\UT_AcctMngt;
use App\Models\TwitterSettings;
use App\Models\TwitterSettingsMeta;
use Exception;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

     // STEP 1
    public function twitterOAuth() {
        
        // create an authorized URL 
        $url = $this->buildAuthorizedURL("https://twitter.com/i/oauth2/authorize", [
            'response_type' => 'code',
            'client_id' => env('TWITTER_CLIENT_ID'),
            'redirect_uri' => env('TWITTER_CALLBACK_URL'),
            'scope' => 'tweet.read users.read follows.read follows.write tweet.write offline.access'           
        ]);

        if ($url) {
            return redirect()->away($url);
        } else {
            return redirect('/');
        }
        
    }

    // STEP 2
    public function twitterOAuthCallback(Request $request) {

        try {

            if (isset($_GET['error'])) {
                // return redirect('/');
                // If there was an error saving data, redirect back to the previous page with an error message
                return redirect('/')->with('alert', 'Adding the account was cancelled')->with('alert_type', 'success');
    
            } else {
    
                $title = 'Profile ';
        
                $checkToken = TwitterToken::where('user_id', Auth::user()->id)->first();
        
                
                $codeVerifier = session()->get('code_verifier');
                
                $url = 'https://api.twitter.com/2/oauth2/token';
                $data = array(
                    'code' => $request->input('code'),
                    'grant_type' => 'authorization_code',
                    'client_id' => env('TWITTER_CLIENT_ID'),
                    'redirect_uri' => env('TWITTER_CALLBACK_URL'),
                    'code_verifier' => $codeVerifier
                );
        
                
                $headers = array(
                    'Content-Type: application/x-www-form-urlencoded'
                );
        
                $response = $this->curlHttpRequest($url, $headers, $data);                       
                $twitterId = $this->getTwitterdetails($response->access_token);
    
                // implement error when twitter is already saved before
                // if ($twitterId)
        
                // save the twitter details to database
                $saveTwitterInfo = Twitter::updateOrCreate([
                    'twitter_id' => $twitterId->id,
                    'twitter_username' => $twitterId->username,
                    'twitter_name' => $twitterId->name,
                    'twitter_photo' => $twitterId->profile_image_url,
                    'twitter_description' => "This is description",
                    'twitter_followersCount' => $twitterId->public_metrics->followers_count,
                    'twitter_followingCount' => $twitterId->public_metrics->following_count,
                    'twitter_tweetCount' => $twitterId->public_metrics->tweet_count,
                    'user_id' => Auth::user()->id,
                    'deleted' => 0
                ]);
                
                $saveTwitterInfo->save();        
        
                // Check if save was successful
                if ($saveTwitterInfo) {

                    // Save token to database
                    $saveToken = TwitterToken::firstOrCreate([
                        'user_id' => Auth::user()->id,
                        'twitter_id' => $twitterId->id,
                        'access_token' => $response->access_token,
                        'refresh_token' => $response->refresh_token,
                        'expires_in' => $response->expires_in,
                        'active' => 1,
                        'queue_switch' => 1
                    ]);
        
                    // save ut_user_mngt
                    $selectedAcct = UT_AcctMngt::firstOrCreate([
                        'user_id' => Auth::user()->id,
                        'twitter_id' => $twitterId->id,
                        'selected' => Twitter::where('user_id', Auth::id())->count() === 1 ? 1 : 0
                    ]);               
    
                    TwitterSettings::create([
                        'twitter_id' => $twitterId->id,
                        'toggle_1' => 0, 
                        'toggle_2' => 0, 
                        'toggle_3' => 0, 
                        'toggle_4' => 0, 
                        'toggle_5' => 0, 
                        'toggle_6' => 0, 
                        'toggle_7' => 0, 
                        'toggle_8' => 0, 
                        'toggle_9' => 0
                    ]);
    
                    TwitterSettingsMeta::create([
                        'twitter_id' => $twitterId->id,
                        'auto_reply_text' => 'Hey thank you for following (@' . $twitterId->id . ')! <br /><br />1' , 
                        'text_draft_ender' => 'If you liked this thread then please follow me (@' . $twitterId->id . ') and share this thread by retweeting the first tweet: <br /><br />1', 
                        'eg_rt_retweets' => 3, 
                        'eg_rt_likes' => 7, 
                        'he_rt_likes' => 7, 
                        'he_rt_retweets' => 3,
                        'rt_auto_time' => 3, 
                        'rt_auto_frame' => 3, 
                        'rt_auto_ite' => 3, 
                        'rt_auto_rm_time' => 3, 
                        'rt_auto_rm_frame' => 3, 
                        'text_comment_offer' => 'For more great content please follow me @' . $twitterId->id, 
                        'text_ender_dm' => 'For more great content please follow me @' . $twitterId->id, 
                    ]);
             
                    session()->put('id', Auth::id());
        
                    if ($saveToken && $selectedAcct) {
                        return redirect('profile')->with('success', 'Twitter info and access token saved successfully!');
                    } else {
                        // Error saving token, selected account, Twitter settings, or metadata
                        return response()->json([
                            'message' => 'Failed to save token, selected account, Twitter settings, or metadata.',
                        ], 500);
                    }
                                    
                }
            }
        } catch (Exception $e) {
            $trace = $e->getTrace();
            $message = $e->getMessage();            
            // Handle the error
            // Log or display the error message along with file and line number
            return response()->json(['status' => '409', 'error' => $trace, 'message' => $message]);
        }
        

        
    }    

    public function getTwitterdetails($accessToken) {    
        $headers = array(
            'Authorization: Bearer ' . $accessToken,
            'User-Agent: My Quantum App v2.0.0',
            'Content-Type: application/json'
        );
        
        $url = 'https://api.twitter.com/2/users/me?user.fields=created_at,description,public_metrics,profile_image_url';

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);            
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);


        $response = curl_exec($curl);

        if(curl_errno($curl)) {
            $error_msg = curl_error($curl);
            $error_code = curl_errno($curl);
            // handle the error
            // e.g. log the error message or show a user-friendly error message

            return response()->json(['message' => $error_msg, 'code' => $error_code]);
        } else {
            // process the result
            $result = json_decode($response);
            return $result->data;
        }       

    }
    

    public function buildAuthorizedURL($link, $params) {
        
        $state = bin2hex(random_bytes(16));

        $codeVerifier = $this->base64url_encode(random_bytes(32));

        // put  state and code verifier into session
        session()->put('code_verifier', $codeVerifier);
        session()->put('twitter_state', $state);

        // Hash the code_verifier using SHA-256
        $code_challenge = $this->base64url_encode(hash('sha256', $codeVerifier, true));
        
        // convert array to object
        $param = (object) $params;

        // create the link        
        $authorizedUrl = $link . 
            "?response_type=" . $param->response_type . 
            "&client_id=" . urlencode($param->client_id) . 
            "&redirect_uri=" . urlencode($param->redirect_uri) . 
            "&scope=" . urlencode($param->scope) . 
            "&state=" . $state . 
            "&code_challenge=". urlencode($code_challenge) . 
            "&code_challenge_method=" . 'S256';        
       

        return $authorizedUrl;
    }

    public function curlHttpRequest($url, $headers,  $data) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);            
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);


        $response = curl_exec($curl);      
        $info = curl_getinfo($curl);      

        curl_close($curl);   
        
        if ($info['http_code'] == 200) {
            $data = json_decode($response);
            return $data;
        } else {
            return curl_error($curl);
        }
        
    }
    

    function base64url_encode($data) {
        $encoded = base64_encode($data);
        $encoded = str_replace(['+', '/', '='], ['-', '_', ''], $encoded);
        return $encoded;
    }
    
}
