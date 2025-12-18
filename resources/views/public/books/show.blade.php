@extends('layouts.public')

@section('title', $book->title)

@section('content')
<div class="bg-[#efeae4] py-12 page-animate opacity-0 transition-opacity duration-300 ease-in-out">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Flash Messages -->
        @if (session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg animate-fade-in-out">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="text-green-800">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="text-red-800">{{ session('error') }}</span>
                </div>
            </div>
        @endif

        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="md:flex">
                <!-- Book Cover -->
                <div class="md:w-1/3 bg-gradient-to-br from-indigo-50 to-purple-50 p-8 flex items-center justify-center">
                    @if($book->cover_image)
                        <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}"
                            class="max-w-full h-auto shadow-2xl rounded-lg">
                    @else
                        <div class="w-64 h-96 bg-white shadow-2xl rounded-lg flex items-center justify-center">
                            <svg class="h-32 w-32 text-indigo-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                    @endif
                </div>

                <!-- Book Details -->
                <div class="md:w-2/3 p-8">
                    <div class="mb-4">
                        <span class="inline-block px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-sm font-semibold">
                            {{ $book->category->name }}
                        </span>
                    </div>

                    <h1 class="text-4xl font-bold text-gray-900 mb-2">{{ $book->title }}</h1>
                    <p class="text-xl text-gray-600 mb-6">by {{ $book->author }}</p>

                    @if($book->isbn)
                        <div class="mb-4">
                            <span class="text-sm text-gray-500 font-medium">ISBN: </span>
                            <span class="text-sm text-gray-700">{{ $book->isbn }}</span>
                        </div>
                    @endif

                    <!-- Availability Status -->
                    <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-sm font-semibold text-gray-700 mb-1">Availability</h3>
                                <div class="flex items-center gap-3">
                                    <span class="text-2xl font-bold text-gray-900">{{ $book->available_copies }}</span>
                                    <span class="text-gray-500">of {{ $book->total_copies }} available</span>
                                </div>
                            </div>
                            @if($book->available_copies > 0)
                                <span class="flex items-center gap-2 px-4 py-2 bg-green-100 text-green-700 rounded-lg font-semibold">
                                    <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                                    Available
                                </span>
                            @else
                                <span class="flex items-center gap-2 px-4 py-2 bg-red-100 text-red-700 rounded-lg font-semibold">
                                    <span class="w-2 h-2 bg-red-500 rounded-full"></span>
                                    Checked Out
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Borrow Button -->
                    @auth
                        @if ($isBorrowed)
                            <div class="mb-6 px-6 py-3 bg-indigo-600 text-white rounded-lg text-center font-semibold text-lg shadow-md">
                                Borrowed
                            </div>
                        @elseif($book->available_copies > 0)
                            <form action="{{ route('loans.borrow') }}" method="POST" class="mb-6">
                                @csrf
                                <input type="hidden" name="book_id" value="{{ $book->id }}">
                                <button type="submit"
                                    class="w-full px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors font-semibold text-lg shadow-md hover:shadow-lg">
                                    Borrow This Book
                                </button>
                            </form>
                        @else
                            <div class="mb-6 px-6 py-3 bg-gray-200 text-gray-600 rounded-lg text-center font-semibold">
                                Currently Unavailable
                            </div>
                        @endif
                    @else
                        <a href="{{ route('login') }}"
                            class="block w-full px-6 py-3 bg-gray-800 text-white rounded-lg hover:bg-gray-900 transition-colors font-semibold text-lg text-center shadow-md hover:shadow-lg mb-6">
                            Login to Borrow
                        </a>
                    @endauth

                    <!-- Description -->
                    @if($book->description)
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2 border-b border-gray-100 pb-2">About This Book</h3>
                            <p class="text-gray-700 leading-relaxed">{{ $book->description }}</p>
                        </div>
                    @endif

                    <!-- Contents -->
                    @if($book->contents)
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b border-gray-100 pb-2">Table of Contents</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-2">
                                @php
                                    $contentList = array_map('trim', explode(',', $book->contents));
                                @endphp
                                @foreach($contentList as $item)
                                    <div class="flex items-start gap-2 text-sm text-gray-600">
                                        <svg class="w-4 h-4 text-indigo-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <span>{{ $item }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Related Books -->
        @if($relatedBooks->count() > 0)
            <div class="mt-12">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Related Books</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($relatedBooks as $related)
                        <a href="{{ route('public.books.show', $related) }}"
                            class="home-card group flex flex-col h-full hover:-translate-y-1 hover:shadow-xl transition-all duration-300">
                            @if($related->cover_image)
                                <img src="{{ asset('storage/' . $related->cover_image) }}" alt="{{ $related->title }}"
                                    class="w-full h-48 object-cover rounded-lg mb-3">
                            @else
                                <div class="w-full h-48 bg-indigo-50 flex items-center justify-center rounded-lg mb-3">
                                    <svg class="h-12 w-12 text-indigo-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                </div>
                            @endif
                            <h3 class="text-base font-bold text-gray-900 mb-1 line-clamp-2 group-hover:text-red-600 transition-colors">
                                {{ $related->title }}
                            </h3>
                            <p class="text-sm text-gray-600">by {{ $related->author }}</p>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Back Button -->
        <div class="mt-8">
            <a href="{{ route('public.books.index') }}"
                class="inline-flex items-center gap-2 px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Back to Catalog
            </a>
        </div>
    </div>
</div>

<script>
    window.addEventListener('pageshow', (event) => {
        const pageContent = document.querySelector('.page-animate');
        if (pageContent) {
            requestAnimationFrame(() => {
                pageContent.classList.remove('opacity-0');
            });
        }
    });
</script>
@endsection