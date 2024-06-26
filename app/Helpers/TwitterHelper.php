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
use Illuminate\Support\Facades\Log;


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

    public static function refreshAccessToken($refreshToken, $client_id)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.twitter.com/2/oauth2/token?refresh_token=' . $refreshToken  . '&grant_type=refresh_token&client_id=' . $client_id,
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
        // dd($expires_in, $created_at, $refresh_token, $accessToken, $twitter_id);
        \Log::info('expires in: ' . print_r($expires_in, true));
        \Log::info('created at: ' . print_r($created_at, true));
        \Log::info('refresh token: ' . print_r($refresh_token, true));
        \Log::info('access token: ' . print_r($accessToken, true));
        \Log::info('twitter_id: ' . print_r($twitter_id, true));

        if (($expires_in + $created_at) <= time()) {

            $defaultId = (new self())->setDefaultId();
            $trialCredit = DB::table('users_meta')
                ->where('user_id', $defaultId)
                ->value('trial_credits');

            if($trialCredit) {
                $client_id = env('TWITTER_OAUTH_ID');
            } else {
                $client_id = TwitterHelper::getActiveAPI($defaultId)->oauth_id;
            }

            // dd($refresh_token);
            \Log::info('client_id: ' . print_r($client_id, true));
            $d = TwitterHelper::refreshAccessToken($refresh_token, $client_id);
            session()->put('token_details', $d);

            // update token in database
            $updateToken = TwitterToken::where('twitter_id', $twitter_id)
                ->where('user_id', $defaultId)
                ->update([
                    'access_token' => $d->access_token,
                    'refresh_token' => $d->refresh_token
                ]);

            if ($updateToken) {
                // Return status and token value as an associative array
                return ['status' => 200, 'token' => $d->access_token, 'message' => 'Token updated'];
            } else {
                return ['status' => 500, 'token' => $d->access_token, 'message' => 'Token not updated'];
            }
        } else {
            // Return status only
            return ['status' => 'token_valid', 'token' => $accessToken];
        }
    }


    public static function getTwitterToken($twitter_id, $user_id) {
        \Log::info('getTwitterToken twitter: ' . print_r($twitter_id, true));
        \Log::info('getTwitterToken user_id: ' . print_r($user_id, true));

        $findActiveTwitter = DB::table('twitter_accts')
            ->leftJoin('twitter_meta', 'twitter_accts.user_id', '=', 'twitter_meta.user_id')
            ->leftJoin('ut_acct_mngt', 'twitter_meta.user_id', '=', 'ut_acct_mngt.user_id')
            ->select('twitter_meta.*', 'ut_acct_mngt.selected')
            ->where('twitter_meta.user_id', '=', $user_id)
            ->where('twitter_meta.twitter_id', '=', $twitter_id)
            ->where('ut_acct_mngt.selected', '=', 1)
            // ->where('twitter_meta.active', '=',   1)
            ->first();

        \Log::info('getTwitterToken result: ' . print_r($findActiveTwitter, true));

        return $findActiveTwitter;
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

        $activeAPI = DB::table('settings_general_twapi')->where('user_id', $defaultId)->first();
        \Log::info('activeAPI: ' . print_r($activeAPI, true));
        return $activeAPI;
    }

    // API to post and retweet to twitter
    public static function tweet2twitter($twitter_meta, $data, $endpoint) {
        \Log::info('tweet2Twitter: ' . print_r($twitter_meta, true));

        // check access token
        $checkIfTokenExpired = TwitterHelper::isTokenExpired($twitter_meta['expires_in'], strtotime($twitter_meta['updated_at']), $twitter_meta['refresh_token'], $twitter_meta['access_token'], $twitter_meta['twitter_id']);
        \Log::info('checkIfTokenExpired: ' . print_r($checkIfTokenExpired, true));

        // send tweet
        $headers = array(
            // 'Authorization: Bearer ' . 11,
            'Authorization: Bearer ' . $checkIfTokenExpired['token'],
            'Content-Type: application/json'
        );

        $data = json_encode($data);
        // dd($data);

        $sendTweetNow = TwitterHelper::apiRequest($endpoint, $headers, 'POST', $data);

        Log::info('Response: ', $sendTweetNow);

        if ($sendTweetNow['status'] === 200) {
            return response()->json(['status' => 200, 'message' => 'Your tweet has been posted', 'data' => $sendTweetNow]);
        } elseif ($sendTweetNow['status'] === 403) {
            return response()->json(['status' => 403, 'message' => 'Failed to post tweet. ' . $sendTweetNow['data']->detail]);
        } else {
            return response()->json(['status' => 500, 'message' => 'Failed to send tweet', 'data' => $sendTweetNow]);
        }
    }


    /* Beginning of methods for scheduled posts in SSH */

    public static function tweet2twitterSched($twitter_meta, $data, $endpoint, $user_id) {
        \Log::info('tweet2Twitter sched: ' . print_r($twitter_meta, true));

        // check access token
        $checkIfTokenExpired = TwitterHelper::isTokenExpiredSched($twitter_meta['expires_in'], strtotime($twitter_meta['updated_at']), $twitter_meta['refresh_token'], $twitter_meta['access_token'], $twitter_meta['twitter_id'], $user_id);
        \Log::info('checkIfTokenExpired expire in: ' . print_r($twitter_meta['expires_in'], true));
        \Log::info('checkIfTokenExpired updated at: ' . print_r($twitter_meta['updated_at'], true));
        \Log::info('checkIfTokenExpired refresh token: ' . print_r($twitter_meta['refresh_token'], true));
        \Log::info('checkIfTokenExpired access token: ' . print_r($twitter_meta['access_token'], true));
        \Log::info('checkIfTokenExpired twitter id: ' . print_r($twitter_meta['twitter_id'], true));
        \Log::info('checkIfTokenExpired user id: ' . print_r($twitter_meta['user_id'], true));
        \Log::info('checkIfTokenExpired : ' . print_r($checkIfTokenExpired, true));
        // send tweet
        $headers = array(
            // 'Authorization: Bearer ' . 11,
            'Authorization: Bearer ' . $checkIfTokenExpired['token'],
            'Content-Type: application/json'
        );

        $data = json_encode($data);
        // dd($data);
        \Log::info('data: ' . print_r($data, true));

        $sendTweetNow = TwitterHelper::apiRequest($endpoint, $headers, 'POST', $data);

        \Log::info('Response: ', $sendTweetNow);

        if ($sendTweetNow['status'] === 200) {
            \Log::info('Status 200: '. print_r($sendTweetNow, true));
            return response()->json(['status' => 200, 'message' => 'Your tweet has been posted', 'data' => $sendTweetNow]);
        } elseif ($sendTweetNow['status'] === 403) {
            \Log::error('Status 403: '. print_r($sendTweetNow, true));
            return response()->json(['status' => 403, 'message' => 'Failed to post tweet. ' . $sendTweetNow['data']->detail]);
        } else {
            \Log::error('Status 500: '. print_r($sendTweetNow, true));
            return response()->json(['status' => 500, 'message' => 'Failed to send tweet', 'data' => $sendTweetNow]);
        }
    }

    public static function isTokenExpiredSched($expires_in, $created_at, $refresh_token, $accessToken, $twitter_id, $user_id) {
        \Log::info('isTokenExpiredSched expire in: ' . print_r($expires_in, true));
        \Log::info('isTokenExpiredSched updated at: ' . print_r($created_at, true));
        \Log::info('isTokenExpiredSched refresh token: ' . print_r($refresh_token, true));
        \Log::info('isTokenExpiredSched access token: ' . print_r($accessToken, true));
        \Log::info('isTokenExpiredSched twitter id: ' . print_r($twitter_id, true));
        \Log::info('isTokenExpiredSched user id: ' . print_r($user_id, true));
        if (($expires_in + $created_at) <= time()) {
            $trialCredit = DB::table('users_meta')
                ->where('user_id', $user_id)
                ->value('trial_credits');

            if($trialCredit) {
                $client_id = env('TWITTER_OAUTH_ID');
            } else {
                $client_id = TwitterHelper::getActiveAPISched($user_id);
            }

            \Log::info('client ID: ' . print_r($client_id, true));
            \Log::info('refresh ID: ' . print_r($refresh_token, true));
            $d = TwitterHelper::refreshAccessToken($refresh_token, $client_id);
            session()->put('token_details', $d);

            // update token in database
            $updateToken = TwitterToken::where('twitter_id', $twitter_id)
                ->where('user_id', $user_id)
                ->update([
                    'access_token' => $d->access_token,
                    'refresh_token' => $d->refresh_token
                ]);

            if ($updateToken) {
                \Log::info('Token Details: '. print_r($d, true));
                \Log::info('Access Token' .  print_r($d, true));
                return ['status' => 200, 'token' => $d->access_token, 'message' => 'Token updated'];
            } else {
                \Log::error('Error Token' .  print_r($d, true));
                return ['status' => 500, 'token' => $d->access_token, 'message' => 'Token not updated'];
            }
        } else {
            // Return status only
            \Log::error('Valid Token: ' .  print_r($accessToken, true));
            return ['status' => 'token_valid', 'token' => $accessToken];
        }
    }

    public static function getActiveAPISched($id) {
        // $activeAPI = DB::table('settings_general_twapi')->where('user_id', $id)->first();
        $activeAPI = DB::table('settings_general_twapi')->where('user_id', $id)->value('oauth_id');
        \Log::info('activeAPI: ' . print_r($activeAPI, true));
        return $activeAPI;
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
