<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommandModule;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class dashboardController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
		$title = 'Dashboard page';
		$date = date('Y-m-d');
		$key = 'check_subscriptions_'.$date;

		$wpdata = Cache::remember($key, now()->addMinutes(60), function () {
			return DB::table('app_usermeta')->select('*')->where('user_id', Auth::id())->get();
		});

		$wts = array();
		if (Cache::has($key)) {

			$fr = cache($key);
			foreach( $fr as $vd => $frs ) {
				$wts[$frs->meta_key] = $frs->meta_value;
			}

			// API endpoint URL
			$checkoutUrl = 'https://quantumsocial.io/wp-json/qtm/q5/verify/';
			// Authorization token
			$curl = curl_init();

			curl_setopt_array($curl, array(
			CURLOPT_URL => $checkoutUrl,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS => array(
			  'token_id_user' => $wts['wp_user_id'],
			  'code_access' => 'a81748202668f51001db39ba72830c34'
			  ),
			CURLOPT_USERNAME => $wts['wp_app_client'],
			CURLOPT_PASSWORD => $wts['wp_app_password'],
			CURLOPT_HTTPHEADER => array(
				'Authorization: '.$wts['wp_app_access'],
				),
			));

			$wp_response = curl_exec($curl);
			curl_close($curl);


			$obj = json_decode($wp_response);
			$g = array();
			$g['status'] = $obj->status;
			$g['message'] = $obj->message;
			$g['auth_renew'] = $obj->auth_renew;
			$g['subscription'] = $obj->subscription;
		}


        $hasRegularTweetsInQueue = CommandModule::where('sched_method', 'add-queue')
		->where('post_type', 'regular-tweets')
		->exists();
        // dd($hasRegularTweetsInQueue);
        $hasCustomSlot = Schedule::where('user_id', Auth::id())->get();
        // dd($hasCustomSlot);



		return view('dashboard', ['title' => $title, 'np' => $wp_response, 'hasRegularTweetsInQueue' => $hasRegularTweetsInQueue]);
        // return view('dashboard')->with('title', $title);
    }

    public function help()
    {
		$title = 'Help page';
        return view('help')->with('title', $title);
    }

}