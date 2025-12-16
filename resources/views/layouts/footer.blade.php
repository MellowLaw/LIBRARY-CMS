<footer class="footer_section bg-white border-t border-gray-200 py-12">
    <footer class="footer_content bg-white border-t border-gray-100 mt-auto">
        <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <!-- Branding -->
                <div class="flex items-center gap-3">
                    <img src="{{ asset('assets/main-logo.png') }}" alt="AddLib Logo" class="h-10 w-auto opacity-90">
                    <span class="text-sm text-gray-400 border-l border-gray-300 pl-3 ml-3">
                        A Library Management System
                    </span>
                </div>

                <!-- Links/Copyright -->
                <div class="flex items-center gap-6 text-sm text-gray-400">
                    <a href="{{ route('public.resources.index') }}"
                        class="hover:text-gray-600 transition-colors">Resources</a>
                    <span>&copy; {{ date('Y') }} AddLib. All rights reserved.</span>
                </div>
            </div>
        </div>
    </footer>