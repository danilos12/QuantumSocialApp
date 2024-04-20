<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        
        if (Auth::guard('web')->check()) {
            return $next($request);

        }
        if(Auth::guard('member')->check()) {

            return $next($request);


        }
        if (!$request->hasSession() || !Auth::check()) {
            return redirect()->route('login');
        }




    }
}
