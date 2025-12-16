<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Library CMS') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Outfit', sans-serif;
        }

        .hover-lift {
            transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.3s ease;
        }

        .hover-lift:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.1);
        }

        .fade-in-up {
            animation: fadeInUp 0.8s ease-out forwards;
            opacity: 0;
            transform: translateY(20px);
        }

        .delay-100 {
            animation-delay: 0.1s;
        }

        .delay-200 {
            animation-delay: 0.2s;
        }

        .delay-300 {
            animation-delay: 0.3s;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body class="bg-[#F8F9FA] text-slate-800 antialiased selection:bg-indigo-500 selection:text-white">

    <!-- Navbar -->
    <nav class="fixed w-full z-50 bg-white/80 backdrop-blur-md border-b border-slate-100 transition-all duration-300"
        id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center gap-3">
                    <div
                        class="w-10 h-10 bg-indigo-600 rounded-lg flex items-center justify-center text-white shadow-indigo-200 shadow-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                            </path>
                        </svg>
                    </div>
                    <span class="font-bold text-xl tracking-tight text-slate-900">ModernLib</span>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    @foreach($menus as $menu)
                        <a href="{{ $menu->url ?? '#' }}"
                            class="text-sm font-medium text-slate-600 hover:text-indigo-600 transition-colors relative group">
                            {{ $menu->label }}
                            <span
                                class="absolute -bottom-1 left-0 w-0 h-0.5 bg-indigo-600 transition-all duration-300 group-hover:w-full"></span>
                        </a>
                    @endforeach
                    <!-- Auth Links -->
                    <div class="flex items-center gap-4 ml-6 border-l border-slate-200 pl-6">
                        @auth
                            <a href="{{ route('dashboard') }}"
                                class="text-sm font-medium text-slate-600 hover:text-indigo-600">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}"
                                class="px-5 py-2.5 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-full transition-all shadow-md hover:shadow-lg transform hover:-translate-y-0.5">Sign
                                In</a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <span
                class="inline-block py-1 px-3 rounded-full bg-indigo-50 text-indigo-600 text-xs font-bold tracking-wide uppercase mb-6 fade-in-up">Welcome
                to the future of reading</span>
            <h1
                class="text-5xl md:text-7xl font-bold text-slate-900 tracking-tight mb-8 leading-tight fade-in-up delay-100">
                Discover, Learn, <br class="hidden md:block" /> and <span class="text-indigo-600">Grow Together.</span>
            </h1>
            <p class="mt-4 max-w-2xl mx-auto text-xl text-slate-500 mb-10 fade-in-up delay-200">
                Access a world of knowledge, community events, and digital resources through our modern library portal.
            </p>
            <div class="flex justify-center gap-4 fade-in-up delay-300">
                <a href="#news"
                    class="px-8 py-4 text-base font-semibold text-white bg-slate-900 rounded-full hover:bg-slate-800 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                    Latest News
                </a>
                <a href="#staff"
                    class="px-8 py-4 text-base font-semibold text-slate-700 bg-white border border-slate-200 rounded-full hover:bg-slate-50 transition-all">
                    Meet Our Team
                </a>
            </div>
        </div>

        <!-- Decorative bg elements (Circles instead of gradients) -->
        <div
            class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-indigo-50/50 rounded-full blur-3xl -z-10">
        </div>
        <div
            class="absolute top-0 right-0 w-96 h-96 bg-blue-50/50 rounded-full blur-3xl -z-10 translate-x-1/3 -translate-y-1/3">
        </div>
    </header>

    <!-- News & Updates Section -->
    <section id="news" class="py-24 bg-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-slate-900 mb-4">Latest News & Updates</h2>
                <div class="w-20 h-1 bg-indigo-600 mx-auto rounded-full"></div>
            </div>

            <!-- Empty State -->
            @if($pages->isEmpty() && $news->isEmpty())
                <!-- Note: Assuming 'pages' are used as main content updates if news model technically separate but here generic -->
                <div class="text-center py-12">
                    <div
                        class="w-16 h-16 bg-slate-50 text-slate-300 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                            </path>
                        </svg>
                    </div>
                    <p class="text-slate-500 text-lg">No updates published yet. Check back soon!</p>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @if($news->isNotEmpty())
                    @foreach($news as $article)
                        <a href="{{ route('public.news.show', $article->slug) }}"
                            class="group bg-white rounded-2xl border border-slate-100 p-8 hover-lift cursor-pointer h-full flex flex-col">
                            @if($article->image_path)
                                <div class="mb-6 overflow-hidden rounded-xl">
                                    <img src="{{ '/storage/' . $article->image_path }}" alt="{{ $article->title }}"
                                        class="w-full h-40 object-cover group-hover:scale-105 transition-transform duration-300">
                                </div>
                            @endif

                            <div class="flex items-center gap-3 mb-4">
                                <span
                                    class="px-3 py-1 bg-indigo-50 text-indigo-700 text-xs font-bold uppercase tracking-wide rounded-full">News</span>
                                <span class="text-slate-400 text-xs font-medium">
                                    {{ optional($article->published_at)->format('M d, Y') }}
                                </span>
                            </div>
                            <h3 class="text-2xl font-bold text-slate-900 mb-3 group-hover:text-indigo-600 transition-colors">
                                {{ $article->title }}
                            </h3>
                            <p class="text-slate-500 mb-6 flex-grow leading-relaxed">
                                {{ Str::limit($article->excerpt ?: strip_tags($article->content), 120) }}
                            </p>
                            <div
                                class="flex items-center text-indigo-600 font-semibold text-sm group-hover:translate-x-2 transition-transform">
                                Read Announcement <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </div>
                        </a>
                    @endforeach
                @else
                    @foreach($pages as $page)
                        <article
                            class="group bg-white rounded-2xl border border-slate-100 p-8 hover-lift cursor-pointer h-full flex flex-col">
                            <div class="flex items-center gap-3 mb-4">
                                <span
                                    class="px-3 py-1 bg-indigo-50 text-indigo-700 text-xs font-bold uppercase tracking-wide rounded-full">Page</span>
                                <span
                                    class="text-slate-400 text-xs font-medium">{{ $page->updated_at->format('M d, Y') }}</span>
                            </div>
                            <h3 class="text-2xl font-bold text-slate-900 mb-3 group-hover:text-indigo-600 transition-colors">
                                <a href="{{ route('public.page', $page->slug) }}">
                                    {{ $page->title }}
                                </a>
                            </h3>
                            <p class="text-slate-500 mb-6 flex-grow leading-relaxed">
                                {{ Str::limit($page->meta_description ?? 'Click to read more about this topic.', 120) }}
                            </p>
                            <div
                                class="flex items-center text-indigo-600 font-semibold text-sm group-hover:translate-x-2 transition-transform">
                                Read Article <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </div>
                        </article>
                    @endforeach
                @endif
            </div>

            @if($news->isNotEmpty())
                <div class="text-center mt-12">
                    <a href="{{ route('public.news.index') }}"
                        class="inline-flex items-center gap-2 px-6 py-3 text-sm font-semibold text-slate-700 bg-white border border-slate-200 rounded-full hover:bg-slate-50 transition-all">
                        View All Announcements
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
            @endif
        </div>
    </section>

    <!-- Staff Section -->
    <section id="staff" class="py-24 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-6">
                <div>
                    <h2 class="text-3xl font-bold text-slate-900 mb-4">Meet Our Team</h2>
                    <p class="text-slate-500 max-w-lg text-lg">Dedicated professionals committed to serving our
                        community and helping you find exactly what you need.</p>
                </div>
                <!-- Controls or Link could go here -->
            </div>

            @if($staff->isEmpty())
                <div class="text-center py-12 border-2 border-dashed border-slate-200 rounded-xl">
                    <p class="text-slate-400 font-medium">Our team list is being updated.</p>
                </div>
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($staff as $member)
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 text-center hover-lift group">
                        <div class="w-24 h-24 mx-auto mb-6 relative">
                            @if($member->profile_image)
                                <img src="{{ Storage::url($member->profile_image) }}"
                                    class="w-full h-full object-cover rounded-full group-hover:scale-110 transition-transform duration-300">
                            @else
                                <div
                                    class="w-full h-full bg-indigo-100 text-indigo-600 flex items-center justify-center rounded-full text-2xl font-bold group-hover:bg-indigo-600 group-hover:text-white transition-colors duration-300">
                                    {{ substr($member->name, 0, 1) }}
                                </div>
                            @endif
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 mb-1">{{ $member->name }}</h3>
                        <p class="text-indigo-600 font-medium text-sm mb-4">{{ $member->position }}</p>
                        @if($member->bio)
                            <p class="text-slate-500 text-sm mb-4 line-clamp-2">{{ $member->bio }}</p>
                        @endif
                        <div
                            class="flex justify-center gap-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300 transform translate-y-2 group-hover:translate-y-0">
                            @if($member->email)
                                <a href="mailto:{{ $member->email }}"
                                    class="w-8 h-8 rounded-full bg-slate-100 text-slate-600 flex items-center justify-center hover:bg-indigo-600 hover:text-white transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Resources / Footer CTA -->
    <section class="py-24 bg-slate-900 text-white relative overflow-hidden">
        <div class="absolute inset-0 opacity-20 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]">
        </div>
        <div class="max-w-4xl mx-auto px-4 text-center relative z-10">
            <h2 class="text-4xl font-bold mb-6">Explore Our Digital Resources</h2>
            <p class="text-slate-300 text-xl mb-10">Access our curated collection of online tools, databases, and
                learning materials from anywhere.</p>

            <div class="flex flex-wrap justify-center gap-4 mb-12">
                @foreach($resources as $resource)
                    <a href="{{ $resource->url }}" target="_blank"
                        class="px-6 py-3 bg-white/10 hover:bg-white/20 border border-white/10 rounded-lg backdrop-blur-sm transition-all text-sm font-medium flex items-center gap-2">
                        <svg class="w-4 h-4 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                        </svg>
                        {{ $resource->title }}
                    </a>
                @endforeach
                @if($resources->isEmpty())
                    <span class="text-slate-500 italic">Resources updating soon...</span>
                @endif
            </div>

            <p class="text-slate-500 text-sm">© {{ date('Y') }} {{ config('app.name', 'Library CMS') }}. All rights
                reserved.</p>
        </div>
    </section>

</body>

</html>