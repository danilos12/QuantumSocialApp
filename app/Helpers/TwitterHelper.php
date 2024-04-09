<?php

namespace App\Helpers;

use App\Http\Controllers\TwitterApi;
use App\Models\TwitterToken;
use Carbon\Carbon;
use App\Models\QuantumAcctMeta;
use App\Models\MasterTwitterApiCredentials;
use App\Models\Twitter;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class TwitterHelper
{
    protected function setDefaultId()
    {
        if (Auth::guard('web')->check()) {
            return $this->defaultid = Auth::id();
        }
        if (Auth::guard('member')->check()) {
            return $this->defaultid = MembershipHelper::membercurrent();
        }
    }
    public static function refreshAccessToken($refreshToken)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.twitter.com/2/oauth2/token?refresh_token=' . $refreshToken  . '&grant_type=refresh_token&client_id=dXd6Y2FLLTU2N09lbmEzNER2YWs6MTpjaQ',
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

        // dd($expires_in + $created_at, time());
        if (($expires_in + $created_at) <= time()) {
            $d = TwitterHelper::refreshAccessToken($refresh_token);
            session()->put('token_details', $d);

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
        $defaultId = (new self())->setDefaultId();
        $findActiveTwitter = Twitter::join('twitter_meta', 'twitter_accts.twitter_id', '=', 'twitter_meta.twitter_id')
            ->join('ut_acct_mngt', 'twitter_meta.user_id', '=', 'ut_acct_mngt.user_id')
            ->select('twitter_accts.*', 'twitter_meta.*', 'ut_acct_mngt.selected')
            ->where('twitter_accts.twitter_id', '=', $twitter_id)
            ->where('twitter_accts.deleted', '=', 0)
            ->where('twitter_accts.user_id', '=', $defaultId)
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

        $defaultId = (new self())->setDefaultId();
        $acctMeta = QuantumAcctMeta::where('user_id', $defaultId)->first();
        $datetime = Carbon::now($acctMeta->timezone);

        // Convert the datetime to UTC
        $utc = $datetime->utc();
        return $utc;
    }

    public static function timezone($id) {
        $defaultId = (new self())->setDefaultId();
        $acctMeta = QuantumAcctMeta::where('user_id', $defaultId)->first();
        return $acctMeta->timezone;
    }

    public static function getActiveAPI($id) {
        $defaultId = (new self())->setDefaultId();
        $activeAPI = MasterTwitterApiCredentials::where('user_id', $defaultId)->first();
        return $activeAPI;
    }

    // API to post and retweet to twitter
    public static function tweet2twitter($twitter_meta, $data, $endpoint) {

        // check access token
        $checkIfTokenExpired = TwitterHelper::isTokenExpired($twitter_meta['expires_in'], strtotime($twitter_meta['updated_at']), $twitter_meta['refresh_token'], $twitter_meta['access_token'], $twitter_meta['twitter_id']);

        // send tweet
        $headers = array(
            // 'Authorization: Bearer ' . 11,
            'Authorization: Bearer ' . $checkIfTokenExpired['token'],
            'Content-Type: application/json'
        );

        $data = json_encode($data);        

        $sendTweetNow = TwitterHelper::apiRequest($endpoint, $headers, 'POST', $data);

        if ($sendTweetNow['status'] === 200) {
            return response()->json(['status' => 200, 'message' => 'Your tweet has been posted', 'data' => $sendTweetNow]);
        } elseif ($sendTweetNow['status'] === 403) {
            return response()->json(['status' => 403, 'message' => 'Failed to post tweet. ' . $sendTweetNow['data']->detail]);
        } else {
            return response()->json(['status' => 500, 'message' => 'Failed to send tweet', 'data' => $sendTweetNow]);
        }
    }


    public static function apiRequest($url, $headers, $method, $data)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_ENCODING, '');
        curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
        curl_setopt($curl, CURLOPT_TIMEOUT, 0);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);

        if ($method === 'POST') {
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        } else {
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
        }

        $response = curl_exec($curl);
        $info = curl_getinfo($curl);

        curl_close($curl);

        if ($info['http_code'] == 403) {
            $data = [
                "data" => json_decode($response),
                "status" => 403
            ];

            return $data;
        } else {
            $data = [
                "data" => json_decode($response),
                "status" => 200
            ];

            return $data;
        }
    }

}
