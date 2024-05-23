<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;
use App\Mail\PasswordResetEmail;
use App\Models\User;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

     /**
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function sendResetLinkEmail(Request $request)
    {         
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->withErrors(['email' => 'No user found with that email address.']);
        }

        $token = Password::createToken($user);

        // Customized email subject
        $subject = 'Quantum Social: Password Reset';       

       
        $resetUrl = env('APP_URL') . '/password/reset/' . $token;
        // dd($resetUrl);
        // Generate the password reset token
        // $token = $this->broker()->createToken($request->only('email'));

        // Send the password reset email
        Mail::send('emails.password-reset-email', ['token' => $token, 'resetUrl' => $resetUrl], function ($message) use ($subject, $user, $resetUrl) {
            $message->subject($subject)
                ->to($user->email)
                ->from(env('MAIL_USERNAME'), 'noreply');
        });    


        return back()->with('status', 'Password reset link sent successfully.');
    }
}
