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
                    <form action="{{ route('login') }}" method="POST" class="space-y-6">
                        @csrf
                        <div>
                            <label for="email" class="block text-sm font-medium leading-6 text-slate-900">Email
                                address</label>
                            <div class="mt-2">
                                <input id="email" name="email" type="email" autocomplete="email" required
                                    class="form_input block w-full rounded-lg border-0 py-2.5 px-3 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 transition-all"
                                    value="{{ old('email') }}">
                                @error('email')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="password"
                                class="block text-sm font-medium leading-6 text-slate-900">Password</label>
                            <div class="mt-2">
                                <input id="password" name="password" type="password" autocomplete="current-password"
                                    required
                                    class="form_input block w-full rounded-lg border-0 py-2.5 px-3 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 transition-all">
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input id="remember-me" name="remember" type="checkbox"
                                    class="h-4 w-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-600">
                                <label for="remember-me" class="ml-2 block text-sm text-slate-900">Remember me</label>
                            </div>
                        </div>

                        <div class="flex justify-center">
                            <button type="submit" class="sign_in_button">Sign in</button>
                        </div>

                    </form>

                    <!-- Quick Links for Demo
                    <div class="mt-8">
                        <p class="text-xs text-center text-slate-400 mb-4 uppercase tracking-wider font-semibold">Quick
                            Access (Demo)</p>
                        <div class="grid grid-cols-2 gap-3">
                            <button
                                onclick="document.getElementById('email').value='admin@library.com';document.getElementById('password').value='password'"
                                class="flex w-full items-center justify-center rounded-lg border border-slate-200 bg-slate-50 py-2 px-4 text-xs font-medium text-slate-600 hover:bg-slate-100 hover:border-slate-300 transition-all">Admin</button>
                            <button
                                onclick="document.getElementById('email').value='viewer@library.com';document.getElementById('password').value='password'"
                                class="flex w-full items-center justify-center rounded-lg border border-slate-200 bg-slate-50 py-2 px-4 text-xs font-medium text-slate-600 hover:bg-slate-100 hover:border-slate-300 transition-all">Viewer</button>
                        </div>
                    </div> -->

                    <p class="mt-10 text-center text-sm text-slate-500">
                        Not a member?
                        <a href="{{ route('register') }}"
                            class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">Sign Up</a>
                    </p>
                </div>
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