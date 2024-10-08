<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;



use App\Models\User;
use App\Models\GeneralSettings;
use App\Models\QuantumAcctMeta;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
// use DateTime;
// use DateTimeZone;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Helpers\WP;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('update-wp', function () {
	$r = $_REQUEST;
	if(isset( $r['wp_user_id'] ) ) {

		DB::table('app_usermeta')->updateOrInsert(
        ['user_id' => $r['wp_user_id'], 'meta_key' => 'id_subscription'],
        ['meta_value' => $r['membership_plan_id']]
		);

		$user = DB::table('app_usermeta')->updateOrInsert(
        ['user_id' => $r['wp_user_id'], 'meta_key' => 'wp_subscription'],
        ['meta_value' => $r['name_subscription']]
		);

		return response()->json(['status' =>'success', 'laravel_id' => $user->id]);

	}

});



Route::get('dsboard', function () {
			if(Auth::check()){
				return redirect()->route('dashboard');

			}

})->middleware('unauthorized');



    // trial counter trial_date - now()
    // next payment next date new column
    // status new column status number
    //  1-wc-active
    // 2- wc-on-hold
    // 3- wc-cancelled
    // 4- wc-expired
    // 5 - wc-pending-cancel

    Route::get('wp', function () {
        $r = $_REQUEST;

        if(isset( $r['wp_user_id'] ) ) {



            $wp_data = WP::external_wp_rest_api($r['wp_user_id']);

            if( !is_numeric(base64_decode($r['wp_user_id']))  ) {

            
                $checkExistingEmail = base64_decode($r['wp_email']);

                if(User::where('email',$checkExistingEmail)->exists()){

                    $lv_id = User::where('email',$checkExistingEmail)->value('id');

                    return response()->json(['status' =>'error', 'laravel_id' => $lv_id]);
                }


                    switch ($wp_data['info']['product_name']) {
                        case "Membership Level - Solar":
                            $value = 1;
                            break;
                        case "Membership Level - Galactic":
                            $value = 2;
                            break;
                        case "Membership Level - Astral":
                            $value = 3;
                            break;
                        case "Solar LTD":
                            $value = 5;
                            break;
                        case "Galactic LTD":
                            $value = 6;
                            break;
                        case "Astral LTD":
                            $value = 4;
                            break;
                        default:
                            $value = null;
                            break;
                    }

                    switch ($wp_data['wc_status']) {
                        case "wc-active":
                            $status = 1;
                            break;
                        case "wc-on-hold":
                            $status = 2;
                            break;
                        case "wc-cancelled":
                            $status = 3;
                            break;
                        case "wc-expired":
                            $status = 4;
                            break;
                        case "wc-pending-cancel":
                            $status = 5;
                            break;
                        default:
                            $status = null;
                            break;
                    }
                    if($value <= 3){
                    $secretkey = 'contigosandigoalternatibomathcoboxo~~~';

                    $wppassword = 	base64_decode($r['wp_password']);

                    $decryptedpass = decryptData($wppassword,$secretkey);

                    $user = User::create([
                    'firstname' => base64_decode($r['wp_firstname']),
                    'lastname' => base64_decode($r['wp_lastname']),
                    'email' => base64_decode($r['wp_email']),
                    'password' => Hash::make($decryptedpass),
                    ]);


                    if( $user->id ) {


                        $now = date("Y-m-d");
                        $your_date = $wp_data['info']['trial_date'];
                        $datediff = strtotime($your_date) - strtotime($now);
                        $days_diff = floor($datediff / (60 * 60 * 24));

                        DB::table('users_meta')->insert([
                            'user_id' => $user->id,
                            'subscription_id' => $value,
                            'wp_user_id' => base64_decode($r['wp_user_id']),
                            'trial_counter'=>$days_diff,
                            'next_payment'=>$wp_data['info']['next_payment'],
                            'status'=>$status,
                            'timezone' =>'+00:00',
                            'queue_switch'=>1,
                            'promo_switch'=>1,
                            'evergreen_switch'=>1,
                            'trial_credits'=>25
                        ]);

                        $generalSettings = [
                            'user_id' => $user->id,
                            'toggle_1' => 0,
                            'toggle_2' => 0,
                            'toggle_3' => 0,
                            'toggle_4' => 0,
                            'toggle_5' => 0,
                            'toggle_6' => 0,
                            'toggle_7' => 0
                        ];

                        DB::table('settings_toggler_general')->insert($generalSettings);
                        DB::table('user_onboard')->insert(['user_id' => $user->id, 'onboarded' => 0, 'tour' => 0]);

                        return response()->json(['status' =>'success', 'laravel_id' => $user->id]);


                } else {
                        return response()->json(['status' =>'error', 'laravel_id' => 0]);
                }

            }else{

                $secretkey = 'contigosandigoalternatibomathcoboxo~~~';

                $wppassword = 	base64_decode($r['wp_password']);

                $decryptedpass = decryptData($wppassword,$secretkey);

                $user = User::create([
                'firstname' => base64_decode($r['wp_firstname']),
                'lastname' => base64_decode($r['wp_lastname']),
                'email' => base64_decode($r['wp_email']),
                'password' => Hash::make($decryptedpass),
                ]);


                // users_meta insertion
                DB::table('users_meta')->insert([
                    'user_id' => $user->id,
                    'subscription_id' => $value,
                    'wp_user_id' => base64_decode($r['wp_user_id']),
                    'trial_counter'=>-1,
                    'next_payment'=>'-1',
                    'status'=>1,
                    'timezone' =>'+00:00',
                    'queue_switch'=>1,
                    'promo_switch'=>1,
                    'evergreen_switch'=>1,
                    'trial_credits'=>25
                ]);
                $generalSettings = [
                    'user_id' => $user->id,
                    'toggle_1' => 0,
                    'toggle_2' => 0,
                    'toggle_3' => 0,
                    'toggle_4' => 0,
                    'toggle_5' => 0,
                    'toggle_6' => 0,
                    'toggle_7' => 0
                ];

                DB::table('settings_toggler_general')->insert($generalSettings);
                DB::table('user_onboard')->insert(['user_id' => $user->id, 'onboarded' => 0, 'tour' => 0]);

                return response()->json(['status' =>'success', 'laravel_id' => $user->id]);



            }
            } else {
                return response()->json(['status' =>'Bad Request']);
            }

        }else{
            return response()->json(['status' =>'No record found']);

        }



    });


Route::get('auth/scrape', [App\Http\Controllers\Api\V1\Auth\RegisterController::class, 'scrapeMetatags']);



function decryptData($data, $key) {
    $cipher = "aes-256-cbc";
    $data = base64_decode($data);
    $ivLength = openssl_cipher_iv_length($cipher);
    $iv = substr($data, 0, $ivLength);
    $encrypted = substr($data, $ivLength);
    return openssl_decrypt($encrypted, $cipher, $key, OPENSSL_RAW_DATA, $iv);
}

