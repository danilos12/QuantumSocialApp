<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
class TeamMemberRegistration extends Controller
{
    public function team_member_reg(Request $request)
    {
        $decryptedId = Crypt::decrypt($request->input('id'));
        $decryptedToken = Crypt::decrypt($request->input('token'));



        $tokenFromDB = DB::table('members')->where('tokens', $decryptedToken)->first();




        if ($tokenFromDB) {
            $request->validate([
                'password' => 'required|string|min:8|confirmed',
            ]);


            $password = $request->input('password');
            $password_confirm = $request->input('password_confirmation');
            if ($password !== $password_confirm) {
                return response()->json(['error' => 'Password confirmation does not match'], 400);
            }



            $passwordupdated =  DB::table('members')
            ->where('id', $decryptedId)
            ->update(['isverified'=> true,'password'=>Hash::make($password),'tokens'=>'fully_verified']);
            if($passwordupdated){
                return response()->json(['message' => 'You are now verified and can now logged in','stat'=>'success']);

            }


        } else {
            // Token doesn't match, handle accordingly (redirect, error response, etc.)
            return response()->json(['token_matched' => false, 'error' => 'Token mismatch/Expired'],422);
        }
    }
}
