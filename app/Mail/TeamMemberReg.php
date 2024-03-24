<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Encryption\EncryptException;
class TeamMemberReg extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $fullname;

    public function __construct($fullname)
    {
        $this->fullname = $fullname;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {


        try{
        $token = Str::random(32);

        // Store the token in the session
        session(['registration_token' => $token]);


        // Encrypt the ID
        $encryptedId = Crypt::encrypt($this->fullname);
        // Insert the token into the database

        DB::table('members')->where('fullname', $this->fullname)->update(['tokens' => $token]);

        $emailLink = route('memberregistration', ['token' => Crypt::encrypt($token), 'fullname' => $encryptedId]);

        return $this->view('emails.team_member_email_template')
        ->with(['emailLink' => $emailLink])
        ->subject('Team Member Registration');
}
        catch (EncryptException $e) {
            // Handle encryption error
            return response()->json(['error' => 'Encryption failed'], 400);
        }
    }
}
