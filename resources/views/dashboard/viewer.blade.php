<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Dashboard - {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-800">

    <!-- Navbar -->
    <nav class="bg-white border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center gap-3">
                    <a href="{{ route('public.home') }}"
                        class="flex items-center gap-2 text-indigo-600 hover:text-indigo-700 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        <span class="font-medium">Back to Home</span>
                    </a>
                </div>
                <div class="flex items-center gap-4">
                    <span class="text-slate-600 font-medium">{{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="text-sm text-red-600 hover:text-red-700 font-medium transition-colors">Sign
                            Out</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-4xl mx-auto px-4 py-12">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 text-center animate-fade-in-up">
            <div
                class="w-20 h-20 bg-indigo-50 text-indigo-600 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>

            <h1 class="text-3xl font-bold text-slate-900 mb-4">Welcome, {{ Auth::user()->first_name }}!</h1>
            <p class="text-lg text-slate-500 mb-8 max-w-lg mx-auto">
                You are logged in as a <strong>Member</strong>. Currently, this dashboard allows you to access exclusive
                content (coming soon).
            </p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-left">
                <div
                    class="p-6 rounded-xl bg-slate-50 border border-slate-100 hover:border-indigo-200 transition-colors">
                    <h3 class="font-bold text-slate-900 mb-2">Member News</h3>
                    <p class="text-sm text-slate-500">View updates reserved for registered members.</p>
                </div>
                <div
                    class="p-6 rounded-xl bg-slate-50 border border-slate-100 hover:border-indigo-200 transition-colors">
                    <h3 class="font-bold text-slate-900 mb-2">Account Settings</h3>
                    <p class="text-sm text-slate-500">Manage your profile and preferences.</p>
                </div>
            </div>

            <div class="mt-10">
                <a href="{{ route('public.home') }}"
                    class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-full text-white bg-indigo-600 hover:bg-indigo-700 transition-all shadow-lg hover:shadow-xl hover:-translate-y-1">
                    Explore Public Content
                </a>
            </div>
        </div>
    </main>

</body>

</html>