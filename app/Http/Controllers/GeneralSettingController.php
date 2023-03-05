<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Twitter;
use App\Models\TwitterToken;
use App\Models\TwitterSettingsMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;



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

    public function save(Request $request) {
        // dd($request);

        // $data = $request->input('settings');
        $key = $request->input('meta_key');
        $value = $request->input('meta_value');
        $twitterid = $request->input('twitter_id');        

        // Replace 'userId' with the actual user ID of the logged-in user
        $settings = TwitterSettingsMeta::where(['twitter_id' => $twitterid, 'meta_key' => $key])->update(['meta_value' => $value]);


        return response()->json(['success' => true, 'data' => $settings]);
    }


    public function removeTwitterAccount() {

    }
}
