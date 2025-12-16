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
                    <div class="flex flex-col items-end mr-2">
                        <span class="dashboard_name text-primary-text font-semibold text-sm">{{ Auth::user()->name }}</span>
                        <a href="{{ route('dashboard') }}"
                            class="dashboard_button text-xs text-primary-accent hover:text-red-700 font-medium transition-smooth">
                            View Dashboard
                        </a>
                    </div>
                    <div
                        class="circle_profile h-10 w-10 rounded-full bg-primary-bg flex items-center justify-center text-primary-accent font-bold border border-gray-200">
                        {{ substr(Auth::user()->name, 0, 1) }}
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