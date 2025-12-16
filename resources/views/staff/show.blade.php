@extends('layouts.admin')

@section('page-title', $staff->name)
@section('page-subtitle', $staff->position)

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="mb-6">
            <a href="{{ route('staff.index') }}"
                class="inline-flex items-center text-sm text-gray-500 hover:text-gray-700 font-medium transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
                Back to Staff List
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <!-- Header Background -->
            <div class="px-8 py-8">
                <!-- Status Badges in top right -->
                <div class="absolute top-4 right-4 z-10">
                    @if($staff->is_published)
                        <span
                            class="inline-flex items-center gap-1.5 px-3 py-1 bg-emerald-50 text-emerald-700 text-xs font-semibold rounded-full border border-emerald-100">
                            <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                            Published
                        </span>
                    @else
                        <span
                            class="inline-flex items-center gap-1.5 px-3 py-1 bg-gray-100 text-gray-700 text-xs font-semibold rounded-full border border-gray-200">
                            <span class="w-1.5 h-1.5 bg-gray-500 rounded-full"></span>
                            Hidden
                        </span>
                    @endif
                </div>

                <div class="flex flex-col items-center mb-6">
                    <!-- Avatar -->
                    <div class="relative mb-4">
                        @if($staff->profile_image)
                            <img src="{{ asset('storage/' . $staff->profile_image) }}" alt="{{ $staff->name }}"
                                class="w-40 h-40 rounded-full border-4 border-gray-100 object-cover shadow-lg bg-white">
                        @else
                            <div
                                class="w-40 h-40 rounded-full border-4 border-gray-100 shadow-lg bg-gradient-to-br from-purple-500 to-pink-500 flex items-center justify-center text-white text-5xl font-bold">
                                {{ substr($staff->name, 0, 1) }}
                            </div>
                        @endif
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-3 mb-6">
                        <a href="{{ route('staff.edit', $staff) }}"
                            class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 shadow-sm transition-all focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                </path>
                            </svg>
                            Edit Profile
                        </a>
                        <form method="POST" action="{{ route('staff.destroy', $staff) }}"
                            onsubmit="return confirm('Are you sure you want to delete this staff member? This action cannot be undone.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-lg text-sm font-medium text-white hover:bg-red-700 shadow-sm transition-all focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                    </path>
                                </svg>
                                Delete
                            </button>
                        </form>
                    </div>

                    <!-- Basic Info -->
                    <div class="text-center w-full">
                        <h1 class="text-3xl font-bold text-gray-900">{{ $staff->name }}</h1>
                        <p class="text-xl text-emerald-600 font-medium mt-1">{{ $staff->position }}</p>
                    </div>
                </div>

                    <!-- Contact Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-gray-50 p-6 rounded-xl border border-gray-100">
                        @if($staff->email)
                            <div class="flex items-start gap-3">
                                <div class="p-2 bg-blue-100 rounded-lg text-blue-600 mt-1">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Email Address</p>
                                    <a href="mailto:{{ $staff->email }}"
                                        class="text-gray-900 font-medium hover:text-blue-600 transition-colors">{{ $staff->email }}</a>
                                </div>
                            </div>
                        @endif

                        @if($staff->phone)
                            <div class="flex items-start gap-3">
                                <div class="p-2 bg-purple-100 rounded-lg text-purple-600 mt-1">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Phone Number</p>
                                    <p class="text-gray-900 font-medium">{{ $staff->phone }}</p>
                                </div>
                            </div>
                        @else
                            <div class="flex items-start gap-3">
                                <div class="p-2 bg-gray-100 rounded-lg text-gray-400 mt-1">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Phone Number</p>
                                    <p class="text-gray-400 italic">Not provided</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Biography -->
                    @if($staff->bio)
                        <div class="bg-white">
                            <h3 class="text-lg font-bold text-gray-900 mb-3 flex items-center gap-2">
                                <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Biography
                            </h3>
                            <div
                                class="prose prose-sm max-w-none text-gray-600 leading-relaxed bg-gray-50 p-6 rounded-xl border border-gray-100">
                                {!! nl2br(e($staff->bio)) !!}
                            </div>
                        </div>
                    @endif

                    @if($staff->display_order)
                        <div class="mt-4 text-xs text-gray-500">
                            Display Order: {{ $staff->display_order }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection