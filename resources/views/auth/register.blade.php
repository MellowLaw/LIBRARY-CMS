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


                <div class="mt-8">
                    <!-- Dynamic Avatar Animation -->
                    <div class="flex flex-col items-center justify-center mb-6">
                        <div id="register-avatar"
                            class="w-24 h-24 rounded-full bg-slate-100 flex items-center justify-center border-4 border-white shadow-lg transition-all duration-500 ease-out transform mb-2">
                            <span id="avatar-initials" class="text-3xl font-bold text-slate-400 tracking-wider">?</span>
                        </div>
                        <p id="greeting-text"
                            class="text-slate-500 text-sm font-medium h-5 transition-opacity duration-300">Start typing
                            your name...</p>
                    </div>

                    <form action="{{ route('register') }}" method="POST" class="space-y-5" id="registerForm" novalidate>
                        @csrf
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="first_name" class="block text-sm font-medium leading-6 text-slate-900">First
                                    Name</label>
                                <div class="mt-2 relative">
                                    <input id="first_name" name="first_name" type="text" autocomplete="given-name"
                                        required
                                        class="form_input block w-full rounded-lg border-0 py-2.5 px-3 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-orange-600 sm:text-sm sm:leading-6 transition-all"
                                        value="{{ old('first_name') }}">
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none transition-opacity duration-300 opacity-0"
                                        id="fn-icon-valid">
                                        <svg class="h-5 w-5 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label for="last_name" class="block text-sm font-medium leading-6 text-slate-900">Last
                                    Name</label>
                                <div class="mt-2 relative">
                                    <input id="last_name" name="last_name" type="text" autocomplete="family-name"
                                        required
                                        class="form_input block w-full rounded-lg border-0 py-2.5 px-3 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-orange-600 sm:text-sm sm:leading-6 transition-all"
                                        value="{{ old('last_name') }}">
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none transition-opacity duration-300 opacity-0"
                                        id="ln-icon-valid">
                                        <svg class="h-5 w-5 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium leading-6 text-slate-900">Email
                                address</label>
                            <div class="mt-2 relative">
                                <input id="email" name="email" type="email" autocomplete="email" required
                                    class="form_input  block w-full rounded-lg border-0 py-2.5 px-3 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-orange-600 sm:text-sm sm:leading-6 transition-all"
                                    value="{{ old('email') }}">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none transition-opacity duration-300 opacity-0"
                                    id="email-icon-valid">
                                    <svg class="h-5 w-5 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none transition-opacity duration-300 opacity-0"
                                    id="email-icon-invalid">
                                    <svg class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                            <p class="mt-1 text-sm text-red-600 hidden" id="email-error"></p>
                        </div>

                        <div>
                            <label for="password"
                                class="form_input block text-sm font-medium leading-6 text-slate-900">Password</label>
                            <div class="mt-2 relative">
                                <input id="password" name="password" type="password" autocomplete="new-password"
                                    required
                                    class="form_input block w-full rounded-lg border-0 py-2.5 px-3 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-orange-600 sm:text-sm sm:leading-6 transition-all">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none transition-opacity duration-300 opacity-0"
                                    id="password-icon-valid">
                                </div>
                                <!-- Strength Meter -->
                                <div class="mt-2 h-1.5 w-full bg-slate-200 rounded-full overflow-hidden">
                                    <div id="strength-bar"
                                        class="h-full bg-red-500 w-0 transition-all duration-300 ease-out"></div>
                                </div>

                                <!-- Detailed Reqs -->
                                <div class="mt-2 text-xs text-slate-500 grid grid-cols-2 gap-1"
                                    id="password_requirements">
                                    <div id="req_length" class="flex items-center space-x-1 transition-colors"><span
                                            class="text-lg leading-none">•</span> <span>At least 8 chars</span></div>
                                    <div id="req_uppercase" class="flex items-center space-x-1 transition-colors"><span
                                            class="text-lg leading-none">•</span> <span>One uppercase</span></div>
                                    <div id="req_number" class="flex items-center space-x-1 transition-colors"><span
                                            class="text-lg leading-none">•</span> <span>One number</span></div>
                                    <div id="req_special" class="flex items-center space-x-1 transition-colors"><span
                                            class="text-lg leading-none">•</span> <span>One special char</span></div>
                                </div>
                            </div>

                            <div>
                                <label for="password_confirmation"
                                    class="form_input block text-sm font-medium leading-6 text-slate-900">Confirm
                                    Password</label>
                                <div class="mt-2 relative">
                                    <input id="password_confirmation" name="password_confirmation" type="password"
                                        required
                                        class="form_input block w-full rounded-lg border-0 py-2.5 px-3 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-orange-600 sm:text-sm sm:leading-6 transition-all">
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none transition-opacity duration-300 opacity-0"
                                        id="confirm-icon-valid">
                                        <svg class="h-5 w-5 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none transition-opacity duration-300 opacity-0"
                                        id="confirm-icon-invalid">
                                        <svg class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                                <p class="mt-1 text-sm text-red-600 hidden" id="confirm-error">Passwords do not match.
                                </p>
                            </div>

                            <div class="flex justify-center mt-10">
                                <button type="submit" id="submit_btn"
                                    class="sign_in_button group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-all duration-200 shadow-md hover:shadow-lg transform active:scale-95 disabled:opacity-50 disabled:cursor-not-allowed">
                                    <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                                        <svg class="h-5 w-5 text-white-500 group-hover:text-black-400"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                            aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                    Create Account
                                </button>
                            </div>
                    </form>

                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            const form = document.getElementById('registerForm');
                            const firstName = document.getElementById('first_name');
                            const lastName = document.getElementById('last_name');
                            const email = document.getElementById('email');
                            const passwordInput = document.getElementById('password');
                            const confirmInput = document.getElementById('password_confirmation');
                            const submitBtn = document.getElementById('submit_btn');

                            // Req elements
                            const reqLength = document.getElementById('req_length');
                            const reqUppercase = document.getElementById('req_uppercase');
                            const reqNumber = document.getElementById('req_number');
                            const reqSpecial = document.getElementById('req_special');
                            const strengthBar = document.getElementById('strength-bar');

                            // Avatar Elements
                            const avatarInitials = document.getElementById('avatar-initials');
                            const registerAvatar = document.getElementById('register-avatar');
                            const greetingText = document.getElementById('greeting-text');

                            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                            // Update Avatar
                            function updateAvatar() {
                                const fn = firstName.value.trim();
                                const ln = lastName.value.trim();
                                let initials = '?';
                                if (fn || ln) {
                                    initials = (fn.charAt(0) + ln.charAt(0)).toUpperCase();
                                    greetingText.textContent = `Hello, ${fn}!`;
                                    registerAvatar.classList.remove('bg-slate-100');
                                    registerAvatar.classList.add('bg-orange-100', 'text-orange-600');
                                    avatarInitials.classList.remove('text-slate-400');
                                    avatarInitials.classList.add('text-orange-600');
                                } else {
                                    greetingText.textContent = 'Start typing your name...';
                                    registerAvatar.classList.add('bg-slate-100');
                                    registerAvatar.classList.remove('bg-orange-100', 'text-orange-600');
                                    avatarInitials.classList.add('text-slate-400');
                                    avatarInitials.classList.remove('text-orange-600');
                                }
                                avatarInitials.textContent = initials;
                            }

                            [firstName, lastName].forEach(input => {
                                input.addEventListener('input', () => {
                                    updateAvatar();
                                    if (input.value.trim().length > 0) {
                                        document.getElementById(input.id === 'first_name' ? 'fn-icon-valid' : 'ln-icon-valid').classList.remove('opacity-0');
                                    } else {
                                        document.getElementById(input.id === 'first_name' ? 'fn-icon-valid' : 'ln-icon-valid').classList.add('opacity-0');
                                    }
                                });
                            });

                            // Email Validation
                            email.addEventListener('input', () => {
                                const val = email.value;
                                if (emailRegex.test(val)) {
                                    document.getElementById('email-icon-valid').classList.remove('opacity-0');
                                    document.getElementById('email-icon-invalid').classList.add('opacity-0');
                                    document.getElementById('email-error').classList.add('hidden');
                                } else {
                                    document.getElementById('email-icon-valid').classList.add('opacity-0');
                                }
                            });
                            email.addEventListener('blur', () => {
                                const val = email.value;
                                if (val.length > 0 && !emailRegex.test(val)) {
                                    document.getElementById('email-icon-invalid').classList.remove('opacity-0');
                                    document.getElementById('email-error').textContent = 'Invalid email address';
                                    document.getElementById('email-error').classList.remove('hidden');
                                }
                            });


                            // Password Check
                            passwordInput.addEventListener('input', function () {
                                const val = passwordInput.value;
                                let score = 0;

                                // Checks
                                const hasLength = val.length >= 8;
                                const hasUpper = /[A-Z]/.test(val);
                                const hasNumber = /[0-9]/.test(val);
                                const hasSpecial = /[!@#$%^&*(),.?":{}|<>]/.test(val);

                                updateReq(reqLength, hasLength);
                                updateReq(reqUppercase, hasUpper);
                                updateReq(reqNumber, hasNumber);
                                updateReq(reqSpecial, hasSpecial);

                                if (hasLength) score++;
                                if (hasUpper) score++;
                                if (hasNumber) score++;
                                if (hasSpecial) score++;

                                // Bar update
                                const width = (score / 4) * 100;
                                strengthBar.style.width = `${width}%`;

                                if (score < 2) strengthBar.className = 'h-full w-0 transition-all duration-300 ease-out bg-red-500';
                                else if (score < 4) strengthBar.className = 'h-full w-0 transition-all duration-300 ease-out bg-yellow-500';
                                else strengthBar.className = 'h-full w-0 transition-all duration-300 ease-out bg-green-500';

                                if (score === 4) {
                                    document.getElementById('password-icon-valid').classList.remove('opacity-0');
                                } else {
                                    document.getElementById('password-icon-valid').classList.add('opacity-0');
                                }

                                checkMatch();
                            });

                            confirmInput.addEventListener('input', checkMatch);

                            function checkMatch() {
                                const p = passwordInput.value;
                                const c = confirmInput.value;
                                if (c.length > 0) {
                                    if (p === c) {
                                        document.getElementById('confirm-icon-valid').classList.remove('opacity-0');
                                        document.getElementById('confirm-icon-invalid').classList.add('opacity-0');
                                        document.getElementById('confirm-error').classList.add('hidden');
                                    } else {
                                        document.getElementById('confirm-icon-valid').classList.add('opacity-0');
                                        document.getElementById('confirm-icon-invalid').classList.remove('opacity-0');
                                        document.getElementById('confirm-error').classList.remove('hidden');
                                    }
                                } else {
                                    document.getElementById('confirm-icon-valid').classList.add('opacity-0');
                                    document.getElementById('confirm-icon-invalid').classList.add('opacity-0');
                                    document.getElementById('confirm-error').classList.add('hidden');
                                }
                            }

                            function updateReq(el, isValid) {
                                if (isValid) {
                                    el.classList.remove('text-slate-500');
                                    el.classList.add('text-green-600', 'font-medium');
                                    el.querySelector('span:first-child').innerHTML = '✓';
                                } else {
                                    el.classList.remove('text-green-600', 'font-medium');
                                    el.classList.add('text-slate-500');
                                    el.querySelector('span:first-child').innerHTML = '•';
                                }
                            }

                            form.addEventListener('submit', (e) => {
                                // Final Pre-flight check
                                if (!emailRegex.test(email.value)) {
                                    e.preventDefault();
                                    email.focus();
                                    return;
                                }
                                if (passwordInput.value !== confirmInput.value) {
                                    e.preventDefault();
                                    confirmInput.focus();
                                    return;
                                }
                                if (firstName.value.trim() === '') {
                                    e.preventDefault();
                                    firstName.focus();
                                    return;
                                }
                                if (lastName.value.trim() === '') {
                                    e.preventDefault();
                                    lastName.focus();
                                    return;
                                }
                            });
                        });
                    </script>

                    <p class="mt-10 text-center text-sm text-slate-500">
                        Already have an account?
                        <a href="{{ route('login') }}"
                            class="font-semibold leading-6 text-orange-600 hover:text-orange-500">Sign in</a>
                    </p>
                </div>
            </div>
        </div>

        <!-- Right Side: Image/Design -->
        <div class="relative hidden w-0 flex-1 lg:block">
            <!-- Image -->
            <img class="absolute inset-0 h-full w-full object-cover" src="{{ asset('images/background.png') }}"
                alt="Modern Library Architecture">

            <!-- Subtle overlay for better text contrast -->
            <div class="absolute inset-0 bg-black/20"></div>
        </div>
    </div>
</body>

</html>