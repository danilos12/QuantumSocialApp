<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;

class testingapi extends Controller
{
    public function posting(Request $request)
    {
        // Validate the incoming data
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'access_level' => 'required|in:Free,66',
        ]);

        // If validation fails, return an error response
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Encrypt data
        $encryptedEmail = Crypt::encrypt($request->input('email'));
        $encryptedAccessLevel = Crypt::encrypt($request->input('access_level'));

        // Prepare data for the cURL request
        $requestData = [
            'email_address' => $encryptedEmail,
            'access_level' => $encryptedAccessLevel,
        ];
   // Check the access level
        if ($request->input('access_level') === 'Free') {
            return $this->freeAccessLevel($requestData['email_address'], $requestData['access_level']);
        }
                // API endpoint URL
        $checkoutUrl = 'https://quantumsocial.io/wp-json/qts/v5/save/';

        // Authorization token
        $authorizationToken = '6ae0ccac7d3f978dbbc31232ae25e143';

        // Initialize cURL session
        $ch = curl_init($checkoutUrl);

        // Set cURL options
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($requestData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: ' . $authorizationToken,
        ]);

        // Execute cURL request
        $response = curl_exec($ch);
        $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        // Check the response status and handle accordingly
        if ($httpStatus === 200) {
            // Successful response

            // Retrieve data from the session for further use if needed
            $decryptedEmail = Crypt::decrypt($encryptedEmail);
            $decryptedAccessLevel = Crypt::decrypt($encryptedAccessLevel);

            // Clear session data if it's no longer needed
            Session::forget('encrypted_email');
            Session::forget('encrypted_access_level');

            // Return a response or view
            // return view('https://quantumsocial.io/wp-json/qts/v5/save/');
            return response()->json(['Success' => 'Success'], $httpStatus);
        } else {
            // Failed response
            return response()->json(['error' => 'Request failed'], $httpStatus);
        }
    }


    public function freeAccessLevel($email,$accessLevel)
    {
        $requestData = [
            'email_address' => $email,
            'access_level' => $accessLevel,
        ];
        $checkoutUrl = 'https://quantumsocial.io/wp-json/qts/v5/save/';

        // Authorization token
        $authorizationToken = '6ae0ccac7d3f978dbbc31232ae25e143';

        // Initialize cURL session
        $ch = curl_init($checkoutUrl);

        // Set cURL options
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($requestData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: ' . $authorizationToken,
        ]);

        // Execute cURL request
        $response = curl_exec($ch);
        $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        // Check the response status and handle accordingly
        if ($httpStatus === 200) {
            // Successful response

            // Retrieve data from the session for further use if needed
            $decryptedEmail = Crypt::decrypt($email);
            $decryptedAccessLevel = Crypt::decrypt($accessLevel);

            // Clear session data if it's no longer needed
            Session::forget('encrypted_email');
            Session::forget('encrypted_access_level');

            // Return a response or view
            // return view('https://quantumsocial.io/wp-json/qts/v5/save/');
     
            return view('auth.verification')->with('success', 'Verification code has been sent.');
        } else {
            // Failed response
            return response()->json(['error' => 'Request failed'], $httpStatus);
        }

        // return response()->json(['Message' => $email,'Access_level'=>$accessLevel]);
        //   return view('auth/verification');

    }
}
