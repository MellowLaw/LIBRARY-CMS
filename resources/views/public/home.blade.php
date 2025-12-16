@extends('layouts.public')

@section('title', 'Welcome')

@section('content')
    <!-- Hero Section -->
    <header class="home-hero-section">
        <div class="home-hero-content">
            <h1 class="home-hero-title fade-in-up">
                Discover, Learn, <br class="hidden md:block" /> and Grow <span class="italic" style="color: #ec3412;">Together.</span>
            </h1>
            <p class="home-hero-subtitle fade-in-up delay-100">
                Access a world of knowledge, community events, and digital resources through our modern library portal.
            </p>
            <div class="flex flex-wrap justify-center gap-4 fade-in-up delay-200">
                <a href="#news" class="home-btn home-btn-primary">
                    Latest News
                </a>
                <a href="#staff" class="home-btn home-btn-secondary">
                    Meet Our Team
                </a>
            </div>
        </div>
        
        <!-- Decorative subtle elements -->
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden -z-10 pointer-events-none">
            <div class="absolute top-[-10%] right-[-5%] w-[500px] h-[500px] bg-primary-accent/5 rounded-full blur-[100px]"></div>
            <div class="absolute bottom-[-10%] left-[-5%] w-[500px] h-[500px] bg-primary-accent/5 rounded-full blur-[100px]"></div>
        </div>
    </header>

    <!-- News & Updates Section -->
    <section id="News" class="home-news-section">
        <div class="home-news-content">
            <h4 class="title_card fade-in-up text-center">
                Latest <span class="italic" style="color: #ec3412;">Updates.</span>
            </h4>

            <p class="home-section-subtitle text-center">Stay informed with the latest announcements.</p>

            @if($news->isEmpty())
                <div class="text-center py-12 text-gray-500">
                    <p class="text-lg">No updates published yet. Check back soon!</p>
                </div>
            @endif

            <div class="flex flex-wrap justify-center gap-8">
                @foreach($news as $article)
                    <a href="{{ route('public.news.show', $article->slug) }}" class="home-card group w-full sm:w-96 flex flex-col h-full hover:-translate-y-1 hover:shadow-xl transition-all duration-300">
                        @if($article->image_path)
                            <img src="{{ '/storage/' . $article->image_path }}" alt="{{ $article->title }}" class="home-card-image w-full h-48 object-cover rounded-xl mb-4">
                        @endif
                        <div class="flex flex-col flex-1">
                            <span class="home-card-tag inline-block px-3 py-1 bg-red-50 text-red-600 rounded-full text-xs font-bold uppercase tracking-wider mb-2 self-start">News</span>
                            <h3 class="home-card-title text-xl font-bold text-gray-900 mb-2 leading-tight group-hover:text-red-600 transition-colors">{{ $article->title }}</h3>
                            <p class="home-card-text text-gray-500 text-sm mb-4 line-clamp-3">
                                {{ Str::limit($article->excerpt ?: strip_tags($article->content), 100) }}
                            </p>
                            <span class="home-card-link mt-auto flex items-center gap-1 text-red-600 font-medium text-sm transition-gap">
                                Read More <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>

            @if($news->isNotEmpty())
                <div class="text-center mt-12">
                    <a href="{{ route('public.news.index') }}" class="home-btn home-btn-secondary">View All Announcements</a>
                </div>
            @endif
        </div>
    </section>

    <!-- Staff Section -->
    <section id="staff" class="home-staff-section">
        <div class="home-staff-content">
            <h4 class="title_card fade-in-up text-center">
                Meet our <span class="italic" style="color: #ec3412;">Team.</span>
            </h4>

            <p class="home-section-subtitle text-center">Dedicated professionals committed to serving our community.</p>

            @if($staff->isEmpty())
                <div class="text-center py-12 border-2 border-dashed border-slate-200 rounded-xl">
                    <p class="text-slate-400 font-medium">Our team list is being updated.</p>
                </div>
            @endif

            <div class="flex flex-wrap justify-center gap-6">
                @foreach($staff as $member)
                    <div class="home-card text-center items-center w-full sm:w-72">
                         <div class="w-24 h-24 mb-6 relative mx-auto">
                            @if($member->profile_image)
                                <img src="{{ asset('storage/' . $member->profile_image) }}" class="w-full h-full object-cover rounded-full shadow-md" alt="{{ $member->name }}">
                            @else
                                <div class="w-full h-full bg-primary-bg text-primary-accent flex items-center justify-center rounded-full text-2xl font-bold border border-primary-accent/20">
                                    {{ substr($member->name, 0, 1) }}
                                </div>
                            @endif
                        </div>
                        <h3 class="font-bold text-lg text-primary-text mb-1">{{ $member->name }}</h3>
                        <p class="text-primary-accent text-sm font-medium mb-3">{{ $member->position }}</p>
                        @if($member->bio)
                            <p class="text-sm text-gray-500 mb-4 line-clamp-2">{{ $member->bio }}</p>
                        @endif
                         @if($member->email)
                            <a href="mailto:{{ $member->email }}" class="text-gray-400 hover:text-primary-accent transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </a>
                        @endif
                    </div>
                @endforeach
            </div>
             @if($staff->isNotEmpty())
               <div class="text-center mt-12">
                   <a href="{{ route('public.staff.index') }}" class="home-btn home-btn-secondary">View Full Team</a>
                </div>
            @endif
        </div>
    </section>

    <!-- Resources / Footer CTA -->
    <section class="home-resources-section">
        <div class="home-resources-content">
            <h4 class="title_card fade-in-up">
                Explore Digital <span class="italic" style="color: #ec3412;">Resources.</span>
            </h4>
            <p class="home-section-subtitle text-slate-300">Curated collection of online tools and learning materials.</p>

            <div class="flex flex-wrap justify-center gap-4">
                @foreach($resources as $resource)
                    <a href="{{ $resource->url }}" target="_blank" class="home-btn home-btn-secondary bg-white/10 border-white/20 text-white hover:bg-white/20 hover:border-white/40">
                        {{ $resource->title }}
                    </a>
                @endforeach
                 @if($resources->isEmpty())
                    <span class="text-slate-400 italic">Resources updating soon...</span>
                @endif
            </div>
        </div>
    </section>
@endsection