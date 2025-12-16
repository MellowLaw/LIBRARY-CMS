@extends('layouts.public')

@section('title', 'Our Staff')

@section('content')
    <div class="bg-[#efeae4] py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h4 class="title_card fade-in-up">
                Meet our <span class="italic" style="color: #ec3412;">Team.</span>
            </h4>
                <div class="w-20 h-1 bg-indigo-600 mx-auto rounded-full mt-4"></div>
                <p class="mt-4 text-xl text-slate-500">Dedicated professionals serving our community.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse($staffMembers as $staff)
                    <div class="home-card text-center items-center">
                        <div class="w-24 h-24 mb-6 relative mx-auto">
                            @if($staff->profile_image)
                                <img src="{{ asset('storage/' . $staff->profile_image) }}" class="w-full h-full object-cover rounded-full shadow-md" alt="{{ $staff->name }}">
                            @else
                                <div class="w-full h-full bg-primary-bg text-primary-accent flex items-center justify-center rounded-full text-2xl font-bold border border-primary-accent/20">
                                    {{ substr($staff->name, 0, 1) }}
                                </div>
                            @endif
                        </div>
                        <h3 class="font-bold text-lg text-primary-text mb-1">{{ $staff->name }}</h3>
                        <p class="text-primary-accent text-sm font-medium mb-3">{{ $staff->position }}</p>
                        @if($staff->bio)
                            <p class="text-sm text-gray-500 mb-4 line-clamp-2">{{ $staff->bio }}</p>
                        @endif
                         @if($staff->email)
                            <a href="mailto:{{ $staff->email }}" class="text-gray-400 hover:text-primary-accent transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </a>
                        @endif
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <p class="text-gray-500 text-lg">No staff profiles found.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection