<!DOCTYPE html>
<html lang="en" class="h-full bg-white">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - {{ config('app.name', 'Library CMS') }}</title>
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
                    <h2 class="mt-8 text-3xl font-bold tracking-tight text-slate-900">Create an account</h2>
                    <p class="mt-2 text-sm text-slate-600">
                        Join our community of readers today.
                    </p>
                </div>


                <div class="mt-10">
                    <form action="{{ route('register') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="first_name" class="block text-sm font-medium leading-6 text-slate-900">First
                                    Name</label>
                                <div class="mt-2">
                                    <input id="first_name" name="first_name" type="text" autocomplete="given-name"
                                        required
                                        class="form_input block w-full rounded-lg border-0 py-2.5 px-3 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 transition-all"
                                        value="{{ old('first_name') }}">
                                </div>
                            </div>
                            <div>
                                <label for="last_name" class="block text-sm font-medium leading-6 text-slate-900">Last
                                    Name</label>
                                <div class="mt-2">
                                    <input id="last_name" name="last_name" type="text" autocomplete="family-name"
                                        required
                                        class="form_input block w-full rounded-lg border-0 py-2.5 px-3 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 transition-all"
                                        value="{{ old('last_name') }}">
                                </div>
                            </div>
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium leading-6 text-slate-900">Email
                                address</label>
                            <div class="mt-2">
                                <input id="email" name="email" type="email" autocomplete="email" required
                                    class="form_input  block w-full rounded-lg border-0 py-2.5 px-3 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 transition-all"
                                    value="{{ old('email') }}">
                            </div>
                        </div>

                        <div>
                            <label for="password"
                                class="form_input block text-sm font-medium leading-6 text-slate-900">Password</label>
                            <div class="mt-2">
                                <input id="password" name="password" type="password" autocomplete="new-password"
                                    required
                                    class="form_input block w-full rounded-lg border-0 py-2.5 px-3 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 transition-all">
                            </div>
                            <!-- Password Requirements Helper -->
                            <div class="mt-2 text-xs text-slate-500" id="password_requirements">
                                <p class="mb-1">Password must be at least 8 characters long and include:</p>
                                <ul class="list-disc pl-5 space-y-0.5">
                                    <li id="req_length" class="text-slate-500 transition-colors">At least 8 characters
                                    </li>
                                    <li id="req_uppercase" class="text-slate-500 transition-colors">One uppercase letter
                                    </li>
                                    <li id="req_number" class="text-slate-500 transition-colors">One number</li>
                                    <li id="req_special" class="text-slate-500 transition-colors">One special character
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div>
                            <label for="password_confirmation"
                                class="form_input block text-sm font-medium leading-6 text-slate-900">Confirm Password</label>
                            <div class="mt-2">
                                <input id="password_confirmation" name="password_confirmation" type="password" required
                                    class="form_input block w-full rounded-lg border-0 py-2.5 px-3 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 transition-all">
                            </div>
                        </div>

                        <div class="flex justify-center">
                            <button type="submit" id="submit_btn" class="sign_in_button">Create
                                Account</button>
                        </div>
                    </form>

                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            const passwordInput = document.getElementById('password');
                            const reqLength = document.getElementById('req_length');
                            const reqUppercase = document.getElementById('req_uppercase');
                            const reqNumber = document.getElementById('req_number');
                            const reqSpecial = document.getElementById('req_special');

                            passwordInput.addEventListener('input', function () {
                                const val = passwordInput.value;

                                // Length Check
                                if (val.length >= 8) {
                                    valid(reqLength);
                                } else {
                                    invalid(reqLength);
                                }

                                // Uppercase Check
                                if (/[A-Z]/.test(val)) {
                                    valid(reqUppercase);
                                } else {
                                    invalid(reqUppercase);
                                }

                                // Number Check
                                if (/[0-9]/.test(val)) {
                                    valid(reqNumber);
                                } else {
                                    invalid(reqNumber);
                                }

                                // Special Char Check
                                if (/[!@#$%^&*(),.?":{}|<>]/.test(val)) {
                                    valid(reqSpecial);
                                } else {
                                    invalid(reqSpecial);
                                }
                            });

                            function valid(el) {
                                el.classList.remove('text-slate-500');
                                el.classList.add('text-green-600', 'font-medium');
                                // Could add checkmark here if desired
                            }

                            function invalid(el) {
                                el.classList.remove('text-green-600', 'font-medium');
                                el.classList.add('text-slate-500');
                            }
                        });
                    </script>

                    <p class="mt-10 text-center text-sm text-slate-500">
                        Already have an account?
                        <a href="{{ route('login') }}"
                            class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">Sign in</a>
                    </p>
                </div>
            </div>
        </div>

        <!-- Right Side: Image/Design -->
        <div class="relative hidden w-0 flex-1 lg:block">
            <!-- Image -->
            <img class="absolute inset-0 h-full w-full object-cover" src="{{ asset('images/background.png') }}"
                alt="Library Books">

            <!-- Subtle overlay for better text contrast -->
            <div class="absolute inset-0 bg-black/20"></div>
        </div>
    </div>
</body>

</html>