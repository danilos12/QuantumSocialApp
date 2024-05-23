<?php

namespace App\Helpers;

use App\Http\Controllers\TwitterApi;
use App\Models\TwitterToken;
use Carbon\Carbon;
use App\Models\QuantumAcctMeta;
use App\Models\MasterTwitterApiCredentials;
use App\Models\Twitter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class MembershipHelper
{
    public static function tier($id) {

        $subscription = DB::table('users_meta')
            ->join('plans', 'users_meta.subscription_id', 'plans.id')
            ->where('users_meta.user_id', $id)
            ->select(
                'users_meta.*', 
                'plans.*',
            )
            ->first();
        // dd($subscription);
        return $subscription;

    }

    public static function membercurrent() {
            $user = Auth::guard('member')->user();
            $member_id = $user->id;


            $acct_hdid = DB::table('members')
            ->where('id', $member_id)
            ->value('account_holder_id');

        return $acct_hdid;
    }

    public static function memberaccthemail() {
            $user = Auth::guard('member')->user();
            $member_id = $user->id;


            $acct_hdid = DB::table('members')
            ->where('id', $member_id)
            ->value('account_holder_id');

            $acctemail =DB::table('users')
            ->where('id', $acct_hdid)
            ->value('email');

        return $acctemail;
    }

    public static function twitterAcct($id) {
        $twitter = Twitter::where('user_id', $id)->count();
        return $twitter;
    }

   

    // wp api connection
    public static function apiGetCurl($url) {
        // Initialize cURL session
        $ch = curl_init($url);

        // Set cURL options
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        // Execute cURL session
        $response = curl_exec($ch);

        // Get the HTTP status code
        $httpStatusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        // Close cURL session
        curl_close($ch);

        return ['response' => $response, 'httpStatusCode' => $httpStatusCode];
    }
}
