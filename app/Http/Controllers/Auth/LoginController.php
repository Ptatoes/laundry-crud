<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validate input data
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Attempt to login using the provided credentials
        if (Auth::attempt($credentials)) {
            return redirect()->intended(route('home')); // Redirect to home after successful login
        }

        // If login fails, redirect back with an error message
        return back()->withErrors([
            'email' => 'Invalid credentials. Please try again.',
        ])->onlyInput('email'); // Keep the email input in case of error
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login'); // Redirect after logging out
    }
}
