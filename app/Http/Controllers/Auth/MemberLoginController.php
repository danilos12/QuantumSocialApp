<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
class MemberLoginController extends Controller
{







    public function login(Request $request)
    {

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('member')->attempt($credentials)) {

            Session::put('user_id', Auth::guard('member')->user()->id);
            Session::put('user_email', Auth::guard('member')->user()->email);


            return redirect()->route('memberhome');
        }else {
            // Authentication failed
            return redirect()->route('tomemberauth')->with('error', 'Invalid credentials. Please try again.');
        }

    }

    public function logout()
    {
        Auth::guard('member')->logout();

        // Redirect to the appropriate route after logout
        return redirect()->route('tomemberauth');
    }
}
