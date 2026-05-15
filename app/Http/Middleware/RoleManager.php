<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleManager
{
    /**
     * Handle an incoming request.
     * FIXED: trim() at strtolower() para hindi mag-fail kahit may extra spaces/newlines ang role sa DB
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Check kung naka-login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // FIXED: trim whitespace/newlines + lowercase para consistent ang comparison
        $userRole = strtolower(trim(Auth::user()->role));

        // Lowercase din ang lahat ng allowed roles para safe
        $allowedRoles = array_map(fn($r) => strtolower(trim($r)), $roles);

        // 2. Check kung ang role ng user ay nasa listahan ng pinapayagan
        if (in_array($userRole, $allowedRoles)) {
            return $next($request);
        }

        // 3. Hindi allowed — redirect sa dashboard
        return redirect()->route('dashboard')->with('error', 'Elite Access Only.');
    }
}