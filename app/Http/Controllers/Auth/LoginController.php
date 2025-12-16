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
            return redirect()->route('public.home');
        }
        return view('auth.login');
    }

    /**
     * Handle a login request.
     */
    public function login(Request $request)
    {
        $this->ensureIsNotRateLimited($request);

        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->filled('remember');

        // Check if user exists first to provide specific feedback
        $user = \App\Models\User::where('email', $request->email)->first();
        if (!$user) {
            throw ValidationException::withMessages([
                'email' => ['Account does not exist. Please sign up first.'],
            ]);
        }

        if (Auth::attempt($credentials, $remember)) {
            \Illuminate\Support\Facades\RateLimiter::clear($this->throttleKey($request));
            $request->session()->regenerate();

            // Redirect based on user role
            if (Auth::user()->role === 'admin' || Auth::user()->role === 'librarian') {
                return redirect()->intended(route('dashboard'));
            }

            // For 'viewer' role, redirect to library
            return redirect()->intended(route('public.home'));
        }

        \Illuminate\Support\Facades\RateLimiter::hit($this->throttleKey($request));

        throw ValidationException::withMessages([
            'email' => ['The provided credentials do not match our records.'],
        ]);
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(Request $request): void
    {
        if (!\Illuminate\Support\Facades\RateLimiter::tooManyAttempts($this->throttleKey($request), 5)) {
            return;
        }

        $seconds = \Illuminate\Support\Facades\RateLimiter::availableIn($this->throttleKey($request));

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(Request $request): string
    {
        return \Illuminate\Support\Str::transliterate(\Illuminate\Support\Str::lower($request->input('email')) . '|' . $request->ip());
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
