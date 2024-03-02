<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    //
    public function __invoke(Request $request)
    {
        // ... will fill that in a bit later
        // $obj = $request->all();

        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::defaults()],            
        ]);
        
        $user = User::create([
            'email' => $request->create_account->email_address,
            'password' => Hash::make($request->create_account->password),
            ]);
            
            if( $user->id ) {
                DB::table('app_usermeta')->insert([
                    ['user_id' => $user->id, 'meta_key' => 'wp_user_id', 'meta_value' => $request->wp_meta->wp_user_id],
                    ['user_id' => $user->id, 'meta_key' => 'id_subscription', 'meta_value' => $request->wp_meta->id_subscription],
                    ['user_id' => $user->id, 'meta_key' => 'wp_subscription', 'meta_value' => $request->wp_meta->access_subscription],
                ]);
            }

        return response()->json([
            'access_token' => $user->createToken($device)->plainTextToken,
        ], Response::HTTP_CREATED);
    }

    public function scrapeMetatags(Request $request) {

        // Check if the request has basic authentication headers
        if (!$request->headers->has('Authorization')) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Get the basic authentication credentials
        $credentials = explode(':', base64_decode(substr($request->header('Authorization'), 6)));

        // Check if the credentials are valid
        if (count($credentials) != 2 || $credentials[0] != 'username' || $credentials[1] != 'password') {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Fetch the HTML content of the URL
        $html = file_get_contents($request->input('url'));

        // Create an array to store the meta tags
        $metaTags = array();
    
        // Use a regular expression to match meta tags
        preg_match_all('/<meta\s+([^>]*?)\s*\/?>/i', $html, $matches);
    

        // Loop through the matches and extract the meta tag attributes
        foreach ($matches[1] as $match) {
            // Use a regular expression to match the attribute name and value
        //   preg_match('/\b(?:name|property|http-equiv)="([^"]*)"\s+content="([^"]*)"/i', $match, $attributes);
            preg_match('/\b(?:name|property|http-equiv)=["\']([^"\']*)["\']\s+content=["\']([^"\']*)["\']/i', $match, $attributes);

            
    
            // If the attribute name and value are found, add them to the meta tags array
            if (isset($attributes[1]) && isset($attributes[2])) {
                $metaTags[$attributes[1]] = $attributes[2];
            }
        }
    
        dd($metaTags);
        // Return the meta tags array
        return $metaTags;        
        
    }
}
