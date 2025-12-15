@extends('layouts.public')

@section('title', 'Resources')

@section('content')
    <div class="bg-gray-50 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h1 class="text-4xl font-extrabold text-gray-900 sm:text-5xl">Library Resources</h1>
                <p class="mt-4 text-xl text-gray-600">Useful links and databases for your research.</p>
            </div>

            @forelse($resourceLinks as $category => $links)
                <div class="mb-12">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 border-b-2 border-emerald-500 pb-2 inline-block">
                        {{ ucfirst($category) ?: 'General Resources' }}
                    </h2>
                    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                        @foreach($links as $link)
                            <a href="{{ $link->url }}" target="_blank" rel="noopener noreferrer"
                                class="block group bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md hover:border-emerald-300 transition-all duration-200">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <span
                                            class="inline-flex items-center justify-center h-12 w-12 rounded-full bg-emerald-50 text-emerald-600 group-hover:bg-emerald-100 transition-colors">
                                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="ml-4">
                                        <h3
                                            class="text-lg font-medium text-gray-900 group-hover:text-emerald-700 transition-colors">
                                            {{ $link->title }}
                                        </h3>
                                        @if($link->description)
                                            <p class="mt-1 text-sm text-gray-500 group-hover:text-gray-600">
                                                {{ $link->description }}
                                            </p>
                                        @endif
                                        <div class="mt-3 flex items-center text-sm text-emerald-600 font-medium">
                                            Visit Link
                                            <svg class="ml-1 w-4 h-4 transition-transform transform group-hover:translate-x-1"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @empty
                <div class="text-center py-12 bg-white rounded-xl shadow-sm border border-gray-200">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">No resources found</h3>
                    <p class="mt-1 text-sm text-gray-500">Check back later for updates.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection