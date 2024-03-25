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
            $userid;
        if(Auth::guard('web')->check()){
            $userid = Auth::id();
        }elseif(Auth::guard('member')->user()){
            $userid =  self::membercurrent();

        }


        $subscription = DB::table('users_meta')
            ->join('plans', 'users_meta.subscription_id', 'plans.subscription_id')
            ->where('users_meta.user_id',$userid)
            ->first();

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

}