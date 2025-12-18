<nav class="navbar mb-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <!-- Logo -->
            <div class="flex">
                <a href="{{ route('public.home') }}" class="flex items-center">
                    <img src="{{ asset('assets/main-logo.png') }}" alt="AddLib Logo" class="h-10 w-auto">
                </a>
                <!-- Nav Links -->
                <div class=" hidden md:flex items-center gap-8 ml-10">
                    @foreach($navbarMenu as $item)
                        <a href="{{ url($item->url) }}"
                            class="hover_nav text-sm font-medium {{ (request()->is(ltrim($item->url, '/')) || request()->is(ltrim($item->url, '/') . '/*')) ? 'text-primary-accent' : 'text-gray-600 hover:text-primary-text' }} transition-smooth">
                            {{ $item->label }}
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Right: Actions -->
            <div class="flex items-center gap-4">
                @auth
                    <div class="relative" x-data="{ open: false }" @click.away="open = false" @close.stop="open = false">
                        <button @click="open = !open" class="flex items-center gap-3 focus:outline-none group">
                            <div class="flex flex-col items-end hidden md:flex">
                                <span class="text-sm font-bold text-gray-900 group-hover:text-primary-accent transition-colors">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span>
                                <span class="text-[10px] text-gray-500 uppercase tracking-wider">{{ Auth::user()->role }}</span>
                            </div>
                            <div class="h-10 w-10 rounded-full bg-primary-bg flex items-center justify-center text-primary-accent font-bold border-2 border-transparent group-hover:border-primary-accent transition-all overflow-hidden shadow-sm">
                                @if (Auth::user()->profile_picture)
                                    <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="{{ Auth::user()->name }}"
                                        class="w-full h-full object-cover">
                                @else
                                    {{ substr(Auth::user()->first_name, 0, 1) }}
                                @endif
                            </div>
                            <svg class="w-4 h-4 text-gray-400 group-hover:text-primary-accent transition-colors duration-200" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>

                        <div x-show="open"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="opacity-100 scale-100"
                             x-transition:leave-end="opacity-0 scale-95"
                             class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-lg ring-1 ring-black ring-opacity-5 z-[100] origin-top-right py-1"
                             style="display: none;">
                            
                            <div class="px-4 py-3 border-b border-gray-100 md:hidden">
                                <p class="text-sm font-bold text-gray-900">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                            </div>

                            <a href="{{ route('dashboard') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary-accent transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                                View Dashboard
                            </a>
                            
                            <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary-accent transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                Account Settings
                            </a>
                            
                            <div class="border-t border-gray-100 my-1"></div>
                            
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="flex w-full items-center gap-2 px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition-colors text-left">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                    Sign Out
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('register') }}" class="navbar_button">Sign Up</a>
                    <a href="{{ route('login') }}" class="navbar_button_login">Login</a>
                @endauth
            </div>

            <!-- Mobile Menu Button (Hamburger) - retained for mobile support -->
            <div class="-mr-2 flex items-center md:hidden">
                <button type="button"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
                    aria-label="Main menu" aria-expanded="false">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</nav>