@extends('layouts.library')

@section('title', 'Author Profile')

@section('content')
<!-- ***** Author Area Start ***** -->
<div class="author-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading">
                    <div class="line-dec"></div>
                    <h2>Author <em>Profile</em></h2>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="author-info">
                    <div class="author-image">
                        <img src="{{ asset('images/author.jpg') }}" alt="Author" style="border-radius: 50%; width: 100%; max-width: 300px;">
                    </div>
                    <h4>Author Name</h4>
                    <span>Famous Author</span>
                    <p>Author bio goes here. This is a short biography of the author, their background, achievements, and notable works.</p>
                    <ul class="social-icons">
                        <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                        <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="author-books">
                    <div class="section-heading">
                        <h4>Books by <em>Author Name</em></h4>
                    </div>
                    <div class="row">
                        <!-- Author's books would be listed here -->
                        <div class="col-lg-4 col-md-6">
                            <div class="book-item">
                                <img src="{{ asset('images/book1.webp') }}" alt="Book Cover" style="border-radius: 10px; margin-bottom: 15px; width: 100%;">
                                <h6>Book Title 1</h6>
                                <a href="{{ route('library.details') }}">View Details</a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="book-item">
                                <img src="{{ asset('images/book2.webp') }}" alt="Book Cover" style="border-radius: 10px; margin-bottom: 15px; width: 100%;">
                                <h6>Book Title 2</h6>
                                <a href="{{ route('library.details') }}">View Details</a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="book-item">
                                <img src="{{ asset('images/book3.webp') }}" alt="Book Cover" style="border-radius: 10px; margin-bottom: 15px; width: 100%;">
                                <h6>Book Title 3</h6>
                                <a href="{{ route('library.details') }}">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ***** Author Area End ***** -->
@endsection

@push('styles')
<style>
    .author-page {
        padding: 80px 0;
    }
    .author-info {
        background: #f8f9fa;
        padding: 30px;
        border-radius: 10px;
        margin-bottom: 30px;
    }
    .author-books {
        padding: 30px 0;
    }
    .book-item {
        text-align: center;
        margin-bottom: 30px;
    }
    .social-icons {
        padding: 0;
        margin-top: 20px;
    }
    .social-icons li {
        display: inline-block;
        margin-right: 10px;
    }
    .social-icons li a {
        color: #666;
        font-size: 20px;
    }
</style>
@endpush
