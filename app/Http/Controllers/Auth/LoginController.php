<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\emplooyees;

class LoginController extends Controller
{
    // Show the login form
    public function showLoginForm()
    {
        return view('user_login');
    }

    public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|string|email',
        'password' => 'required|string',
    ]);

    \Log::info('Login attempt:', ['credentials' => $credentials]);

    if (Auth::attempt($credentials)) {
        $user = Auth::user();
        \Log::info('User authenticated:', ['user_id' => $user->userId]);
        return redirect()->intended('/dashboard');
    }

    \Log::warning('Authentication failed:', ['credentials' => $credentials]);
    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ]);
}

    

    // Handle the logout process
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
