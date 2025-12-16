<!DOCTYPE html>
<html lang="en" class="h-full bg-white">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In - {{ config('app.name', 'Library CMS') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Outfit', sans-serif;
        }
    </style>
</head>

<body class="h-full">
    <div class="flex min-h-full">
        <!-- Left Side: Form -->
        <div
            class="flex flex-1 flex-col justify-center px-4 py-12 sm:px-6 lg:flex-none lg:px-20 xl:px-24 bg-white z-10">
            <div class="mx-auto w-full max-w-sm lg:w-96">
                <div class="sm:mx-auto sm:w-full sm:max-w-md mb-6">
                    <a href="{{ route('public.home') }}"
                        class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-primary-accent transition-smooth mb-6">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Back to Home
                    </a>
                    <div class="flex justify-center mb-2">
                        <img src="{{ asset('assets/main-logo.png') }}" alt="AddLib Logo" class="h-16 w-auto">
                    </div>
                    <h2 class="mt-8 text-3xl font-bold tracking-tight text-slate-900">Sign in to your account</h2>
                    <p class="mt-2 text-sm text-slate-600">
                        Please enter your details to sign in.
                    </p>
                </div>

                <div class="mt-10">
                    <!-- Typing Animation / Avatar -->
                    <div class="flex justify-center mb-6 relative h-20">
                        <div id="user-avatar" class="w-20 h-20 rounded-full bg-slate-100 flex items-center justify-center border-4 border-white shadow-lg transition-all duration-500 ease-out transform">
                            <!-- Default User Icon -->
                            <svg id="icon-user" class="w-10 h-10 text-slate-400 params-transition transition-all duration-300 transform scale-100 opacity-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <!-- Admin Icon (Hidden by default) -->
                            <svg id="icon-admin" class="w-10 h-10 text-orange-600 params-transition transition-all duration-300 absolute transform scale-50 opacity-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>

                        <!-- Typing Indicator Bubbles (Absolute) -->
                        <div id="typing-indicator" class="absolute -right-4 top-0 bg-white p-2 rounded-full shadow-md hidden animate-bounce-subtle">
                            <div class="flex space-x-1">
                                <div class="w-1.5 h-1.5 bg-orange-400 rounded-full animate-pulse"></div>
                                <div class="w-1.5 h-1.5 bg-orange-400 rounded-full animate-pulse delay-75"></div>
                                <div class="w-1.5 h-1.5 bg-orange-400 rounded-full animate-pulse delay-150"></div>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('login') }}" method="POST" class="space-y-6" id="loginForm" novalidate>
                        @csrf
                        <div>
                            <label for="email" class="block text-sm font-medium leading-6 text-slate-900">Email
                                address</label>
                            <div class="mt-2 relative">
                                <input id="email" name="email" type="email" autocomplete="email" required
                                    class="form_input block w-full rounded-lg border-0 py-2.5 px-3 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-orange-600 sm:text-sm sm:leading-6 transition-all"
                                    value="{{ old('email') }}">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none transition-opacity duration-300 opacity-0" id="email-icon-valid">
                                    <svg class="h-5 w-5 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none transition-opacity duration-300 opacity-0" id="email-icon-invalid">
                                    <svg class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                @error('email')
                                <p class="mt-2 text-sm text-red-600 block">{{ $message }}</p>
                                @enderror
                                <p class="mt-2 text-sm text-red-600 hidden" id="email-error"></p>
                            </div>
                        </div>

                        <div>
                            <label for="password"
                                class="block text-sm font-medium leading-6 text-slate-900">Password</label>
                            <div class="mt-2 relative">
                                <input id="password" name="password" type="password" autocomplete="current-password"
                                    required
                                    class="form_input block w-full rounded-lg border-0 py-2.5 px-3 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-orange-600 sm:text-sm sm:leading-6 transition-all">
                                <p class="mt-2 text-sm text-red-600 hidden" id="password-error"></p>
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input id="remember-me" name="remember" type="checkbox"
                                    class="h-4 w-4 rounded border-slate-300 text-orange-600 focus:ring-orange-600">
                                <label for="remember-me" class="ml-2 block text-sm text-slate-900">Remember me</label>
                            </div>
                        </div>

                        <div class="flex justify-center">
                            <button type="submit" class="sign_in_button group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-all duration-200 shadow-md hover:shadow-lg transform active:scale-95">
                                <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                                    <svg class="h-5 w-5 text-orange-500 group-hover:text-orange-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                                Sign in
                            </button>
                        </div>

                    </form>

                    <p class="mt-10 text-center text-sm text-slate-500">
                        Not a member?
                        <a href="{{ route('register') }}"
                            class="font-semibold leading-6 text-orange-600 hover:text-orange-500">Sign Up</a>
                    </p>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', () => {
                        const emailInput = document.getElementById('email');
                        const passwordInput = document.getElementById('password');
                        const form = document.getElementById('loginForm');

                        // Icon Elements
                        const userAvatar = document.getElementById('user-avatar');
                        const iconUser = document.getElementById('icon-user');
                        const iconAdmin = document.getElementById('icon-admin');
                        const typingInd = document.getElementById('typing-indicator');

                        // Regular Expressions
                        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                        // Validation UI Helpers
                        const showValid = (input, validIconId, invalidIconId) => {
                            input.classList.remove('ring-red-300', 'focus:ring-red-500', 'text-red-900');
                            input.classList.add('ring-green-300', 'focus:ring-green-500', 'text-slate-900');
                            document.getElementById(validIconId).classList.remove('opacity-0');
                            document.getElementById(invalidIconId).classList.add('opacity-0');
                        };

                        const showInvalid = (input, validIconId, invalidIconId, errorMsgId, msg) => {
                            input.classList.remove('ring-green-300', 'focus:ring-green-500', 'text-slate-900');
                            input.classList.add('ring-red-300', 'focus:ring-red-500', 'text-slate-900');
                            document.getElementById(validIconId).classList.add('opacity-0');
                            document.getElementById(invalidIconId).classList.remove('opacity-0');
                            if (msg && errorMsgId) {
                                const errorEl = document.getElementById(errorMsgId);
                                errorEl.textContent = msg;
                                errorEl.classList.remove('hidden');
                            }
                        };

                        const clearValidation = (input, validIconId, invalidIconId, errorMsgId) => {
                            input.classList.remove('ring-red-300', 'focus:ring-red-500', 'ring-green-300', 'focus:ring-green-500');
                            document.getElementById(validIconId).classList.add('opacity-0');
                            document.getElementById(invalidIconId).classList.add('opacity-0');
                            if (errorMsgId) document.getElementById(errorMsgId).classList.add('hidden');
                        };

                        let typingTimer;

                        emailInput.addEventListener('input', (e) => {
                            const val = e.target.value;

                            // Typing Animation Logic
                            typingInd.classList.remove('hidden');
                            clearTimeout(typingTimer);
                            typingTimer = setTimeout(() => {
                                typingInd.classList.add('hidden');
                            }, 500);

                            // User/Admin Avatar Logic
                            if (val.toLowerCase().includes('admin')) {
                                // Switch to Admin
                                userAvatar.classList.remove('bg-slate-100');
                                userAvatar.classList.add('bg-orange-50', 'ring-2', 'ring-orange-300');
                                iconUser.classList.add('scale-50', 'opacity-0');
                                iconUser.classList.remove('scale-100', 'opacity-100');
                                iconAdmin.classList.remove('scale-50', 'opacity-0');
                                iconAdmin.classList.add('scale-100', 'opacity-100');
                            } else {
                                // Switch to User
                                userAvatar.classList.add('bg-slate-100');
                                userAvatar.classList.remove('bg-orange-50', 'ring-2', 'ring-orange-300');
                                iconAdmin.classList.add('scale-50', 'opacity-0');
                                iconAdmin.classList.remove('scale-100', 'opacity-100');
                                iconUser.classList.remove('scale-50', 'opacity-0');
                                iconUser.classList.add('scale-100', 'opacity-100');
                            }

                            // Validation Logic
                            if (val.length === 0) {
                                clearValidation(emailInput, 'email-icon-valid', 'email-icon-invalid', 'email-error');
                            } else if (emailRegex.test(val)) {
                                showValid(emailInput, 'email-icon-valid', 'email-icon-invalid');
                                document.getElementById('email-error').classList.add('hidden');
                            } else {
                                document.getElementById('email-icon-valid').classList.add('opacity-0');
                            }
                        });

                        emailInput.addEventListener('blur', () => {
                            const val = emailInput.value;
                            if (val.length > 0 && !emailRegex.test(val)) {
                                showInvalid(emailInput, 'email-icon-valid', 'email-icon-invalid', 'email-error', 'Please enter a valid email address.');
                            }
                            typingInd.classList.add('hidden');
                        });

                        form.addEventListener('submit', (e) => {
                            let valid = true;

                            if (!emailRegex.test(emailInput.value)) {
                                showInvalid(emailInput, 'email-icon-valid', 'email-icon-invalid', 'email-error', 'Please enter a valid email address.');
                                valid = false;
                            }

                            if (passwordInput.value.length === 0) {
                                document.getElementById('password-error').textContent = 'Password is required.';
                                document.getElementById('password-error').classList.remove('hidden');
                                passwordInput.classList.add('ring-red-300');
                                valid = false;
                            }

                            if (!valid) {
                                e.preventDefault();
                            }
                        });
                    });
                </script>
            </div>
        </div>

        <!-- Right Side: Image/Design -->
        <div class="relative hidden w-0 flex-1 lg:block">
            <!-- Image -->
            <img class="absolute inset-0 h-full w-full object-cover" src="{{ asset('images/background_login.png') }}"
                alt="Modern Library Architecture">

            <!-- Subtle overlay for better text contrast -->
            <div class="absolute inset-0 bg-black/20"></div>
        </div>
    </div>
</body>

</html>
