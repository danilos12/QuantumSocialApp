<?php

namespace App\Helpers;

use App\Http\Controllers\TwitterApi;
use App\Models\TwitterToken;
use Carbon\Carbon;
use App\Models\QuantumAcctMeta;
use App\Models\MasterTwitterApiCredentials;
use App\Models\Twitter;
use Illuminate\Support\Facades\Auth;


class TwitterHelper
{
    public static function refreshAccessToken($refreshToken)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.twitter.com/2/oauth2/token?refresh_token=' . $refreshToken  . '&grant_type=refresh_token&client_id=' . TwitterHelper::getActiveAPI(Auth::id())->oauth_id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded',
                'Cookie: guest_id=v1%3A167698806120814768; guest_id_ads=v1%3A167698806120814768; guest_id_marketing=v1%3A167698806120814768; personalization_id="v1_c/rVbz9sH+phQ/F7c4ZfMg=="'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return json_decode($response);
    }

    public static function getTwitterdetails($accessToken)
    {      
        $checkIfTokenExpired = TwitterHelper::isTokenExpired($accessToken->expires_in ,strtotime($accessToken->updated_at), $accessToken->refresh_token, $accessToken->access_token, $accessToken->twitter_id);  

        $headers = array(
            'Authorization: Bearer ' . $checkIfTokenExpired['token'],
            'User-Agent: App v2.0.0',
            'Content-Type: application/json'
        );

        $url = 'https://api.twitter.com/2/users/me?user.fields=created_at,description,public_metrics,profile_image_url';

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);


        $response = curl_exec($curl);
        curl_close($curl);

        if (curl_errno($curl)) {
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

    public static function isTokenExpired($expires_in, $created_at, $refresh_token, $accessToken, $twitter_id) {

        if (($expires_in + $created_at) <= time()) {
            $d = TwitterHelper::refreshAccessToken($refresh_token);
            session()->put('token_details', $d);
            // dd($d);

            // update token in database
            TwitterToken::where('twitter_id', $twitter_id)
                ->update([
                    'access_token' => $d->access_token,
                    'refresh_token' => $d->refresh_token
                ]);

            // Return status and token value as an associative array
            return ['status' => 'success', 'token' => $d->access_token];
        } else {
            // Return status only
            return ['status' => 'token_valid', 'token' => $accessToken];
        }
    }

    public static function getTwitterToken($twitter_id) {       

        $findActiveTwitter = Twitter::join('twitter_meta', 'twitter_accts.twitter_id', '=', 'twitter_meta.twitter_id')
            ->join('ut_acct_mngt', 'twitter_meta.user_id', '=', 'ut_acct_mngt.user_id')
            ->select('twitter_accts.*', 'twitter_meta.*', 'ut_acct_mngt.selected')
            ->where('twitter_accts.twitter_id', '=', $twitter_id)
            ->where('twitter_accts.deleted', '=', 0)
            ->where('twitter_accts.user_id', '=', Auth::id())
            ->where('ut_acct_mngt.selected', '=', 1)
            ->where('twitter_meta.active', '=',   1)
            ->first();

        return $findActiveTwitter;
    }
    

    public static function executeAfterFiveHoursFromLastUpdate($lastUpdated)
    {
        // Convert the last update time to a Carbon object
        $lastUpdated = Carbon::parse($lastUpdated);

        // Add 5 hours to the last update time
        $executeTime = $lastUpdated->addHours(5);

        // Check if the current time is greater than or equal to the execute time
        if (Carbon::now()->gte($executeTime)) {
            // Execute the script here
            // ...
        }
    }

    public static function now($id) {
        $acctMeta = QuantumAcctMeta::where('user_id', $id)->first();
        $utc = Carbon::now($acctMeta->timezone);

        return $utc;       
    }
    
    public static function timezone($id) {
        $acctMeta = QuantumAcctMeta::where('user_id', $id)->first();
        return $acctMeta->timezone;       
    }

    public static function getActiveAPI($id) {
        $activeAPI = MasterTwitterApiCredentials::where('user_id', $id)->first();
        return $activeAPI;
    }

}
