<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string'
        ]);

        // Buyers are approved instantly; Sellers stay 'pending' for Admin review
        $status = ($request->role === 'buyer') ? 'approved' : 'pending';

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role, 
            'status' => $status,
            'shop_name' => $request->shop_name ?? null,
            'owner_name' => $request->owner_name ?? $request->name, 
            'valid_id' => $request->valid_id ?? null,
        ]);

        if ($status === 'approved') {
            Auth::login($user);
            return redirect()->route('buyer.dashboard');
        }

        // Keep your original redirect for sellers
        return redirect()->route('chooseRole')->with('success', 'Registration successful! Please wait for admin approval.');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $request->session()->regenerate();

            // 1. Admin bypass
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            // 2. Status Check: Block users who are 'pending' or 'rejected'
            if ($user->status !== 'approved') {
                Auth::logout();
                return back()->withErrors(['email' => 'Your account is currently ' . $user->status . '.']);
            }

            return $this->redirectUserByRole($user->role);
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    private function redirectUserByRole($role)
    {
        return match($role) {
            'admin' => redirect()->route('admin.dashboard'),
            'seller' => redirect()->route('seller.dashboard'),
            'buyer' => redirect()->route('buyer.dashboard'),
            default => redirect()->route('home'),
        };
    }
}