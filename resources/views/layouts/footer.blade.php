<footer class="footer_section bg-white border-t border-gray-200 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
            <!-- Branding Column -->
            <div class="flex flex-col gap-3">
                <div class="flex items-center gap-2">
                    <img src="{{ asset('assets/main-logo.png') }}" alt="AddLib Logo" class="h-8 w-auto opacity-90">
                    <span
                        class="text-lg font-bold bg-clip-text text-transparent bg-gradient-to-r from-red-600 to-orange-500">AddLib</span>
                </div>
                <p class="text-gray-500 text-xs leading-relaxed max-w-xs">
                    Empowering our community with knowledge, digital tools, and a space for lifelong learning.
                </p>
                <div class="flex gap-3 mt-1">
                    <!-- Social placeholders -->
                    <div
                        class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center text-gray-400 hover:bg-red-50 hover:text-red-600 transition-colors cursor-pointer">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Resources Column -->
            <div>
                <h5 class="text-xs font-bold text-gray-900 uppercase tracking-wider mb-3">Digital Resources</h5>
                <ul class="space-y-2">
                    @forelse($footerResources ?? [] as $resource)
                        <li>
                            <a href="{{ $resource->url }}" target="_blank"
                                class="text-gray-500 hover:text-red-600 text-sm transition-colors flex items-center gap-2 group">
                                <span
                                    class="w-1 h-1 bg-gray-300 rounded-full group-hover:bg-red-500 transition-colors"></span>
                                {{ $resource->title }}
                            </a>
                        </li>
                    @empty
                        <li class="text-gray-400 text-sm italic">Coming soon...</li>
                    @endforelse
                </ul>
            </div>

            <!-- Quick Links Column -->
            <div>
                <h5 class="text-xs font-bold text-gray-900 uppercase tracking-wider mb-3">Quick Links</h5>
                <ul class="space-y-2">
                    <li><a href="{{ route('public.books.index') }}"
                            class="text-gray-500 hover:text-red-600 text-sm transition-colors">Search Books</a></li>
                    <li><a href="{{ route('public.news.index') }}"
                            class="text-gray-500 hover:text-red-600 text-sm transition-colors">Latest News</a></li>
                    <li><a href="{{ route('public.staff.index') }}"
                            class="text-gray-500 hover:text-red-600 text-sm transition-colors">Our Team</a></li>
                </ul>
            </div>
        </div>

        <div
            class="pt-6 border-t border-gray-100 flex flex-col md:flex-row justify-between items-center gap-4 text-xs text-gray-400">
            <p>&copy; {{ date('Y') }} AddLib. All rights reserved.</p>
            <div class="flex gap-6">
                <a href="#" class="hover:text-gray-600">Privacy Policy</a>
                <a href="#" class="hover:text-gray-600">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>