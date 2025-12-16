@extends('layouts.public')

@section('title', $article->title)

@section('content')
<div class="bg-gray-50 py-12 page-animate opacity-0 transition-opacity duration-300 ease-in-out">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <article class="bg-white rounded-2xl shadow-sm overflow-hidden">
            @if($article->image_path)
            <div class="w-full h-64 md:h-96 bg-gray-100 flex items-center justify-center">
                <img class="max-w-full max-h-full object-contain" src="{{ str_starts_with($article->image_path, 'resources/img') ? url($article->image_path) : '/storage/' . $article->image_path }}"
                    alt="{{ $article->title }}">
            </div>
            @endif

            <div class="p-8 md:p-12">
                <header class="mb-8">
                    <div class="flex items-center text-sm text-gray-500 mb-4">
                        <span class="flex items-center">
                            <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            {{ $article->published_at ? $article->published_at->format('F d, Y') : 'Draft' }}
                        </span>
                        @if($article->author)
                        <span class="mx-2">&bull;</span>
                        <span class="flex items-center">
                            <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            {{ $article->author->name }}
                        </span>
                        @endif
                    </div>
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-900 leading-tight mb-4">
                        {{ $article->title }}
                    </h1>
                </header>

                <div class="news-content text-gray-700 leading-relaxed">
                    {!! $article->content !!}
                </div>

                <div class="mt-8 pt-8 border-t border-gray-100">
                    <a href="{{ route('public.news.index') }}"
                        class="inline-flex items-center text-emerald-600 hover:text-emerald-700 font-medium animate-link">
                        <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Back to News
                    </a>
                </div>
            </div>
        </article>
    </div>
</div>

<script>
    // Handle page entry transition
    window.addEventListener('pageshow', (event) => {
        const pageContent = document.querySelector('.page-animate');
        if (pageContent) {
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
                if (e.button === 0 && !e.ctrlKey && !e.shiftKey && !e.altKey && !e.metaKey) {
                    e.preventDefault();
                    const href = link.getAttribute('href');

                    if (pageContent) {
                        pageContent.classList.add('opacity-0');
                        setTimeout(() => {
                            window.location.href = href;
                        }, 300);
                    } else {
                        window.location.href = href;
                    }
                }
            });
        });
    });
</script>
@endsection