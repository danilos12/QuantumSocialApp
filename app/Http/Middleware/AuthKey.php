<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthKey
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
        $headers = $request->headers->all();
        $authorizationHeader = isset($headers['authorization']) ? $headers['authorization'][0] : null;

        if (md5($authorizationHeader) != md5('carloarielsandig')) {
            return response()->json(['incorrect' => 'You are unauthorized'], 401);
        }


        return $next($request);
    }
}
