@extends('layouts.public')

@section('title', 'Our Staff')

@section('content')
    <div class="bg-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h1 class="text-4xl font-extrabold text-gray-900 sm:text-5xl">Meet Our Team</h1>
                <p class="mt-4 text-xl text-gray-600">Dedicated professionals serving our community.</p>
            </div>

            <div class="grid grid-cols-1 gap-12 sm:grid-cols-2 lg:grid-cols-3">
                @forelse($staffMembers as $staff)
                    <div class="group relative">
                        <div class="aspect-w-3 aspect-h-4 rounded-2xl overflow-hidden bg-gray-100">
                            @if($staff->profile_image)
                                <img class="object-cover shadow-lg rounded-2xl group-hover:opacity-75 transition-opacity duration-300"
                                    src="{{ Storage::url($staff->profile_image) }}" alt="{{ $staff->name }}">
                            @else
                                <div class="flex items-center justify-center h-full bg-emerald-100 rounded-2xl">
                                    <svg class="h-24 w-24 text-emerald-400" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="mt-4 text-center">
                            <h3 class="text-lg font-bold text-gray-900">{{ $staff->name }}</h3>
                            <p class="text-emerald-600 font-medium">{{ $staff->position }}</p>
                            @if($staff->email)
                                <a href="mailto:{{ $staff->email }}"
                                    class="inline-block mt-2 text-sm text-gray-500 hover:text-emerald-600 transition-colors">
                                    {{ $staff->email }}
                                </a>
                            @endif
                            @if($staff->bio)
                                <p class="mt-2 text-sm text-gray-500 line-clamp-3">{{ $staff->bio }}</p>
                            @endif
                        </div>
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