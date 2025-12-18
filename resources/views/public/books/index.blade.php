@extends('layouts.public')

@section('title', 'Book Catalog')

@section('content')
    <div class="bg-[#efeae4] py-12 page-animate opacity-0 transition-opacity duration-300 ease-in-out">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h4 class="title_card fade-in-up">
                    Book <span class="italic" style="color: #ec3412;">Catalog.</span>
                </h4>
                <p class="mt-4 text-xl text-slate-500">Explore our collection of books.</p>
            </div>

            <!-- Search and Filters -->
            <div class="mb-8 flex flex-col md:flex-row gap-4">
                <form action="{{ route('public.books.index') }}" method="GET" class="flex-1 flex gap-4">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Search by title or author..."
                        class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent bg-white shadow-sm">

                    <select name="category" onchange="this.form.submit()"
                        class="px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent bg-white shadow-sm">
                        <option value="">All Categories</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->slug }}" {{ request('category') == $cat->slug ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>

                    <button type="submit"
                        class="px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors shadow-sm">
                        Search
                    </button>
                </form>
            </div>

            <!-- Books Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @forelse($books as $book)
                    <a href="{{ route('public.books.show', $book) }}"
                        class="home-card animate-link group flex flex-col h-full hover:-translate-y-1 hover:shadow-xl transition-all duration-300">
                        @if($book->cover_image)
                            <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}"
                                class="home-card-image w-full h-64 object-cover rounded-xl mb-4">
                        @else
                            <div class="home-card-image w-full h-64 bg-indigo-50 flex items-center justify-center rounded-xl mb-4">
                                <svg class="h-20 w-20 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                        @endif
                        <div class="flex flex-col flex-1">
                            <span
                                class="home-card-tag inline-block px-3 py-1 bg-blue-50 text-blue-600 rounded-full text-xs font-bold uppercase tracking-wider mb-2 self-start">
                                {{ $book->category->name }}
                            </span>

                            @if(isset($borrowedBookIds) && in_array($book->id, $borrowedBookIds))
                                <span class="text-indigo-600 text-xs font-bold mb-2 flex items-center gap-1">
                                    <span class="w-2 h-2 bg-indigo-500 rounded-full"></span>
                                    Borrowed
                                </span>
                            @elseif($book->available_copies > 0)
                                <span class="text-green-600 text-xs font-medium mb-2 flex items-center gap-1">
                                    <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                                    Available
                                </span>
                            @else
                                <span class="text-red-600 text-xs font-medium mb-2 flex items-center gap-1">
                                    <span class="w-2 h-2 bg-red-500 rounded-full"></span>
                                    Checked Out
                                </span>
                            @endif

                            <h3
                                class="home-card-title text-lg font-bold text-gray-900 mb-1 leading-tight group-hover:text-red-600 transition-colors line-clamp-2">
                                {{ $book->title }}
                            </h3>
                            <p class="home-card-text text-gray-600 text-sm mb-2">
                                by {{ $book->author }}
                            </p>
                            @if($book->description)
                                <p class="home-card-text text-gray-500 text-sm mb-4 line-clamp-3">
                                    {{ Str::limit($book->description, 100) }}
                                </p>
                            @endif
                            <span
                                class="home-card-link mt-auto flex items-center gap-1 text-red-600 font-medium text-sm transition-gap">
                                View Details
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </span>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        <p class="text-gray-500 text-lg mt-4">No books found.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-12">
                {{ $books->appends(request()->query())->links() }}
            </div>
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