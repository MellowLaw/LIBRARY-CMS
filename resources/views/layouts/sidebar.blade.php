<div class="w-64 bg-gradient-to-b from-gray-900 via-gray-800 to-gray-900 text-white flex flex-col">
    <!-- Logo Section -->
    <div class="p-6 border-b border-gray-700">
        <div class="flex items-center gap-3 mb-2">
            <div class="w-10 h-10 bg-gradient-to-br from-emerald-400 to-emerald-600 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 0C5.37 0 0 5.37 0 12c0 6.63 5.37 12 12 12s12-5.37 12-12S18.63 0 12 0zm-2 18l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 10z"/>
                </svg>
            </div>
            <div>
                <h1 class="text-xl font-bold">LibraryCMS</h1>
                <p class="text-xs text-gray-400">Content Management</p>
            </div>
        </div>
    </div>
    
    <!-- Navigation Menu -->
    <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
        <a href="{{ route('dashboard') }}" 
           class="flex items-center gap-3 px-4 py-3 rounded-lg transition-smooth {{ request()->routeIs('dashboard') ? 'bg-emerald-600 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-3m0 0l7-4 7 4M5 9v10a1 1 0 001 1h12a1 1 0 001-1V9m-9 4h4"></path>
            </svg>
            <span class="font-medium">Dashboard</span>
        </a>
        
        <a href="{{ route('pages.index') }}" 
           class="flex items-center gap-3 px-4 py-3 rounded-lg transition-smooth {{ request()->routeIs('pages.*') ? 'bg-emerald-600 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            <span class="font-medium">Pages</span>
        </a>
        
        <a href="{{ route('menus.index') }}" 
           class="flex items-center gap-3 px-4 py-3 rounded-lg transition-smooth {{ request()->routeIs('menus.*') ? 'bg-emerald-600 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
            <span class="font-medium">Menus</span>
        </a>
        
        <a href="{{ route('staff.index') }}" 
           class="flex items-center gap-3 px-4 py-3 rounded-lg transition-smooth {{ request()->routeIs('staff.*') ? 'bg-emerald-600 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 8.048M12 4.354L9.172 7.172A4 4 0 0012.828 16.83l2.83-2.83m0-5.656a4 4 0 010 8.048M9.172 9.172L12 12m3.657-3.657l2.83 2.83m0 0a4 4 0 010 8.048M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span class="font-medium">Staff</span>
        </a>
        
        <a href="{{ route('resources.index') }}" 
           class="flex items-center gap-3 px-4 py-3 rounded-lg transition-smooth {{ request()->routeIs('resources.*') ? 'bg-emerald-600 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.658 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
            </svg>
            <span class="font-medium">Resources</span>
        </a>
    </nav>
    
    <!-- Divider -->
    <div class="border-t border-gray-700 px-4 py-4 space-y-2">
        <!-- User Info -->
        <div class="px-4 py-3 text-gray-300 text-sm">
            <p class="font-medium">{{ Auth::user()->name }}</p>
            <p class="text-xs text-gray-400">{{ ucfirst(Auth::user()->role) }}</p>
        </div>
        
        <form method="POST" action="{{ route('logout') }}" class="w-full">
            @csrf
            <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg text-gray-300 hover:bg-red-900/20 transition-smooth text-left">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                </svg>
                <span class="font-medium">Logout</span>
            </button>
        </form>
    </div>
</div>
