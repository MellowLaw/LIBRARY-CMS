@extends('layouts.public')

@section('title', 'News & Announcements')

@section('content')
    <div class="bg-[#efeae4] py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h4 class="title_card fade-in-up">
                    News & <span class="italic" style="color: #ec3412;">Announcements.</span>
                </h4>
                <p class="mt-4 text-xl text-slate-500">Latest updates from our library.</p>
            </div>

            <div class="home-grid-3">
                @forelse($news as $article)
                    <a href="{{ route('public.news.show', $article->slug) }}" class="home-card group">
                        @if($article->image_path)
                            <img src="{{ '/storage/' . $article->image_path }}" alt="{{ $article->title }}" class="home-card-image">
                        @else
                            <div class="home-card-image bg-indigo-50 flex items-center justify-center">
                                <svg class="h-12 w-12 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                                </svg>
                            </div>
                        @endif
                        <div>
                            <span class="home-card-tag">News</span>
                            <span class="text-slate-400 text-xs font-medium ml-2">
                                {{ $article->published_at ? $article->published_at->format('M d, Y') : 'Draft' }}
                            </span>
                            <h3 class="home-card-title mt-2">{{ $article->title }}</h3>
                            <p class="home-card-text">
                                {{ $article->excerpt ?? Str::limit(strip_tags($article->content), 100) }}
                            </p>
                            <span class="home-card-link">
                                Read Announcement
                                <svg class="w-4 h-4 text-primary-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </span>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full text-center py-12">
                        <p class="text-gray-500 text-lg">No news articles found.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-12">
                {{ $news->links() }}
            </div>
        </div>
    </div>
@endsection