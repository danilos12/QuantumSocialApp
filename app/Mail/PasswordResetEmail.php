<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
// use Illuminate\Contracts\Mail\Mailable;



class PasswordResetEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $resetUrl;
    public $token;

    /**
     * Create a new message instance.
     *
     * @param string $resetUrl
     * @return void
     */
    public function __construct($user, $resetUrl, $token)
    {
        $this->user = $user;
        $this->resetUrl = $resetUrl;
        $this->token = $token;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->view('emails.password-reset', ['subject' => 'Password Reset', 'from' => 'no']);
        return $this->from(env('APP_URL'), 'noreply')
                    ->markdown('emails.password-reset')
                    ->subject('Quantum Social: Password Reset');
    }
}
