<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;


class EnsureStudentRole
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->session()->get('student_authenticated') === true) {
            return $next($request);
        }

        $user = Auth::user();

        if (!$user || $user->role !== 'student') {
            abort(403, 'Students only.');
        }

        return $next($request);
    }
}
