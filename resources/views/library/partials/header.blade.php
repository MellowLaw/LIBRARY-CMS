<!-- ***** Header Area Start ***** -->
<header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="{{ route('library.index') }}" class="logo">
                        <img src="{{ asset('images/logo.png') }}" alt="Library Logo">
                    </a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                        <li><a href="{{ route('library.index') }}" class="{{ request()->routeIs('library.index') ? 'active' : '' }}">Home</a></li>
                        <li><a href="{{ route('library.explore') }}" class="{{ request()->routeIs('library.explore') ? 'active' : '' }}">Explore</a></li>
                        @if(isset($book))
    <li><a href="{{ route('library.details', ['id' => $book->id]) }}" class="{{ request()->routeIs('library.details') ? 'active' : '' }}">Item Details</a></li>
    <li><a href="{{ route('library.author', ['id' => $book->author_id]) }}" class="{{ request()->routeIs('library.author') ? 'active' : '' }}">Author</a></li>
@else
    <li><a href="{{ route('library.explore') }}">Browse Books</a></li>
@endif
                        <li><a href="{{ route('library.create') }}" class="{{ request()->routeIs('library.create') ? 'active' : '' }}">Create Yours</a></li>
                    </ul>   
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                    <!-- ***** Menu End ***** -->
                </nav>
            </div>
        </div>
    </div>
</header>
<!-- ***** Header Area End ***** -->
