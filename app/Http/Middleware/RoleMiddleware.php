<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\\HttpFoundation\\Response;
use Illuminate\Support\\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // 1. Check if the user is logged in
        if (!Auth::check()) {
            return redirect()->route('chooseRole');
        }

        $user = Auth::user();

        // 2. Role Validation
        if ($user->role !== $role) {
            // If they are in the wrong place, send them to THEIR correct dashboard
            return $this->redirectBasedOnRole($user->role);
        }

        // 3. Status Check (Optional but Recommended)
        // This prevents users who were rejected or are still pending from accessing routes
        if ($user->role !== 'admin' && $user->status !== 'approved') {
            Auth::logout();
            return redirect()->route('chooseRole')->with('error', 'Your account is not yet approved.');
        }

        return $next($request);
    }

    /**
     * Helper to send users to the right place if they try to access a restricted area.
     */
    private function redirectBasedOnRole(string $role)
    {
        return match($role) {
            'admin' => redirect()->route('admin.dashboard'),
            'seller' => redirect()->route('seller.dashboard'),
            'buyer' => redirect()->route('buyer.dashboard'),
            default => redirect()->route('home'),
        };
    }
}