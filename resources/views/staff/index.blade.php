@extends('layouts.admin')

@section('page-title', 'Staff Members')
@section('page-subtitle', 'Manage library staff profiles')

@section('content')

    <div class="mb-8 flex items-center justify-between">
        <div>
            <span
                class="inline-flex items-center gap-1.5 px-3 py-1 bg-gray-900 text-white text-xs font-semibold uppercase tracking-wider rounded-full mb-2">
                <span class="w-1.5 h-1.5 bg-green-400 rounded-full"></span>
                Admin Panel
            </span>
            <h2 class="text-4xl font-bold text-gray-900">Staff Members</h2>
        </div>
        <form method="POST" action="{{ route('logout') }}" onsubmit="event.preventDefault(); openLogoutModal(this);">
            @csrf
            <button type="submit"
                class="sign_out_btn text-sm text-red-600 hover:text-red-700 font-medium transition-smooth bg-red-50 hover:bg-red-100 px-4 py-2 rounded-lg">
                Sign Out
            </button>
        </form>
    </div>

    <div class="flex flex-wrap justify-center gap-6">
        <!-- Add New Staff -->
        <a href="{{ route('staff.create') }}" class="group w-full sm:w-72">
            <div
                class="h-full bg-gradient-to-br from-emerald-50 to-emerald-100 border-2 border-dashed border-emerald-300 rounded-xl p-4 flex flex-col items-center justify-center hover:shadow-md transition-smooth cursor-pointer min-h-[350px]">
                <div
                    class="w-16 h-16 bg-emerald-200 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                </div>
                <p class="mt-4 font-semibold text-emerald-900 text-lg">Add Staff</p>
                <p class="text-sm text-emerald-700 mt-1">New profile member</p>
            </div>
        </a>

        <!-- Staff Cards -->
        @forelse($staff as $member)
            <div class="group w-full sm:w-72">
                <div
                    class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-smooth h-full flex flex-col min-h-[350px]">
                    <!-- Content -->
                    <div class="p-6 flex flex-col items-center text-center flex-1">
                        <div class="relative mb-4">
                            @if($member->profile_image)
                                <img src="{{ asset('storage/' . $member->profile_image) }}" alt="{{ $member->name }}"
                                    class="w-24 h-24 rounded-full border-4 border-gray-50 object-cover shadow-sm bg-white">
                            @else
                                <div
                                    class="w-24 h-24 bg-gradient-to-br from-purple-400 to-pink-600 rounded-full flex items-center justify-center text-white text-3xl font-bold border-4 border-gray-50 shadow-sm">
                                    {{ substr($member->name, 0, 1) }}
                                </div>
                            @endif
                            <div class="absolute bottom-0 right-0 bg-white rounded-full p-1 shadow-sm border border-gray-100">
                                @if($member->is_published)
                                    <span class="block w-3 h-3 bg-green-500 rounded-full" title="Published"></span>
                                @else
                                    <span class="block w-3 h-3 bg-gray-400 rounded-full" title="Hidden"></span>
                                @endif
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="w-full flex-1 flex flex-col">
                            <h3 class="font-bold text-gray-900 text-lg">{{ $member->name }}</h3>
                            <p class="text-sm text-emerald-600 font-medium whitespace-nowrap overflow-hidden text-ellipsis">
                                {{ $member->position }}</p>

                            @if($member->email)
                                <div class="mt-3 flex items-center justify-center gap-2 text-xs text-gray-500">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    <span class="truncate max-w-[150px]">{{ $member->email }}</span>
                                </div>
                            @endif

                            @if($member->bio)
                                <p class="mt-3 text-xs text-gray-400 line-clamp-2">{{ $member->bio }}</p>
                            @else
                                <p class="mt-3 text-xs text-gray-300 italic">No biography provided.</p>
                            @endif
                        </div>

                        <!-- Actions -->
                        <div class="mt-6 flex items-center gap-2 w-full">
                            <a href="{{ route('staff.show', $member) }}"
                                class="flex-1 px-3 py-2 bg-emerald-50 text-emerald-700 rounded-lg text-xs font-semibold hover:bg-emerald-100 transition-smooth text-center">
                                View
                            </a>
                            <a href="{{ route('staff.edit', $member) }}"
                                class="flex-1 px-3 py-2 bg-blue-50 text-blue-700 rounded-lg text-xs font-semibold hover:bg-blue-100 transition-smooth text-center">
                                Edit
                            </a>
                            <form method="POST" action="{{ route('staff.destroy', $member) }}" class="flex-1"
                                onsubmit="return confirm('Delete this staff member?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="w-full px-3 py-2 bg-red-50 text-red-700 rounded-lg text-xs font-semibold hover:bg-red-100 transition-smooth">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="w-full col-span-full">
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