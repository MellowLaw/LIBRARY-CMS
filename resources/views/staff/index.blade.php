@extends('layouts.admin')

@section('page-title', 'Staff Members')
@section('page-subtitle', 'Manage library staff profiles')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Add New Staff -->
        <a href="{{ route('staff.create') }}" class="group">
            <div
                class="h-full bg-gradient-to-br from-emerald-50 to-emerald-100 border-2 border-dashed border-emerald-300 rounded-xl p-6 flex flex-col items-center justify-center hover:shadow-md transition-smooth cursor-pointer">
                <div
                    class="w-12 h-12 bg-emerald-200 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                </div>
                <p class="mt-3 font-semibold text-emerald-900">Add Staff Member</p>
                <p class="text-xs text-emerald-700 mt-1">Create a new staff profile</p>
            </div>
        </a>

        <!-- Staff Cards -->
        @forelse($staff as $member)
            <div class="group">
                <div
                    class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-smooth">
                    <!-- Header with Avatar -->
                    <!-- Content -->
                    <div class="px-6 py-6 pt-8 flex flex-col items-center text-center">
                        <div class="relative mb-4">
                            @if($member->profile_image)
                                <img src="{{ asset('storage/' . $member->profile_image) }}" alt="{{ $member->name }}"
                                    class="w-20 h-20 rounded-full border-4 border-gray-100 object-cover shadow-sm bg-white">
                            @else
                                <div
                                    class="w-20 h-20 bg-gradient-to-br from-purple-400 to-pink-600 rounded-full flex items-center justify-center text-white text-2xl font-bold border-4 border-gray-100 shadow-sm">
                                    {{ substr($member->name, 0, 1) }}
                                </div>
                            @endif
                        </div>

                        <!-- Content -->
                        <div class="p-4 pt-12">
                            <h3 class="font-bold text-gray-900">{{ $member->name }}</h3>
                            <p class="text-sm text-emerald-600 font-medium">{{ $member->position }}</p>

                            @if($member->email)
                                <div class="mt-3 flex items-center gap-2 text-xs text-gray-600">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    {{ $member->email }}
                                </div>
                            @endif

                            @if($member->phone)
                                <div class="flex items-center gap-2 text-xs text-gray-600">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                        </path>
                                    </svg>
                                    {{ $member->phone }}
                                </div>
                            @endif

                            @if($member->bio)
                                <p class="mt-3 text-xs text-gray-600 line-clamp-2">{{ $member->bio }}</p>
                            @endif

                            <!-- Actions -->
                            <div class="mt-4 flex items-center gap-2">
                                <a href="{{ route('staff.edit', $member) }}"
                                    class="flex-1 px-3 py-2 bg-blue-50 text-blue-700 rounded-lg text-xs font-medium hover:bg-blue-100 transition-smooth text-center">
                                    Edit
                                </a>
                                <form method="POST" action="{{ route('staff.destroy', $member) }}" class="flex-1"
                                    onsubmit="return confirm('Delete this staff member?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="w-full px-3 py-2 bg-red-50 text-red-700 rounded-lg text-xs font-medium hover:bg-red-100 transition-smooth">
                                        Delete
                                    </button>
                                </form>
                            </div>

                            <!-- Status Badge -->
                            <div class="mt-3 pt-3 border-t border-gray-200">
                                @if($member->is_published)
                                    <span
                                        class="inline-flex items-center gap-1 px-2 py-1 bg-green-100 text-green-700 text-xs font-medium rounded-full">
                                        <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span>
                                        Published
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center gap-1 px-2 py-1 bg-gray-100 text-gray-700 text-xs font-medium rounded-full">
                                        <span class="w-1.5 h-1.5 bg-gray-500 rounded-full"></span>
                                        Hidden
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
        @empty
                <div class="col-span-full">
                    <div class="text-center py-12 bg-white rounded-xl border border-gray-200">
                        <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 8.048M12 4.354L9.172 7.172A4 4 0 0012.828 16.83"></path>
                        </svg>
                        <h3 class="text-lg font-medium text-gray-900">No staff members</h3>
                        <p class="text-gray-500 mt-2">Add your first staff member to get started.</p>
                        <a href="{{ route('staff.create') }}"
                            class="mt-4 inline-flex items-center gap-2 px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition-smooth font-medium">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Add Staff Member
                        </a>
                    </div>
                </div>
            @endforelse
        </div>
@endsection