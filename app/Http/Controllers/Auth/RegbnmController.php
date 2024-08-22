<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB; 


class RegbnmController extends Controller
{	
	 public function __construct()
    {
        $this->middleware('guest');
    }

    public function showCustomRegister()
    {      
        return view('auth.carlo');
    }

    public function wpRegisterUser(Request $request)
    {
		
		
		$validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);
		
        if ($validator->fails()) {
			return response()->json(['status' => 'error', 'message' => 'Request failed']);
        }
		
		$email = DB::table('users')->where('email', $request->input('email'))->doesntExist();
		
		if( $email ) {
			// Prepare data for the cURL request
			$requestData = array(
				'email_address' => $request->input('email'),
				'access_level' => $request->input('access_level'),
				'wp_scope' => 'bisaya',
			);
			
			
			// API endpoint URL
		   $checkoutUrl = 'https://quantumsocial.io/wp-json/qts/v5/save/';

			// Authorization token
			$authorizationToken = '21c4225f316a7c95e663f39c9a6de49b';
			
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
				  CURLOPT_POSTFIELDS => $requestData,
				  CURLOPT_HTTPHEADER => array(
					'Authorization: 21c4225f316a7c95e663f39c9a6de49b',
				  ),
				));

				$wp_response = curl_exec($curl);
				curl_close($curl);
			
			$obj = json_decode($wp_response);
			
			if( $obj->status == 'error' ) {
				return response()->json(['status' => 'error','message' => 'Invalid Request']);
			}	
			
			if( $obj->status == 'success' ) {
				$user = User::create([
				'email' => $obj->create_account->email_address,
				'password' => Hash::make($obj->create_account->password),
				]);
				
				if( $user->id ) {
					DB::table('app_usermeta')->insert([
						['user_id' => $user->id, 'meta_key' => 'wp_user_id', 'meta_value' => $obj->wp_meta->wp_user_id],
						['user_id' => $user->id, 'meta_key' => 'id_subscription', 'meta_value' => $obj->wp_meta->id_subscription],
						['user_id' => $user->id, 'meta_key' => 'wp_subscription', 'meta_value' => $obj->wp_meta->access_subscription],
						['user_id' => $user->id, 'meta_key' => 'wp_app_access', 'meta_value' => $obj->wp_meta->wp_app_access],
						['user_id' => $user->id, 'meta_key' => 'wp_app_client', 'meta_value' => $obj->wp_meta->wp_app_client],
						['user_id' => $user->id, 'meta_key' => 'wp_app_password', 'meta_value' => $obj->wp_meta->wp_app_password],
						['user_id' => $user->id, 'meta_key' => 'wp_form_id', 'meta_value' => $obj->wp_meta->wp_form_id]
					]);
				}
				
				return response()->json(['status' => $obj->status, 'form_v1' => $obj->verification_from, 'access' => $obj->access_level, 'link_url' => 'https://quantumsocial.io/cart/?vq='.$obj->wp_meta->wp_user_id.'&qs='.md5(66), 'message' => $obj->message]);
				
			} 
			
		}
		
       
    }


}
