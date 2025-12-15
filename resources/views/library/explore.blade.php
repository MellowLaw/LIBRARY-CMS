@extends('layouts.library')

@section('title', 'Explore Books')

@section('content')
<!-- ***** Explore Area Start ***** -->
<div class="page-heading">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading">
                    <h2>Explore <em>Books</em> In Our Library</h2>
                    <a href="{{ route('library.index') }}">Back To Home</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="explore-items">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="filters">
                    <ul>
                        <li data-filter="*" class="active">All Books</li>
                        <li data-filter=".msc">Popular</li>
                        <li data-filter=".dig">Latest</li>
                    </ul>
                </div>
            </div>
            
            <!-- Book items will be dynamically loaded here -->
            
        </div>
    </div>
</div>
<!-- ***** Explore Area End ***** -->
@endsection

@push('styles')
<style>
    .explore-items {
        padding: 60px 0;
    }
    .page-heading {
        padding: 120px 0 80px;
        text-align: center;
        background-color: #f8f9fa;
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        // Initialize any necessary JavaScript here
    });
</script>
@endpush
