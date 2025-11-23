<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class siswaRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        // If user is a student ('siswa'), check if they're trying to access allowed pages
        if ($user && $user->role === 'siswa') {
            $currentRoute = $request->route()?->getName();

            // If no route name is available, continue normally to avoid errors
            if (!$currentRoute) {
                return $next($request);
            }

            // Allow access only to specific routes for students
            $allowedRoutes = [
                'dashboard',
                'profile.edit',
                'profile.update',
                'profile.destroy'
            ];

            if (in_array($currentRoute, $allowedRoutes)) {
                return $next($request);
            }

            // If user is siswa and trying to access other routes, redirect to dashboard
            if (!str_starts_with($currentRoute, 'auth.')) { // Allow auth routes like login, logout
                return redirect()->route('dashboard')->with('error', 'Access denied. Students can only access the dashboard and profile.');
            }
        }

        return $next($request);
    }
}