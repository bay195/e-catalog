<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Cek apakah user login dan punya role yang diizinkan
        if (!auth()->check() || !in_array(auth()->user()->role, $roles)) {
            abort(403, 'Unauthorized.');
        }

        return $next($request);
    }
}