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
                <div class="p-6 rounded-xl bg-gray-50 border border-gray-100 hover:border-primary-accent/30 transition-smooth group">
                    <h3 class="font-bold text-gray-900 mb-4 group-hover:text-primary-accent transition-colors flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        Books Borrowed
                    </h3>
                    @if($borrowedBooks->isEmpty())
                        <p class="text-sm text-gray-500">You haven't borrowed any books yet.</p>
                        <a href="{{ route('public.books.index') }}" class="mt-4 inline-block text-primary-accent hover:underline text-sm font-medium">Browse Library →</a>
                    @else
                        <div class="space-y-4">
                            @foreach($borrowedBooks as $loan)
                                <div class="flex justify-between items-center text-sm p-2 hover:bg-gray-100 rounded-lg transition-smooth">
                                    <div class="flex flex-col">
                                        <span class="text-gray-900 font-medium">{{ $loan->book->title }}</span>
                                        <span class="text-[10px] text-gray-500">Due: {{ $loan->due_date->format('M d, Y') }}</span>
                                    </div>
                                    <a href="{{ route('public.books.show', $loan->book) }}"
                                        class="text-xs text-indigo-600 hover:text-indigo-800 font-bold border border-indigo-200 px-2 py-1 rounded-md transition-colors">View</a>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
                <a href="{{ route('profile.edit') }}" class="p-6 rounded-xl bg-gray-50 border border-gray-100 hover:border-primary-accent/30 transition-smooth group block">
                    <h3 class="font-bold text-gray-900 mb-2 group-hover:text-primary-accent transition-colors">Account Settings</h3>
                    <p class="text-sm text-gray-500">Manage your profile and preferences.</p>
                </a>
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