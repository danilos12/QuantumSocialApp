<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckSessionExpiration
{
    public function handle($request, Closure $next)
    {
        $loginRoute = route('session-login');
        $postLoginRoute = url('/login');
        
        if (!$request->session()->has('last_activity') && $request->url() !== $loginRoute) {
            // Redirect to login page if session has expired
            session()->flash('error', 'Session expired');
            return redirect()->route('session-login');
            // return redirect()->route('login');
        }
        
        $lastActivity = $request->session()->get('last_activity');
        if ($lastActivity < time() - config('session.lifetime') * 60 && $request->url() !== $loginRoute && $request->url() !== $postLoginRoute) {
            // Redirect to login page if session has expired
            session()->flash('error', 'Session expired');
            return redirect()->route('session-login');
        }

        // Update last activity timestamp
        $request->session()->put('last_activity', time());

        return $next($request);
    }

}
