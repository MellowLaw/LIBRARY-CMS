@extends('layouts.public')

@section('title', 'News & Announcements')

@section('content')
    <div class="bg-[#F8F9FA] py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h1 class="text-4xl font-bold text-slate-900">News & Announcements</h1>
                <div class="w-20 h-1 bg-indigo-600 mx-auto rounded-full mt-4"></div>
                <p class="mt-4 text-xl text-slate-500">Latest updates from our library.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($news as $article)
                    <div
                        class="group bg-white rounded-2xl border border-slate-100 shadow-sm hover-lift cursor-pointer h-full flex flex-col overflow-hidden">
                        @if($article->image_path)
                            <div class="overflow-hidden">
                                <img class="h-48 w-full object-cover group-hover:scale-105 transition-transform duration-300"
                                    src="{{ '/storage/' . $article->image_path }}" alt="{{ $article->title }}">
                            </div>
                        @else
                            <div class="h-48 w-full bg-indigo-50 flex items-center justify-center">
                                <svg class="h-12 w-12 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                                </svg>
                            </div>
                        @endif
                        <div class="p-8 flex flex-col flex-grow">
                            <div class="flex items-center gap-3 mb-4">
                                <span
                                    class="px-3 py-1 bg-indigo-50 text-indigo-700 text-xs font-bold uppercase tracking-wide rounded-full">News</span>
                                <span class="text-slate-400 text-xs font-medium">
                                    {{ $article->published_at ? $article->published_at->format('M d, Y') : 'Draft' }}
                                </span>
                            </div>
                            <h3
                                class="text-2xl font-bold text-slate-900 mb-3 group-hover:text-indigo-600 transition-colors break-words line-clamp-2">
                                {{ $article->title }}
                            </h3>
                            <p class="text-slate-500 mb-6 flex-grow leading-relaxed break-words line-clamp-3">
                                {{ $article->excerpt ?? Str::limit(strip_tags($article->content), 120) }}
                            </p>
                            <div
                                class="flex items-center text-indigo-600 font-semibold text-sm group-hover:translate-x-2 transition-transform">
                                Read Announcement
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
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