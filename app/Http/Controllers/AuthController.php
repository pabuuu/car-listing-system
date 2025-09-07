<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // --- Register ---
    public function register(Request $request)
    {
        $attributes = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create the user
        $user = User::create($attributes);

        // Log the user in
        Auth::login($user);

        // Redirect
        return redirect()->route('home')->with('success', 'Registration successful!');
    }

    // --- Show login form ---
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // --- Login ---
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
        $request->session()->regenerate(); // prevent session fixation
        return redirect()->route('home')->with('success', 'Logged in successfully!');
    }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    // --- Logout ---
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Logged out successfully!');
    }
}
