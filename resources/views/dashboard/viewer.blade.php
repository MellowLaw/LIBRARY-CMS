@extends('layouts.app')

@section('title', 'My Dashboard - AddLib')

@section('content')
    <div class="max-w-4xl mx-auto py-12">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 text-center animate-fade-in-up">
            <div
                class="w-20 h-20 bg-primary-bg text-primary-accent rounded-full flex items-center justify-center mx-auto mb-6 border border-gray-200">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>

            <h1 class="text-3xl font-bold text-gray-900 mb-4">Welcome, {{ Auth::user()->first_name }}!</h1>
            <p class="text-lg text-gray-500 mb-8 max-w-lg mx-auto">
                You are logged in as a <strong>Member</strong>. Access your exclusive content below.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-left">
                <div
                    class="p-6 rounded-xl bg-gray-50 border border-gray-100 hover:border-primary-accent/30 transition-smooth group">
                    <h3 class="font-bold text-gray-900 mb-2 group-hover:text-primary-accent transition-colors">Member News
                    </h3>
                    <p class="text-sm text-gray-500">View updates reserved for registered members.</p>
                </div>
                <div
                    class="p-6 rounded-xl bg-gray-50 border border-gray-100 hover:border-primary-accent/30 transition-smooth group">
                    <h3 class="font-bold text-gray-900 mb-2 group-hover:text-primary-accent transition-colors">Account
                        Settings</h3>
                    <p class="text-sm text-gray-500">Manage your profile and preferences.</p>
                </div>
            </div>

            <div class="mt-8 pt-8 border-t border-gray-100">
                <form method="POST" action="{{ route('logout') }}"
                    onsubmit="event.preventDefault(); openLogoutModal(this);">
                    @csrf
                    <button type="submit"
                        class="sign_out_btn text-red-600 hover:text-red-700 font-medium transition-smooth text-sm">
                        Sign Out
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection