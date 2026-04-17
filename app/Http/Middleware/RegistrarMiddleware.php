<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RegistrarMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is logged in AND is a registrar
        if (auth()->check() && auth()->user()->role === 'registrar') {
            return $next($request);
        }

        // Redirect non-registrars (e.g., to login)
        return redirect('/login')->with('error', 'Unauthorized access.');
    }
    

    }