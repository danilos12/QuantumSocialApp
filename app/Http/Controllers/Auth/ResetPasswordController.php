<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Helpers\WP;
use App\Libraries\PasswordHash;



class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function showResetForm($token)
    {
        // return view('emails.password-reset', ['token' => $token]);
        return view('emails.password-reset-copu', ['token' => $token]);
    }

    public function resetPassword(Request $request)
    {                 
        //Validate the form data
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        // Update the user's password in the Laravel database
        $result = $this->updatePassword($request->only('email', 'password', 'password_confirmation', 'token'));
        \Log::info('result: ' . json_encode($result));
        
        // Extract email and password from the request
        $email = $request->input('email');
        $password = $request->input('password');

        // Update the user's password in the WordPress database
        $resultWP = $this->updatePasswordWP($email, $password);

        \Log::info('resultWP: ' . json_encode($resultWP));
        // dd($request);
        // dd($resultWP); // $P$BCiuMYuajHgly38WHkW/pfrS0eIv7W.
        
        // Check if the password was successfully updated in both Laravel and WordPress
        if ($result && $resultWP) {
            \Log::info('Greaat: ' . json_encode($resultWP));
            \Log::info('Greaat: ' . json_encode($result));
            // Password updated successfully in both systems
            return redirect()->route('login')->with('success', 'Your password has been reset successfully.');
        } else {
            \Log::info('Failed: ' . json_encode($result));
            \Log::info('Failed: ' . json_encode($resultWP));
            // Password update failed in one or both systems
            return redirect()->back()->withErrors(['errors' => 'Failed to reset password in one or both systems. Please try again.']);
        }
    }

    protected function updatePasswordWP($email, $password)
    {
        // Include the PasswordHash class
        require_once app_path('Libraries/class-phpass.php');

        // Create an instance of PasswordHash with the same settings as WordPress
        $wp_hasher = new \PasswordHash(8, true);

        // Hash the new password using WordPress's hashing method
        $hashedPasswordWordPress = $wp_hasher->HashPassword($password);
        \Log::info('hashedPasswordWordPress: ' . json_encode($hashedPasswordWordPress));

        // Get the external database connection for WordPress
        $externalDbConnection = WP::external_db_connection();

        // Prepare the SQL query for updating the password in the WordPress database
        $query = "UPDATE wp_ftvis8_users SET user_pass = ?, user_activation_key = ? WHERE user_email = ?";

        $stmt = $externalDbConnection->prepare($query);
        $result = $stmt->execute([
            $password,
            '', // Clearing the activation key after password reset
            $email
        ]);
        \Log::info('Result: ' . json_encode($result));

        return $result; // Returns true if successful, false otherwise
    }

    protected function updatePassword(array $credentials)
    {
        $status = Password::reset($credentials, function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password),
            ])->setRememberToken(Str::random(60));            

            $user->save();
        });

        return $status === Password::PASSWORD_RESET;
    }


//     protected function updatePassword(array $credentials)
// {
//     $status = Password::reset($credentials, function ($user, $password) {
//         // Hash the password using Laravel's method
//         $hashedPasswordLaravel = Hash::make($password);

//         // Update the password in the Laravel database
//         // $user->forceFill([
//         //     'password' => $hashedPasswordLaravel,
//         // ])->setRememberToken(Str::random(60));

//         // Save the Laravel user password
//         // $user->save();

//         // Generate the hashed password using the WordPress hash method
//         require_once app_path('Libraries/class-phpass.php');
//         $wp_hasher = new PasswordHash(8, true);
//         $hashedPasswordWordPress = $wp_hasher->HashPassword($password);
//             dd($hashedPassword);
//         // Get the external database connection for WordPress
//         $externalDbConnection = WP::external_db_connection();
//         \Log::info('Connected to WP database');

//         // Prepare the SQL query for updating the password in the WordPress database
//         $query = "UPDATE wp_users SET user_pass = ?, user_activation_key = ? WHERE user_email = ?";
        
//         $stmt = $externalDbConnection->prepare($query);
//         $stmt->execute([
//             $hashedPasswordWordPress,
//             Str::random(60),
//             $user->email
//         ]);
//     });

//     return $status === Password::PASSWORD_RESET;
// }
}
