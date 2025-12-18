@extends('layouts.app', ['hideFooter' => true])

@section('title', 'My Dashboard - AddLib')

@section('content')
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        
        {{-- Header Section --}}
        <div class="mb-10 flex flex-col md:flex-row md:items-center md:justify-between gap-4 animate-fade-in-up">
            <div>
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 font-display">
                    {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}'s Dashboard
                </h1>
                <p class="text-gray-600 mt-2 text-lg">
                    Welcome back! Here is an overview of your library activity.
                </p>
            </div>
            <div class="flex items-center gap-3">
                <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-primary-bg text-primary-text border border-primary-accent/20">
                    <span class="w-2 h-2 mr-2 bg-green-500 rounded-full animate-pulse"></span>
                    Active {{ ucfirst(Auth::user()->role) }}
                </span>
            </div>
        </div>

        {{-- Stats and Quick Links Row --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <!-- Active Loans Card -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex items-center gap-5 hover:shadow-md transition-smooth group">
                <div class="w-14 h-14 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center group-hover:scale-110 transition-smooth">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                </div>
                <div>
                    <h3 class="text-gray-500 text-sm font-medium uppercase tracking-wider">Active Books</h3>
                    <p class="text-3xl font-bold text-gray-900">{{ $borrowedBooks->count() }}</p>
                </div>
            </div>

            <!-- Browse Library Card -->
            <a href="{{ route('public.books.index') }}" class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex items-center gap-5 hover:shadow-md transition-smooth group hover:border-primary-accent/30 cursor-pointer">
                <div class="w-14 h-14 rounded-full bg-primary-bg text-primary-accent flex items-center justify-center group-hover:scale-110 transition-smooth">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <div>
                    <h3 class="text-gray-500 text-sm font-medium uppercase tracking-wider">Library Catalog</h3>
                    <p class="text-lg font-bold text-gray-900 flex items-center">
                        Browse Books <span class="ml-1 opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all">→</span>
                    </p>
                </div>
            </a>
            
             <!-- Due Soon Card (Placeholder logic or static) -->
             <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex items-center gap-5 hover:shadow-md transition-smooth">
                <div class="w-14 h-14 rounded-full bg-amber-50 text-amber-600 flex items-center justify-center">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <h3 class="text-gray-500 text-sm font-medium uppercase tracking-wider">Status</h3>
                    <p class="text-lg font-bold text-gray-900">Account Active</p>
                </div>
            </div>
        </div>

        {{-- Main Content Grid --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            {{-- Left Column: Current Loans (Span 2) --}}
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                        <h2 class="text-xl font-bold text-gray-900 flex items-center gap-2">
                             <svg class="w-5 h-5 text-primary-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                            Books Loans
                        </h2>
                         @if($borrowedBooks->count() > 3)
                            <span class="text-xs font-medium text-gray-500 bg-gray-100 px-2 py-1 rounded-full">Scroll for more</span>
                        @endif
                    </div>
                    
                    <div class="p-4 max-h-[500px] overflow-y-auto custom-scrollbar">
                         @if($borrowedBooks->isEmpty())
                            <div class="text-center py-12">
                                <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-400">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                </div>
                                <h3 class="text-lg font-medium text-gray-900">No books borrowed</h3>
                                <p class="text-gray-500 mb-6 max-w-sm mx-auto">You don't have any active loans right now. Explore our catalog to find your next read!</p>
                                <a href="{{ route('public.books.index') }}" class="btn-primary inline-flex items-center">
                                    Browse Catalog
                                </a>
                            </div>
                        @else
                            <div class="space-y-3">
                                @foreach($borrowedBooks as $loan)
                                    <div class="flex flex-col sm:flex-row gap-4 p-4 rounded-xl border border-gray-100 hover:border-primary-accent/30 hover:shadow-sm transition-smooth bg-gray-50/50">
                                        {{-- Book Icon / Cover Placeholder --}}
                                        <div class="w-full sm:w-16 sm:h-24 bg-gray-200 rounded-lg flex-shrink-0 flex items-center justify-center text-gray-400">
                                             @if($loan->book->cover_image)
                                                <img src="{{ asset('storage/' . $loan->book->cover_image) }}" alt="Cover" class="w-full h-full object-cover rounded-lg">
                                            @else
                                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                            @endif
                                        </div>
                                        
                                        <div class="flex-1 min-w-0">
                                            <div class="flex justify-between items-start">
                                                <div>
                                                    <h3 class="text-lg font-bold text-gray-900 truncate pr-2">{{ $loan->book->title }}</h3>
                                                    <p class="text-sm text-gray-600 mb-1">by <span class="font-medium">{{ $loan->book->author }}</span></p>
                                                    
                                                </div>
                                                <a href="{{ route('public.books.show', $loan->book) }}" class="text-xs font-bold text-indigo-600 bg-indigo-50 px-3 py-1 rounded-full hover:bg-indigo-100 transition-colors">
                                                    View Details
                                                </a>
                                            </div>
                                            
                                            <div class="mt-3 flex flex-wrap items-center gap-3 text-xs">
                                                {{-- Status Badges --}}
                                                @if($loan->status === 'pending')
                                                    <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-md font-bold flex items-center">
                                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                        Request Pending
                                                    </span>
                                                @elseif($loan->status === 'rejected')
                                                    <span class="bg-red-100 text-red-800 px-2 py-1 rounded-md font-bold flex items-center">
                                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                                        Rejected: {{ $loan->rejection_reason }}
                                                    </span>
                                                @else
                                                    {{-- Active Loan --}}
                                                    <span class="text-emerald-700 bg-emerald-50 px-2 py-1 rounded-md font-bold">Active</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Right Column: Quick Actions (Span 1) --}}
            <div class="space-y-6">
                <!-- Profile Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h3 class="font-bold text-gray-900 mb-4 text-lg">My Account</h3>
                    
                    <div class="flex items-center gap-4 mb-6">
                        @if(Auth::user()->profile_picture)
                            <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="Profile" class="w-16 h-16 rounded-full object-cover border-2 border-white shadow-md">
                        @else
                            <div class="w-16 h-16 rounded-full bg-primary-bg text-primary-accent flex items-center justify-center text-xl font-bold border-2 border-white shadow-md">
                                {{ substr(Auth::user()->first_name, 0, 1) }}{{ substr(Auth::user()->last_name, 0, 1) }}
                            </div>
                        @endif
                        <div>
                            <p class="font-bold text-gray-900">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</p>
                            <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                    
                    <div class="space-y-2">
                        <a href="{{ route('profile.edit') }}" class="flex items-center justify-between w-full p-3 rounded-lg bg-gray-50 hover:bg-gray-100 transition-smooth group">
                            <span class="text-sm font-medium text-gray-700 group-hover:text-gray-900">Edit Profile</span>
                            <svg class="w-4 h-4 text-gray-400 group-hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex items-center justify-between w-full p-3 rounded-lg bg-red-50 hover:bg-red-100 transition-smooth group text-left">
                                <span class="text-sm font-medium text-red-700 group-hover:text-red-800">Sign Out</span>
                                <svg class="w-4 h-4 text-red-400 group-hover:text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Info Card -->
                <div class="bg-gradient-to-br from-primary-accent to-orange-600 rounded-2xl shadow-lg shadow-orange-200 p-6 text-white text-center relative overflow-hidden group">
                     <div class="absolute top-0 right-0 -mr-8 -mt-8 w-24 h-24 rounded-full bg-white opacity-20 group-hover:scale-150 transition-transform duration-700"></div>
                     <div class="absolute bottom-0 left-0 -ml-8 -mb-8 w-16 h-16 rounded-full bg-white opacity-10"></div>
                     
                    <h3 class="font-bold text-xl mb-2 relative z-10">Need a specific book?</h3>
                    <p class="text-white/90 text-sm mb-4 relative z-10">Search our complete collection or ask a librarian for help.</p>
                    <a href="{{ route('public.books.index') }}" class="inline-block bg-white text-orange-600 font-bold text-sm px-6 py-2 rounded-full hover:bg-orange-50 transition-colors shadow-sm relative z-10">
                        Start Searching
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection