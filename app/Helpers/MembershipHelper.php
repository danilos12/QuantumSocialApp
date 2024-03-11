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
            ->join('plans', 'users_meta.subscription_id', 'plans.subscription_id')
            ->where('users_meta.user_id', Auth::id())
            ->first();
            
        return $subscription;    
    }
}