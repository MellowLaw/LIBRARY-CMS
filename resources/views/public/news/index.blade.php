@extends('layouts.public')

@section('title', 'News & Announcements')

@section('content')
    <div class="bg-gray-50 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h1 class="text-4xl font-extrabold text-gray-900 sm:text-5xl">News & Announcements</h1>
                <p class="mt-4 text-xl text-gray-600">Latest updates from our library.</p>
            </div>

            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                @forelse($news as $article)
                    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                        @if($article->image_path)
                            <img class="h-48 w-full object-cover" src="{{ '/storage/' . $article->image_path }}"
                                alt="{{ $article->title }}">
                        @else
                            <div class="h-48 w-full bg-emerald-100 flex items-center justify-center">
                                <svg class="h-12 w-12 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                                </svg>
                            </div>
                        @endif
                        <div class="p-6">
                            <div class="text-sm text-emerald-600 mb-2">
                                {{ $article->published_at ? $article->published_at->format('M d, Y') : 'Draft' }}
                            </div>
                            <a href="{{ route('public.news.show', $article->slug) }}" class="block mt-2">
                                <h3 class="text-xl font-semibold text-gray-900 hover:text-emerald-600 transition-colors">
                                    {{ $article->title }}
                                </h3>
                            </a>
                            <p class="mt-3 text-base text-gray-500 line-clamp-3">
                                {{ $article->excerpt ?? Str::limit(strip_tags($article->content), 100) }}
                            </p>
                            <div class="mt-4">
                                <a href="{{ route('public.news.show', $article->slug) }}"
                                    class="text-emerald-600 hover:text-emerald-700 font-medium text-sm">
                                    Read more &rarr;
                                </a>
                            </div>
                        </div>
                    </div>
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