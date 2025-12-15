@extends('layouts.public')

@section('title', $book->title)

@section('content')
    <div class="bg-white min-h-screen pb-20">
        <!-- Breadcrumb & Back -->
        <div class="bg-gray-50 border-b border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                <a href="{{ route('public.books.index') }}"
                    class="group inline-flex items-center text-sm font-medium text-gray-500 hover:text-emerald-600 transition-colors">
                    <svg class="h-5 w-5 mr-1 text-gray-400 group-hover:text-emerald-500 transition-colors" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 16l-4-4m0 0l4-4m-4 4h18" />
                    </svg>
                    Back to Catalog
                </a>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="lg:grid lg:grid-cols-2 lg:gap-x-12 xl:gap-x-16">
                <!-- Image Gallery -->
                <div class="product-image-gallery">
                    <div
                        class="aspect-w-3 aspect-h-4 bg-gray-100 rounded-2xl overflow-hidden shadow-lg border border-gray-200">
                        <img src="{{ $book->cover_image_url }}" alt="{{ $book->title }}" class="w-full h-full object-cover">
                    </div>

                    <!-- Availability Status -->
                    <div class="mt-6 flex items-center justify-center p-4 bg-gray-50 rounded-xl border border-gray-100">
                        <div class="flex items-center">
                            @if($book->quantity > 0)
                                <span class="flex h-3 w-3 relative mr-3">
                                    <span
                                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-500"></span>
                                </span>
                                <span class="font-medium text-emerald-700">Available Now ({{ $book->quantity }} copies)</span>
                            @else
                                <span class="h-3 w-3 rounded-full bg-red-400 mr-3"></span>
                                <span class="font-medium text-red-600">Currently Unavailable</span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Product Info -->
                <div class="mt-10 px-4 sm:px-0 sm:mt-16 lg:mt-0">
                    <div class="mb-6">
                        <h1 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">{{ $book->title }}</h1>
                        <div class="mt-3 flex items-center">
                            <p class="text-lg text-emerald-600 font-medium">{{ $book->author->name ?? 'Unknown Author' }}
                            </p>
                            <span class="mx-3 text-gray-300">|</span>
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                {{ $book->category->name ?? 'General' }}
                            </span>
                        </div>
                    </div>

                    <div class="content prose prose-emerald prose-lg text-gray-500 mb-8">
                        <h3 class="text-gray-900 font-bold text-lg mb-2">Description</h3>
                        <p>{{ $book->description }}</p>
                    </div>

                    <div class="border-t border-gray-200 pt-8">
                        <h3 class="text-sm font-medium text-gray-900">Details</h3>
                        <dl class="mt-4 grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                            @if($book->isbn)
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500">ISBN</dt>
                                    <dd class="mt-1 text-sm text-gray-900 font-mono">{{ $book->isbn }}</dd>
                                </div>
                            @endif
                            @if($book->publication_date)
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500">Publication Date</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $book->publication_date->format('F j, Y') }}</dd>
                                </div>
                            @endif
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">Category</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $book->category->name ?? 'N/A' }}</dd>
                            </div>
                        </dl>
                    </div>

                    <!-- Call to Action -->
                    @if($book->quantity > 0)
                        <div class="mt-10">
                            <button type="button"
                                class="w-full bg-gradient-to-r from-emerald-600 to-teal-600 border border-transparent rounded-xl py-3 px-8 flex items-center justify-center text-base font-medium text-white hover:from-emerald-700 hover:to-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 shadow-lg shadow-emerald-200 transform hover:-translate-y-1 transition-all duration-300">
                                Reserve This Book
                            </button>
                            <p class="mt-2 text-center text-sm text-gray-400">Reserve now and pick up at the library counter
                                within 24 hours.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Related/Other Books Carousel (Simple Grid for now) -->
            <div class="mt-16 border-t border-gray-200 pt-16">
                <h2 class="text-2xl font-extrabold tracking-tight text-gray-900">You might also like</h2>

                <div class="mt-8 grid grid-cols-1 gap-y-12 sm:grid-cols-2 sm:gap-x-6 lg:grid-cols-4 xl:gap-x-8">
                    <!-- Fetching 4 random books via PHP in View for demo or Controller should pass 'related_books' -->
                    @foreach(\App\Models\Book::inRandomOrder()->take(4)->get() as $relatedBook)
                        <div class="group relative">
                            <div
                                class="relative w-full h-72 rounded-lg overflow-hidden bg-gray-100 shadow-sm group-hover:shadow-md transition-shadow">
                                <img src="{{ $relatedBook->cover_image_url }}" alt="{{ $relatedBook->title }}"
                                    class="w-full h-full object-center object-cover group-hover:opacity-75 transition-opacity">
                            </div>
                            <div class="mt-4">
                                <h3 class="text-sm text-gray-700">
                                    <a href="{{ route('public.books.show', $relatedBook->slug) }}">
                                        <span class="absolute inset-0"></span>
                                        {{ $relatedBook->title }}
                                    </a>
                                </h3>
                                <p class="mt-1 text-sm text-gray-500">{{ $relatedBook->author->name }}</p>
                                <p class="mt-1 text-sm font-medium text-emerald-600">{{ $relatedBook->category->name }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection