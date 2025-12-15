@extends('layouts.library')

@section('title', 'Library Home')

@section('content')
<!-- ***** Main Banner Area Start ***** -->
<div class="main-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 align-self-center">
                <div class="header-text">
                    <h6>Book is Knowledge</h6>
                    <h2>Knowledge is Power</h2>
                    <p>Library is a really cool and professional design for your websites. This HTML CSS template is based on Bootstrap v5 and it is designed for related web portals. Liberty can be freely downloaded from github</p>
                    <div class="buttons">
                        <div class="border-button">
                            <a href="{{ route('library.explore') }}">Explore Top Books</a>
                        </div>
                        <div class="main-button">
                            <a href="#" target="_blank">Watch Our Videos</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 offset-lg-1">
                <div class="">
                    <div class="item">
                        <img src="{{ asset('images/banner.png') }}" alt="Library Banner">
                    </div>
                    <div class="item">
                        <img src="{{ asset('images/banner2.png') }}" alt="Library Banner 2">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ***** Main Banner Area End ***** -->

<div class="categories-collections">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="categories">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="section-heading">
                                <div class="line-dec"></div>
                                <h2>Browse Through Book <em>Categories</em> Here.</h2>
                            </div>
                        </div>
                        @forelse($categories as $category)
                        <div class="col-lg-2 col-sm-6">
                            <div class="item">
                                <div class="icon">
                                    <img src="{{ $category->icon ? asset('storage/' . $category->icon) : asset('images/icon-0' . $loop->iteration . '.png') }}" alt="{{ $category->name }}">
                                </div>
                                <h4>{{ $category->name }}</h4>
                                <span class="badge bg-primary">{{ $category->books_count }} books</span>
                            </div>
                        </div>
                        @empty
                        <div class="col-12 text-center">
                            <p>No categories available. Please add some categories.</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="currently-market">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="section-heading">
                    <div class="line-dec"></div>
                    <h2><em>Items</em> Currently In The Market.</h2>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="filters">
                    <ul>
                        <li data-filter="*" class="active">All Books</li>
                        <li data-filter=".msc">Popular</li>
                        <li data-filter=".dig">Latest</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="row grid">
                    @forelse($featuredBooks as $book)
                    <div class="col-lg-6 currently-market-item all msc">
                        <div class="item">
                            <div class="left-image">
                                <img src="{{ $book->cover_image_url }}" alt="{{ $book->title }}" style="border-radius: 20px; min-width: 195px; max-height: 300px; object-fit: cover;">
                            </div>
                            <div class="right-content">
                                <h4>{{ Str::limit($book->title, 20) }}</h4>
                                <span class="author">
                                    @if($book->author->photo)
                                        <img src="{{ asset('storage/' . $book->author->photo) }}" alt="{{ $book->author->name }}" style="max-width: 50px; border-radius: 50%;">
                                    @else
                                        <img src="{{ asset('images/author.jpg') }}" alt="{{ $book->author->name }}" style="max-width: 50px; border-radius: 50%;">
                                    @endif
                                    <h6>{{ $book->author->name }}</h6>
                                </span>
                                <div class="line-dec"></div>
                                <span class="bid">
                                    Available<br><strong>{{ $book->quantity }}</strong><br> 
                                </span>
                                <div class="text-button">
                                    <a href="{{ route('library.details', $book->id) }}">View Item Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-center">
                        <p>No featured books available. Check back later!</p>
                    </div>
                    @endforelse

                    {{-- Additional books will be loaded dynamically via the $featuredBooks collection --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Initialize any necessary JavaScript here
        // The main JavaScript functionality is already included in the layout file
    });
</script>
@endpush
