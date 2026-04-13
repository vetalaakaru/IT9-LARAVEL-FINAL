<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $profiles = session('profiles', []);
        return view('welcome', compact('profiles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:1',
            'program' => 'required|string|max:255',
            'email' => 'required|email',
            'gender' => 'required|in:male,female',
            'hobbies' => 'required|array|min:5',
            'bio' => 'required|string|max:500',
        ]);

        $profiles = session('profiles', []);
        $profiles[] = $validated;
        
        session(['profiles' => $profiles]);
        session()->save(); 

        return redirect('/');
    }

    public function clear()
    {
        session()->forget('profiles');
        session()->save();
        
        return redirect('/');
    }
}