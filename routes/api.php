<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Auth\RegisterController;
use App\Models\User;
use App\Models\GeneralSettings;
use App\Models\QuantumAcctMeta;
use Illuminate\Support\Facades\Http;
// use DateTime;
// use DateTimeZone;
use Illuminate\Support\Facades\DB;






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

		DB::table('app_usermeta')->updateOrInsert(
        ['user_id' => $r['wp_user_id'], 'meta_key' => 'wp_subscription'],
        ['meta_value' => $r['name_subscription']]
		);

		return response()->json(['status' =>'success', 'laravel_id' => $user->id]);

	}

});




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
				

		$response = Http::get('https://quantumsocial.io/wp-json/plan/membership/subscription?wp_user_id='.base64_decode($r['wp_user_id']));
		$wp_data = $response->json();


		if( !is_numeric(base64_decode($r['wp_user_id']))  ) {


			

				if ($wp_data['info']['product_name'] == "Solar") {
					$value = 1;
				} elseif ($wp_data['info']['product_name'] == "Galactic") {
					$value = 2;
				} elseif ($wp_data['info']['product_name'] == "Astral") {
					$value = 3;
				} else{
					$value = null;
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
					DB::table('app_usermeta')->insert([
						['user_id' => $user->id, 'meta_key' => 'wp_user_id', 'meta_value' => base64_decode($r['wp_user_id'])],
						['user_id' => $user->id, 'meta_key' => 'subscription_name', 'meta_value' => $wp_data['info']['product_name']],
				
				
					]);
					$now = strtotime(date("Y/m/d")); 
					$your_date = strtotime($wp_data['info']['trial_date']);
					$datediff = $your_date - $now;
					$days_diff = floor($datediff / (60 * 60 * 24));
		

					DB::table('users_meta')->insert([
						'user_id' => $user->id,
						'subscription_id' => $value,
						'wp_subscription_id'=>base64_decode($r['wp_user_id']),
						'trial_counter'=>$days_diff,
						'next_payment'=>$wp_data['info']['next_payment'],
						'status'=>$status,
						'timezone' =>'+00:00',
						'queue_switch'=>0,
						'promo_switch'=>0,
						'evergreen_switch'=>0
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

					DB::table('settings_general')->insert($generalSettings);

					return response()->json(['status' =>'success', 'laravel_id' => $user->id]);


			} else {
					return response()->json(['status' =>'error', 'laravel_id' => 0]);
			}


		} else {
			return response()->json(['status' =>'Bad Request']);
		}

	}else{
		return response()->json(['status' =>'No record found']);

	}



});

Route::post('auth/register', RegisterController::class); // Define route using RegisterController method


Route::get('scrape/', [RegisterController::class, 'scrapeMetaTags']);


function decryptData($data, $key) {
    $cipher = "aes-256-cbc";
    $data = base64_decode($data);
    $ivLength = openssl_cipher_iv_length($cipher);
    $iv = substr($data, 0, $ivLength);
    $encrypted = substr($data, $ivLength);
    return openssl_decrypt($encrypted, $cipher, $key, OPENSSL_RAW_DATA, $iv);
}

