<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

abstract class Controller
{
    /**
     * Check access restrictions based on user role
     * This function has been deprecated in favor of route-based role middleware
     *
     * @param array $allowedRoutes Routes that siswa users are allowed to access
     * @return RedirectResponse|null
     */
    protected function checkRoleAccess(array $allowedRoutes = []): ?RedirectResponse
    {
        // This function is now deprecated. Please use route middleware for role-based access control.
        return null;
    }
}
