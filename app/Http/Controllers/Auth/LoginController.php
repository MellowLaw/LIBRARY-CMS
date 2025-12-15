<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    protected $redirectTo = '/library'; // Default redirect path
    /**
     * Show the login form.
     */
    public function showLoginForm()
{
    if (Auth::check()) {
        if (Auth::user()->role === 'admin' || Auth::user()->role === 'librarian') {
            return redirect()->route('dashboard');
        }
        return redirect()->route('library.index');
    }
    return view('auth.login');
}

    /**
     * Handle a login request.
     */
    public function login(Request $request)
{
    $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);
    $credentials = $request->only('email', 'password');
    $remember = $request->filled('remember');
    if (Auth::attempt($credentials, $remember)) {
        $request->session()->regenerate();
        // Redirect based on user role
        if (Auth::user()->role === 'admin' || Auth::user()->role === 'librarian') {
            return redirect()->intended(route('dashboard'));
        }
        
        // For 'viewer' role, redirect to library
        return redirect()->intended(route('library.index'));
    }
    throw ValidationException::withMessages([
        'email' => ['The provided credentials do not match our records.'],
    ]);
}
    /**
     * Handle a logout request.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
