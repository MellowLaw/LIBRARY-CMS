@extends('layouts.library')

@section('title', 'Book Details')

@section('content')
<!-- ***** Details Area Start ***** -->
<div class="item-details-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading">
                    <div class="line-dec"></div>
                    <h2>View Book <em>Details</em></h2>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="left-image">
                    <img src="{{ asset('images/book1.webp') }}" alt="Book Cover" style="border-radius: 20px;">
                </div>
            </div>
            <div class="col-lg-5">
                <div class="right-content">
                    <h4>Book Title Here</h4>
                    <span class="author">
                        <img src="{{ asset('images/author.jpg') }}" alt="" style="max-width: 50px; border-radius: 50%;">
                        <h6>Author Name<br><a href="{{ route('library.author') }}">@authorname</a></h6>
                    </span>
                    <p>Book description goes here. This is a detailed description of the book, its content, and why readers might be interested in it.</p>
                    <div class="row">
                        <div class="col-4">
                            <span class="bid">
                                Available<br><strong>10</strong><br>
                            </span>
                        </div>
                        <div class="col-4">
                            <span class="owner">
                                Total<br><strong>20</strong><br>
                            </span>
                        </div>
                        <div class="col-4">
                            <span class="ends">
                                Category<br><strong>Fiction</strong><br>
                            </span>
                        </div>
                    </div>
                    <div class="text-button">
                        <a href="#">Borrow This Book</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ***** Details Area End ***** -->

<div class="other-books">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading">
                    <h2>Other <em>Books</em> You May Like</h2>
                </div>
            </div>
            <!-- Similar books carousel would go here -->
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .item-details-page {
        padding: 80px 0;
    }
    .other-books {
        padding-bottom: 80px;
    }
</style>
@endpush
