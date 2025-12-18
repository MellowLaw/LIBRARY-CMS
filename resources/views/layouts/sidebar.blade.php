<div class="w-64 bg-[#efeae4] border-r border-[#e5e7eb] flex flex-col">
    <!-- Logo Section -->
    <div class="h-24 flex items-center justify-center border-b border-[#e5dcd6]">
        <img src="{{ asset('assets/main-logo.png') }}" alt="AddLib Logo" class="h-12 w-auto">
    </div>

    <!-- Navigation Menu -->
    <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
        <a href="{{ route('dashboard') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-lg transition-smooth font-medium {{ request()->routeIs('dashboard') ? 'bg-white text-[#ec3412] shadow-sm ring-1 ring-[#e5e7eb]' : 'text-[#0f0701] hover:bg-white/50 hover:text-[#ec3412]' }}">
            <svg class="w-5 h-5 {{ request()->routeIs('dashboard') ? 'text-[#ec3412]' : 'text-gray-400 group-hover:text-[#ec3412]' }}"
                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 12l2-3m0 0l7-4 7 4M5 9v10a1 1 0 001 1h12a1 1 0 001-1V9m-9 4h4"></path>
            </svg>
            <span>Dashboard</span>
        </a>

        <a href="{{ route('pages.index') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-lg transition-smooth font-medium {{ request()->routeIs('pages.*') ? 'bg-white text-[#ec3412] shadow-sm ring-1 ring-[#e5e7eb]' : 'text-[#0f0701] hover:bg-white/50 hover:text-[#ec3412]' }}">
            <svg class="w-5 h-5 {{ request()->routeIs('pages.*') ? 'text-[#ec3412]' : 'text-gray-400 group-hover:text-[#ec3412]' }}"
                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                </path>
            </svg>
            <span>Pages</span>
        </a>

        <a href="{{ route('news.index') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-lg transition-smooth font-medium {{ request()->routeIs('news.*') ? 'bg-white text-[#ec3412] shadow-sm ring-1 ring-[#e5e7eb]' : 'text-[#0f0701] hover:bg-white/50 hover:text-[#ec3412]' }}">
            <svg class="w-5 h-5 {{ request()->routeIs('news.*') ? 'text-[#ec3412]' : 'text-gray-400 group-hover:text-[#ec3412]' }}"
                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                </path>
            </svg>
            <span>News</span>
        </a>

        <a href="{{ route('books.index') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-lg transition-smooth font-medium {{ request()->routeIs('books.*') ? 'bg-white text-[#ec3412] shadow-sm ring-1 ring-[#e5e7eb]' : 'text-[#0f0701] hover:bg-white/50 hover:text-[#ec3412]' }}">
            <svg class="w-5 h-5 {{ request()->routeIs('books.*') ? 'text-[#ec3412]' : 'text-gray-400 group-hover:text-[#ec3412]' }}"
                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                </path>
            </svg>
            <span>Books</span>
        </a>

        <a href="{{ route('menus.index') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-lg transition-smooth font-medium {{ request()->routeIs('menus.*') ? 'bg-white text-[#ec3412] shadow-sm ring-1 ring-[#e5e7eb]' : 'text-[#0f0701] hover:bg-white/50 hover:text-[#ec3412]' }}">
            <svg class="w-5 h-5 {{ request()->routeIs('menus.*') ? 'text-[#ec3412]' : 'text-gray-400 group-hover:text-[#ec3412]' }}"
                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                </path>
            </svg>
            <span>Menus</span>
        </a>

        <a href="{{ route('staff.index') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-lg transition-smooth font-medium {{ request()->routeIs('staff.*') ? 'bg-white text-[#ec3412] shadow-sm ring-1 ring-[#e5e7eb]' : 'text-[#0f0701] hover:bg-white/50 hover:text-[#ec3412]' }}">
            <svg class="w-5 h-5 {{ request()->routeIs('staff.*') ? 'text-[#ec3412]' : 'text-gray-400 group-hover:text-[#ec3412]' }}"
                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 4.354a4 4 0 110 8.048M12 4.354L9.172 7.172A4 4 0 0012.828 16.83l2.83-2.83m0-5.656a4 4 0 010 8.048M9.172 9.172L12 12m3.657-3.657l2.83 2.83m0 0a4 4 0 010 8.048M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                </path>
            </svg>
            <span>Staff</span>
        </a>

        @if(Auth::user() && (Auth::user()->role === 'admin' || Auth::user()->role === 'librarian'))
            <a href="{{ route('resources.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-lg transition-smooth font-medium {{ request()->routeIs('resources.*') ? 'bg-white text-[#ec3412] shadow-sm ring-1 ring-[#e5e7eb]' : 'text-[#0f0701] hover:bg-white/50 hover:text-[#ec3412]' }}">
                <svg class="w-5 h-5 {{ request()->routeIs('resources.*') ? 'text-[#ec3412]' : 'text-gray-400 group-hover:text-[#ec3412]' }}"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.658 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1">
                    </path>
                </svg>
                <span>Resources</span>
            </a>
        @endif


    </nav>

    <!-- Divider -->
    <div class="border-t border-[#e5dcd6] px-4 py-4 space-y-2">
        <!-- User Info -->
        <!-- User Info -->
        <div class="px-4 py-3 text-[#0f0701] text-sm flex items-center gap-3">
            <div class="profile_admin h-10 w-10 rounded-full flex items-center justify-center overflow-hidden shrink-0">
                @if(Auth::user()->profile_picture)
                    <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="{{ Auth::user()->name }}"
                        class="h-full w-full object-cover">
                @else
                    <span class="font-bold ">{{ substr(Auth::user()->name, 0, 1) }}</span>
                @endif
            </div>
            <div>
                <p class="font-bold">{{ Auth::user()->name }}</p>
                <p class="text-xs text-gray-500">{{ ucfirst(Auth::user()->role) }}</p>
            </div>
        </div>

        <form method="POST" action="{{ route('logout') }}" class="w-full"
            onsubmit="event.preventDefault(); openLogoutModal(this);">
            @csrf
            <button type="submit"
                class="w-full flex items-center gap-3 px-4 py-3 rounded-lg text-gray-600 hover:text-[#ec3412] hover:bg-red-50 transition-smooth text-left group">
                <svg class="w-5 h-5 group-hover:text-[#ec3412]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                    </path>
                </svg>
                <span class="font-bold">Logout</span>
            </button>
        </form>
    </div>
</div>