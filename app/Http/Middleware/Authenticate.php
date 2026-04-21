<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if ($request->expectsJson()) {
            return null;
        }

        // Check if the URL contains 'admin' to potentially redirect to a specific login,
        // otherwise, send them to your chooseRole page.
        if ($request->is('admin/*')) {
            return route('chooseRole');
        }

        // FIXED: Redirecting to 'chooseRole' instead of 'login' to match your routes.
        // This prevents the "Route [login] not defined" error.
        return route('chooseRole');
    }
}