<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthAdmin
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
        $user = $request->user();
        if ($user && !$user->hasRole('admin') && !$user->hasRole('regular_admin')) {
            abort(403);
        } else {
            if (!$user) {
                // return redirect()->route('login');
                 return redirect()->intended(route('dashboard', absolute: false));
            }
        }

        return $next($request);
    }
}
