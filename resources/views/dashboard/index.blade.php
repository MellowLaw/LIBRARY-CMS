@extends('layouts.admin')

@section('page-title', 'Library Dashboard')
@section('page-subtitle', 'Overview of your library system')

@section('content')
    <!-- Admin Header -->
    <div class="mb-8 flex items-center justify-between">
        <div>
            <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-gray-900 text-white text-xs font-semibold uppercase tracking-wider rounded-full mb-2">
                <span class="w-1.5 h-1.5 bg-green-400 rounded-full"></span>
                Admin Panel
            </span>
            <h2 class="text-4xl font-bold text-gray-900">System Overview</h2>
        </div>
        <form method="POST" action="{{ route('logout') }}" onsubmit="event.preventDefault(); openLogoutModal(this);">
            @csrf
            <button type="submit" class="sign_out_btn text-sm text-red-600 hover:text-red-700 font-medium transition-smooth bg-red-50 hover:bg-red-100 px-4 py-2 rounded-lg">
                Sign Out
            </button>
        </form>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        <!-- Pages Card -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-smooth">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 font-medium">Total Pages</p>
                    <h3 class="text-3xl font-bold text-gray-900 mt-2">{{ $totalPages ?? 0 }}</h3>
                    <p class="text-xs text-green-600 mt-2">{{ $publishedPages ?? 0 }} Published</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v12a2 2 0 01-2 2h-3l-4 4z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- News Card -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-smooth">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 font-medium">News Updates</p>
                    <h3 class="text-3xl font-bold text-gray-900 mt-2">{{ $newsCount ?? 0 }}</h3>
                    <p class="text-xs text-emerald-600 mt-2">Announcements</p>
                </div>
                <div class="w-12 h-12 bg-emerald-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Staff Card -->
        <a href="{{ route('staff.index') }}" class="block bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-smooth cursor-pointer group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 font-medium group-hover:text-purple-600 transition-colors">Staff Members</p>
                    <h3 class="text-3xl font-bold text-gray-900 mt-2">{{ $staffCount ?? 0 }}</h3>
                    <p class="text-xs text-purple-600 mt-2">Active Profiles</p>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center group-hover:bg-purple-200 transition-colors">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 8.048M12 4.354L9.172 7.172A4 4 0 0012.828 16.83m0-12.496h.028m9.026 9.142c-3.900 3.900-10.236 3.900-14.142 0M15.763 19.9a6.009 6.009 0 01-8.486 0m11.334-11.668c1.886-1.886 1.886-4.944 0-6.83-1.886-1.886-4.944-1.886-6.83 0m6.83 6.83l-6.83-6.83"></path>
                    </svg>
                </div>
            </div>
        </a>

        <!-- Total Books Card -->
        <a href="{{ route('books.index') }}" class="block bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-smooth cursor-pointer group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 font-medium group-hover:text-indigo-600 transition-colors">Total Books</p>
                    <h3 class="text-3xl font-bold text-gray-900 mt-2">{{ $totalBooks ?? 0 }}</h3>
                    <p class="text-xs text-indigo-600 mt-2">In Collection</p>
                </div>
                <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center group-hover:bg-indigo-200 transition-colors">
                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
            </div>
        </a>

        <!-- Available Books Card -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-smooth">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 font-medium">Available Copies</p>
                    <h3 class="text-3xl font-bold text-gray-900 mt-2">{{ $availableBooks ?? 0 }}</h3>
                    <p class="text-xs text-green-600 mt-2">Ready to Borrow</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Borrowed Books Card -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-smooth">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 font-medium">Currently Borrowed</p>
                    <h3 class="text-3xl font-bold text-gray-900 mt-2">{{ $borrowedBooks ?? 0 }}</h3>
                    <p class="text-xs text-red-600 mt-2">Active Loans</p>
                </div>
                <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity & Quick Actions -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- Recent Pages -->
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="p-6 border-b border-gray-200 flex items-center justify-between">
                <h3 class="text-lg font-bold text-gray-900">Recent Pages</h3>
                <a href="{{ route('pages.index') }}" class="text-sm text-emerald-600 hover:text-emerald-700 font-medium">View All →</a>
            </div>
            <div class="divide-y divide-gray-200">
                @forelse($recentPages ?? [] as $page)
                    <div class="p-6 hover:bg-gray-50 transition-smooth">
                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                <h4 class="text-sm font-bold text-gray-900">{{ $page->title }}</h4>
                                <p class="text-xs text-gray-500 mt-1">Updated {{ $page->updated_at->diffForHumans() }}</p>
                            </div>
                            <div class="flex items-center gap-2">
                                @if($page->is_published)
                                    <span class="inline-flex items-center gap-1 px-2 py-1 bg-green-100 text-green-700 text-xs font-medium rounded">
                                        <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                                        Published
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2 py-1 bg-gray-100 text-gray-700 text-xs font-medium rounded">
                                        <span class="w-2 h-2 bg-gray-500 rounded-full"></span>
                                        Draft
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-6 text-center text-gray-500">
                        No pages yet. <a href="{{ route('pages.create') }}" class="text-emerald-600 hover:text-emerald-700 font-medium">Create one</a>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Quick Actions</h3>
            <div class="space-y-3">
                <a href="{{ route('pages.create') }}" class="flex items-center gap-3 w-full p-3 bg-blue-50 hover:bg-blue-100 rounded-lg transition-smooth text-blue-700 font-medium">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    New Page
                </a>
                <a href="{{ route('news.create') }}" class="flex items-center gap-3 w-full p-3 bg-emerald-50 hover:bg-emerald-100 rounded-lg transition-smooth text-emerald-700 font-medium">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Post News
                </a>
                <a href="{{ route('staff.create') }}" class="flex items-center gap-3 w-full p-3 bg-purple-50 hover:bg-purple-100 rounded-lg transition-smooth text-purple-700 font-medium">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                    </svg>
                    Add Staff
                </a>
                <a href="{{ route('books.create') }}" class="flex items-center gap-3 w-full p-3 bg-indigo-50 hover:bg-indigo-100 rounded-lg transition-smooth text-indigo-700 font-medium">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                    Add Book
                </a>
                <a href="{{ route('menus.index') }}" class="flex items-center gap-3 w-full p-3 bg-amber-50 hover:bg-amber-100 rounded-lg transition-smooth text-amber-700 font-medium">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                    Manage Menu
                </a>
            </div>
            
            <div class="mt-8 border-t border-gray-100 pt-6">
                <!-- Links to other modules/resources if needed -->
                <a href="{{ route('public.home') }}" target="_blank" class="flex items-center gap-2 text-sm text-gray-600 hover:text-gray-900">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    View Public Site
                </a>
            </div>
        </div>
    </div>
@endsection