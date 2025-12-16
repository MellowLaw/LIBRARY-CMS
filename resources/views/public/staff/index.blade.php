@extends('layouts.public')

@section('title', 'Our Staff')

@section('content')
    <div class="bg-[#F8F9FA] py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h1 class="text-4xl font-bold text-slate-900">Meet Our Team</h1>
                <div class="w-20 h-1 bg-indigo-600 mx-auto rounded-full mt-4"></div>
                <p class="mt-4 text-xl text-slate-500">Dedicated professionals serving our community.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-12">
                @forelse($staffMembers as $staff)
                    <div class="group relative bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover-lift text-center">
                        <div class="w-32 h-32 mx-auto mb-6 relative">
                            @if($staff->profile_image)
                                <img class="w-full h-full object-cover rounded-full shadow-lg group-hover:scale-110 transition-transform duration-300"
                                    src="{{ asset('storage/' . $staff->profile_image) }}" alt="{{ $staff->name }}">
                            @else
                                <div class="w-full h-full bg-indigo-100 text-indigo-600 flex items-center justify-center rounded-full text-3xl font-bold group-hover:bg-indigo-600 group-hover:text-white transition-colors duration-300">
                                    {{ substr($staff->name, 0, 1) }}
                                </div>
                            @endif
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-1">{{ $staff->name }}</h3>
                        <p class="text-indigo-600 font-medium text-sm mb-4">{{ $staff->position }}</p>
                        @if($staff->email)
                            <a href="mailto:{{ $staff->email }}"
                                class="inline-flex items-center gap-1 text-sm text-slate-500 hover:text-indigo-600 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                {{ $staff->email }}
                            </a>
                        @endif
                        @if($staff->bio)
                            <p class="mt-3 text-sm text-slate-500 line-clamp-3">{{ $staff->bio }}</p>
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