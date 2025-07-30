<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthTenantManager
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        if ($user && !$user->isTenantManager()) {
            abort(403);
        } else {
            if (!$user) {
                // return redirect()->route('login');
                return to_route('login');
            }
        }

        return $next($request);
    }
}
