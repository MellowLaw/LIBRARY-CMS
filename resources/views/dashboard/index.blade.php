@extends('layouts.app')

@section('page-title', 'Dashboard')
@section('page-subtitle', 'Overview of your library system')

@section('content')
<!-- Stats Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Pages Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-smooth">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500 font-medium">Total Pages</p>
                <h3 class="text-3xl font-bold text-gray-900 mt-2">{{ $totalPages ?? 0 }}</h3>
                <p class="text-xs text-green-600 mt-2">↑ 2 this week</p>
            </div>
            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v12a2 2 0 01-2 2h-3l-4 4z"></path>
                </svg>
            </div>
        </div>
    </div>
    
    <!-- Published Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-smooth">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500 font-medium">Published</p>
                <h3 class="text-3xl font-bold text-gray-900 mt-2">{{ $publishedPages ?? 0 }}</h3>
                <p class="text-xs text-emerald-600 mt-2">Live & Active</p>
            </div>
            <div class="w-12 h-12 bg-emerald-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </div>
    </div>
    
    <!-- Staff Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-smooth">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500 font-medium">Staff Members</p>
                <h3 class="text-3xl font-bold text-gray-900 mt-2">{{ $staffCount ?? 0 }}</h3>
                <p class="text-xs text-purple-600 mt-2">Team size</p>
            </div>
            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 8.048M12 4.354L9.172 7.172A4 4 0 0012.828 16.83m0-12.496h.028m9.026 9.142c-3.900 3.900-10.236 3.900-14.142 0M15.763 19.9a6.009 6.009 0 01-8.486 0m11.334-11.668c1.886-1.886 1.886-4.944 0-6.83-1.886-1.886-4.944-1.886-6.83 0m6.83 6.83l-6.83-6.83"></path>
                </svg>
            </div>
        </div>
    </div>
    
    <!-- Resources Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-smooth">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500 font-medium">Resources</p>
                <h3 class="text-3xl font-bold text-gray-900 mt-2">{{ $resourceCount ?? 0 }}</h3>
                <p class="text-xs text-amber-600 mt-2">Links & References</p>
            </div>
            <div class="w-12 h-12 bg-amber-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.658 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
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
            <a href="{{ route('pages.create') }}" class="flex items-center gap-3 w-full p-3 bg-emerald-50 hover:bg-emerald-100 rounded-lg transition-smooth text-emerald-700 font-medium">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                New Page
            </a>
            <a href="{{ route('menus.index') }}" class="flex items-center gap-3 w-full p-3 bg-blue-50 hover:bg-blue-100 rounded-lg transition-smooth text-blue-700 font-medium">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
                Manage Menus
            </a>
            <a href="{{ route('staff.index') }}" class="flex items-center gap-3 w-full p-3 bg-purple-50 hover:bg-purple-100 rounded-lg transition-smooth text-purple-700 font-medium">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 8.048M12 4.354L9.172 7.172A4 4 0 0012.828 16.83"></path>
                </svg>
                Add Staff
            </a>
            <a href="{{ route('public.home') }}" target="_blank" class="flex items-center gap-3 w-full p-3 bg-amber-50 hover:bg-amber-100 rounded-lg transition-smooth text-amber-700 font-medium">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                View Site
            </a>
        </div>
    </div>
</div>
@endsection
