<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;



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
        // Validate the form data
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        // Update the user's password in the database
        $result = $this->updatePassword($request->only('email', 'password', 'password_confirmation', 'token'));

        // Check if the password was successfully updated
        if ($result) {
            // Password updated successfully
            return redirect()->route('login')->with('success', 'Your password has been reset successfully.');
        } else {
            // Password update failed
            return redirect()->back()->withErrors(['errors' => 'Failed to reset password. Please try again.']);
        }
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
}
