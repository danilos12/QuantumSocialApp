<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class MemberLoginController extends Controller
{



    public function showLoginForm()
    {
        return view('auth.memberlogin');
    }
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('member')->attempt($credentials)) {

            return redirect()->route('home');
        }elseif(Auth::guard('web')->attempt($credentials)){
            return redirect()->route('session-login');
        } else {
            // Authentication failed
            return redirect()->route('tomemberauth')->with('error', 'Invalid credentials. Please try again.');
        }

    }
}
