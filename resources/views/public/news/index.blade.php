@extends('layouts.public')

@section('title', 'News & Announcements')

@section('content')
<div class="bg-[#efeae4] py-12 page-animate opacity-0 transition-opacity duration-300 ease-in-out">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h4 class="title_card fade-in-up">
                News & <span class="italic" style="color: #ec3412;">Announcements.</span>
            </h4>
            <p class="mt-4 text-xl text-slate-500">Latest updates from our library.</p>
        </div>

        <div class="flex flex-wrap justify-center gap-8">
            @forelse($news as $article)
            <a href="{{ route('public.news.show', $article->slug) }}"
                class="home-card animate-link group w-full sm:w-96 flex flex-col h-full hover:-translate-y-1 hover:shadow-xl transition-all duration-300">
                @if($article->image_path)
                <img src="{{ str_starts_with($article->image_path, 'resources/img') ? url($article->image_path) : '/storage/' . $article->image_path }}" alt="{{ $article->title }}"
                    class="home-card-image w-full h-48 object-cover rounded-xl mb-4">
                @else
                <div class="home-card-image w-full h-48 bg-indigo-50 flex items-center justify-center rounded-xl mb-4">
                    <svg class="h-12 w-12 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                    </svg>
                </div>
                @endif
                <div class="flex flex-col flex-1">
                    <span
                        class="home-card-tag inline-block px-3 py-1 bg-red-50 text-red-600 rounded-full text-xs font-bold uppercase tracking-wider mb-2 self-start">News</span>
                    <span
                        class="text-slate-400 text-xs font-medium ml-2 absolute top-6 right-6 bg-white/80 px-2 py-1 rounded-md backdrop-blur-sm">
                        {{ $article->published_at ? $article->published_at->format('M d, Y') : 'Draft' }}
                    </span>
                    <h3
                        class="home-card-title text-xl font-bold text-gray-900 mb-2 leading-tight group-hover:text-red-600 transition-colors">
                        {{ $article->title }}
                    </h3>
                    <p class="home-card-text text-gray-500 text-sm mb-4 line-clamp-3">
                        {{ $article->excerpt ?? Str::limit(strip_tags($article->content), 100) }}
                    </p>
                    <span
                        class="home-card-link mt-auto flex items-center gap-1 text-red-600 font-medium text-sm transition-gap">
                        Read Announcement
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </span>
                </div>
            </a>
            @empty
            <div class="w-full text-center py-12">
                <p class="text-gray-500 text-lg">No news articles found.</p>
            </div>
            @endforelse
        </div>

        <div class="mt-12">
            {{ $news->links() }}
        </div>
    </div>
</div>

<script>
    // Handle page entry transition
    window.addEventListener('pageshow', (event) => {
        const pageContent = document.querySelector('.page-animate');
        if (pageContent) {
            // Use requestAnimationFrame to ensure the transition triggers
            requestAnimationFrame(() => {
                pageContent.classList.remove('opacity-0');
            });
        }
    });

    // Handle page exit transition
    document.addEventListener('DOMContentLoaded', () => {
        const links = document.querySelectorAll('.animate-link');
        const pageContent = document.querySelector('.page-animate');

        links.forEach(link => {
            link.addEventListener('click', (e) => {
                // Only animate if it's a normal left click without modifiers
                if (e.button === 0 && !e.ctrlKey && !e.shiftKey && !e.altKey && !e.metaKey) {
                    e.preventDefault();
                    const href = link.getAttribute('href');

                    if (pageContent) {
                        pageContent.classList.add('opacity-0');
                        setTimeout(() => {
                            window.location.href = href;
                        }, 300); // Maintained to match duration-300
                    } else {
                        window.location.href = href;
                    }
                }
            });
        });
    });
</script>
@endsection