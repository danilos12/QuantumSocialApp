<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }












    protected function sendFailedLoginResponse(Request $request)
    {
        // Session::flash('error', trans('auth.failed'));
        // $request->session()->flash('error', true);

        // return redirect()->route('login')->withInput($request->only($this->username(), 'remember'));
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }
   

    // public function login(Request $request)
    // {
    //     $this->validateLogin($request);

    //     if ($this->attemptLogin($request)) {
    //         if ($request->hasSession()) {
    //             $request->session()->put('auth.password_confirmed_at', time());
    //         }
    //         return $this->sendLoginResponse($request);
    //     }

    //     // If the login attempt was unsuccessful, flash the input data and error message to the session
    //     Session::flashInput($request->input());
    //     Session::flash('error', trans('auth.failed'));

    //     return redirect()->route('login');
    // }
}
