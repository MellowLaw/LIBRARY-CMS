<nav class="bg-white border-b border-gray-200 px-8 py-4">
    <div class="flex items-center justify-between">
        <!-- Left: Page Title & Breadcrumb -->
        <div class="flex-1">
            <h2 class="text-2xl font-bold text-gray-900">@yield('page-title', 'Dashboard')</h2>
            <p class="text-sm text-gray-500 mt-1">@yield('page-subtitle', 'Welcome back to your library CMS')</p>
        </div>

        <!-- Right: User Profile & Actions -->
        <div class="flex items-center gap-6">
            <!-- Preview Button -->
            <a href="{{ route('public.home') }}" target="_blank"
                class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-emerald-50 text-emerald-700 hover:bg-emerald-100 transition-smooth font-medium text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                    </path>
                </svg>
                Preview
            </a>

            <!-- Notifications -->
            <div class="relative">
                <button class="relative p-2 text-gray-600 hover:bg-gray-100 rounded-lg transition-smooth">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                        </path>
                    </svg>
                    <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                </button>
            </div>

            <!-- User Dropdown -->
            <div class="flex items-center gap-3 pl-6 border-l border-gray-200" x-data="{ open: false }">
                <div class="relative">
                    <button @click="open = !open" class="flex items-center gap-3 group focus:outline-none">
                        <div
                            class="w-10 h-10 bg-gradient-to-br from-purple-400 to-pink-600 rounded-full flex items-center justify-center text-white font-bold transform group-hover:scale-105 transition-transform duration-200 shadow-md">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </div>
                        <div class="hidden sm:block text-left">
                            <p class="text-sm font-bold text-gray-900 group-hover:text-emerald-600 transition-colors">
                                {{ auth()->user()->name }}
                            </p>
                            <p class="text-xs text-gray-500 capitalize">{{ auth()->user()->role }}</p>
                        </div>
                        <svg class="w-4 h-4 text-gray-400 group-hover:text-emerald-500 transition-colors transform"
                            :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>

                    <!-- Dropdown Menu -->
                    <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 transform scale-95 -translate-y-2"
                        x-transition:enter-end="opacity-100 transform scale-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 transform scale-100 translate-y-0"
                        x-transition:leave-end="opacity-0 transform scale-95 -translate-y-2"
                        class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border border-gray-100 py-1 z-50 origin-top-right ring-1 ring-black ring-opacity-5 focus:outline-none"
                        style="display: none;">

                        <div class="px-4 py-2 border-b border-gray-100">
                            <p class="text-sm text-gray-500">Signed in as</p>
                            <p class="text-sm font-bold text-gray-900 truncate">{{ auth()->user()->email }}</p>
                        </div>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 hover:text-red-700 transition-colors">
                                Sign out
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>