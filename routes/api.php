<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Auth\RegisterController;
use App\Models\User;
use App\Models\GeneralSettings;
use App\Models\QuantumAcctMeta;

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

Route::get('wp', function () {
	$r = $_REQUEST;

	if(isset( $r['wp_user_id'] ) ) {

		if( !is_numeric($r['wp_user_id'])  ) {

				$user = User::create([
				'firstname' => $r['wp_firstname'],
				'lastname' => $r['wp_lastname'],
				'email' => $r['wp_email'],
				'password' => Hash::make($r['wp_password']),
				]);


				if( $user->id ) {
					DB::table('app_usermeta')->insert([
						['user_id' => $user->id, 'meta_key' => 'wp_user_id', 'meta_value' => $r['wp_user_id']],
						['user_id' => $user->id, 'meta_key' => 'id_subscription', 'meta_value' => $r['wp_subscription']],
						['user_id' => $user->id, 'meta_key' => 'wp_subscription', 'meta_value' => $r['name_subscription']],
					]);
					
					return response()->json(['status' =>'success', 'laravel_id' => $user->id]);

			} else {
					return response()->json(['status' =>'error', 'laravel_id' => 0]);
			}


		} else {
			return response()->json(['status' =>'Bad Request']);
		}

	}

	return response()->json(['status' =>'not available']);


});

Route::post('auth/register', RegisterController::class); // Define route using RegisterController method
// Route::post('auth/register', RegisterController::class)->middleware('auth');

Route::get('scrape/', [RegisterController::class, 'scrapeMetaTags']);

