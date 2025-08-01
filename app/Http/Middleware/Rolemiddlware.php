<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Rolemiddlware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\s9deHttp\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = $request->user();
        if ($user && !$user->hasRole($roles)) {
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
