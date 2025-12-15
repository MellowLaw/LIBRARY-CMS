@extends('layouts.public')

@section('title', 'Library Catalog')

@section('content')
    <div class="bg-gray-50 min-h-screen">
        <!-- Hero Section -->
        <div class="bg-white border-b border-gray-100">
            <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8 text-center">
                <h1
                    class="text-4xl font-extrabold tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-teal-500 sm:text-5xl md:text-6xl mb-4">
                    Discover Your Next Read
                </h1>
                <p class="max-w-xl mx-auto text-lg text-gray-500">
                    Explore our extensive collection of books across various genres. From timeless classics to contemporary
                    bestsellers.
                </p>

                <!-- Search Bar -->
                <div class="mt-8 max-w-xl mx-auto">
                    <form action="{{ route('public.books.index') }}" method="GET" class="relative group">
                        <div
                            class="absolute -inset-0.5 bg-gradient-to-r from-emerald-600 to-teal-500 rounded-full blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200">
                        </div>
                        <div class="relative flex items-center bg-white rounded-full shadow-sm p-2">
                            <div class="flex-shrink-0 pl-3">
                                <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <input type="text" name="search" value="{{ request('search') }}"
                                class="block w-full border-0 focus:ring-0 text-gray-900 placeholder-gray-500 sm:text-sm p-2"
                                placeholder="Search by title, author, or ISBN...">
                            <button type="submit"
                                class="inline-flex items-center px-6 py-2 border border-transparent text-sm font-medium rounded-full shadow-sm text-white bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                                Search
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Sidebar Filters -->
                <div class="w-full lg:w-64 flex-shrink-0 space-y-8">
                    <!-- Categories -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                            Categories
                        </h3>
                        <div class="space-y-2">
                            <a href="{{ route('public.books.index') }}"
                                class="block px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ !request('category') ? 'bg-emerald-50 text-emerald-700' : 'text-gray-600 hover:bg-gray-50' }}">
                                All Categories
                            </a>
                            @foreach($categories as $category)
                                <a href="{{ route('public.books.index', ['category' => $category->slug]) }}"
                                    class="block px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ request('category') == $category->slug ? 'bg-emerald-50 text-emerald-700' : 'text-gray-600 hover:bg-gray-50' }}">
                                    {{ $category->name }}
                                    <span
                                        class="float-right text-xs text-gray-400 bg-gray-100 px-2 py-0.5 rounded-full">{{ $category->books_count }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="flex-1">
                    @if($books->isEmpty())
                        <div class="text-center py-20 bg-white rounded-2xl border border-gray-100">
                            <svg class="mx-auto h-12 w-12 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No books found</h3>
                            <p class="mt-1 text-sm text-gray-500">Try adjusting your search or filter to find what you're
                                looking for.</p>
                            <div class="mt-6">
                                <a href="{{ route('public.books.index') }}"
                                    class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-emerald-700 bg-emerald-100 hover:bg-emerald-200">
                                    Clear filters
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                            @foreach($books as $book)
                                <a href="{{ route('public.books.show', $book->slug) }}"
                                    class="group block bg-white rounded-2xl shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300 overflow-hidden border border-gray-100">
                                    <!-- Book Cover -->
                                    <div class="relative aspect-[2/3] overflow-hidden bg-gray-200">
                                        <img src="{{ $book->cover_image_url }}" alt="{{ $book->title }}"
                                            class="absolute inset-0 w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                                        <div
                                            class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-60 group-hover:opacity-40 transition-opacity duration-300">
                                        </div>

                                        <!-- Badge -->
                                        <div class="absolute top-4 left-4">
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-white/90 backdrop-blur text-gray-800 shadow-sm">
                                                {{ $book->category->name ?? 'General' }}
                                            </span>
                                        </div>

                                        <!-- Hover Info -->
                                        <div
                                            class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-black/30 backdrop-blur-[2px]">
                                            <span
                                                class="inline-flex items-center px-4 py-2 border border-white text-sm font-medium rounded-full text-white hover:bg-white hover:text-black transition-colors">
                                                View Details
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Content -->
                                    <div class="p-6">
                                        <h4
                                            class="text-lg font-bold text-gray-900 mb-1 line-clamp-1 group-hover:text-emerald-600 transition-colors">
                                            {{ $book->title }}</h4>
                                        <p class="text-sm text-gray-500 mb-4">{{ $book->author->name ?? 'Unknown Author' }}</p>

                                        <div
                                            class="flex items-center justify-between text-xs text-gray-400 pt-4 border-t border-gray-50">
                                            <span class="flex items-center">
                                                <svg class="w-4 h-4 mr-1 text-emerald-500" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                                {{ optional($book->publication_date)->format('Y') ?? 'N/A' }}
                                            </span>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>

                        <div class="mt-8">
                            {{ $books->withQueryString()->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection