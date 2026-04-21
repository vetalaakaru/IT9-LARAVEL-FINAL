<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Stats for your dashboard cards
        $verifiedSellersCount = User::where('role', 'seller')->where('status', 'approved')->count();
        $verifiedBuyersCount = User::where('role', 'buyer')->where('status', 'approved')->count();
        
        // Count for the orange notification banner
        $pendingCount = User::where('status', 'pending')->where('role', '!=', 'admin')->count();

        // Data for the "Verification" table
        $pendingUsers = User::where('status', 'pending')
                            ->where('role', '!=', 'admin')
                            ->latest()
                            ->get();

        return view('admin.dashboard', compact(
            'pendingUsers', 
            'verifiedSellersCount', 
            'verifiedBuyersCount', 
            'pendingCount'
        ));
    }

    public function approve($id)
    {
        $user = User::findOrFail($id);
        $user->update(['status' => 'approved']);

        return redirect()->route('admin.dashboard')
            ->with('success', "User approved successfully.");
    }

    public function reject($id)
    {
        $user = User::findOrFail($id);
        $user->update(['status' => 'rejected']);

        return redirect()->route('admin.dashboard')
            ->with('error', "User has been rejected.");
    }
}