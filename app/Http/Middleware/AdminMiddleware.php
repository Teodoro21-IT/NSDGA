<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
public function handle(Request $request, Closure $next)
{
    // Check if user is logged in AND is an admin
    if (auth()->check() && auth()->user()->role === 'admin') {
        return $next($request);
    }

    // Redirect non-admins (e.g., to registrar dashboard or login)
    return redirect('/login')->with('error', 'Unauthorized access.');
}
}
