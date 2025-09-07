<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function index()
    {
        return view('auth.account', ['user' => Auth::user()]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $attributes = $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->username = $attributes['username'];

        if (!empty($attributes['password'])) {
            $user->password = bcrypt($attributes['password']);
        }

        $user->save();

        return redirect()->route('account')->with('success', 'Account updated successfully!');
    }
}
