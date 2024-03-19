<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberLoginController extends Controller
{


    public function showLoginForm()
    {        $title = 'Login';

        return view('auth.memberlogin')->with('titles', $title);
    }




    public function login(Request $request)
    {

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('member')->attempt($credentials)) {

            return redirect()->route('memberhome');
        }else {
            // Authentication failed
            return redirect()->route('tomemberauth')->with('error', 'Invalid credentials. Please try again.');
        }

    }
}
