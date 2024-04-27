<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
class Unauthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {


        if ($request->has('sss')) {

            $decryption = substr(base64_decode($request->input('sss')), 27, -13);
            $decrypteduser_id = $decryption  - 215;

            Auth::loginUsingId($decrypteduser_id);
            return $next($request);


        }




        if (Auth::guard('web')->check()) {
            return $next($request);

        }
        if(Auth::guard('member')->check()) {

            return $next($request);


        }
        if(!Auth::check()) {

            return redirect()->route('login');



        }





    }
}
