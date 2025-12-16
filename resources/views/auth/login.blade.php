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
                <div>
                    <div class="flex items-center gap-3">
                        <div
                            class="w-10 h-10 bg-indigo-600 rounded-lg flex items-center justify-center text-white shadow-indigo-200 shadow-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                </path>
                            </svg>
                        </div>
                        <span class="font-bold text-2xl tracking-tight text-slate-900">ModernLib</span>
                    </div>
                    <h2 class="mt-8 text-3xl font-bold tracking-tight text-slate-900">Welcome back</h2>
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
                                    class="block w-full rounded-lg border-0 py-2.5 px-3 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 transition-all"
                                    value="{{ old('email') }}">
                            </div>
                        </div>

                        <div>
                            <label for="password"
                                class="block text-sm font-medium leading-6 text-slate-900">Password</label>
                            <div class="mt-2">
                                <input id="password" name="password" type="password" autocomplete="current-password"
                                    required
                                    class="block w-full rounded-lg border-0 py-2.5 px-3 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 transition-all">
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input id="remember-me" name="remember" type="checkbox"
                                    class="h-4 w-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-600">
                                <label for="remember-me" class="ml-2 block text-sm text-slate-900">Remember me</label>
                            </div>
                        </div>

                        <div>
                            <button type="submit"
                                class="flex w-full justify-center rounded-lg bg-indigo-600 px-3 py-2.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition-all hover:shadow-lg hover:-translate-y-0.5">Sign
                                in</button>
                        </div>
                    </form>

                    <div class="mt-8">
                        <!-- Quick Links for Demo -->
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
                    </div>

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
            <img class="absolute inset-0 h-full w-full object-cover" src="{{ asset('images/background.jpg') }}"
                alt="Modern Library Architecture">

            <!-- Subtle overlay for better text contrast -->
            <div class="absolute inset-0 bg-black/20"></div>

            <!-- Quote Section - Bottom Middle -->
            <div class="absolute bottom-0 left-0 right-0 pb-20 px-12 text-white z-20 text-center">
                <blockquote class="max-w-2xl mx-auto space-y-6">
                    <p class="text-5xl font-bold font-['Outfit'] leading-tight" 
                       style="text-shadow: 2px 4px 12px rgba(0, 0, 0, 0.5);">
                        "A library is not a luxury but one of the necessities of life."
                    </p>
                    <footer class="text-xl font-medium opacity-90" 
                            style="text-shadow: 1px 2px 8px rgba(0, 0, 0, 0.5);">
                        – Henry Ward Beecher
                    </footer>
                </blockquote>
            </div>
        </div>
    </div>
</body>

</html>