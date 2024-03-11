<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\AuthenticationException;

class UserAccess extends Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string[]  ...$guards
     * @return mixed
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            return route('login.member');
        }
    }
    public function handle($request, Closure $next, ...$guards)
    {
        // Check if the user is authenticated with any of the specified guards
        if (!Auth::guard('member')->check()) {
            // If not authenticated, throw an authentication exception
            throw new AuthenticationException(
                'Unauthenticated.', $guards, $this->redirectTo($request)
            );
        }

        // If authenticated, continue with the request
        return $next($request);
    }
}
