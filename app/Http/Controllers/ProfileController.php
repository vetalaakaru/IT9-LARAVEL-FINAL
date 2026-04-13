<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $profiles = session()->get('profiles', []);
        return view('welcome', compact('profiles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'age' => 'required|integer',
            'program' => 'required|string',
            'email' => 'required|email',
            'gender' => 'required',
            'hobbies' => 'required|array|min:1',            
            'bio' => 'required|string',
        ]);

        $profiles = session()->get('profiles', []);
        $profiles[] = $validated;
        session()->put('profiles', $profiles);

        return redirect('/')->with('success', 'Profile added!');
    }

    public function clear()
    {
        session()->forget('profiles');
        return redirect('/');
    }
}