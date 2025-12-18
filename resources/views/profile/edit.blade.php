@extends('layouts.app')

@section('title', 'Account Settings - AddLib')

@section('content')
    <div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Account Settings</h1>
            <p class="mt-2 text-gray-600">Update your profile information and security settings.</p>
        </div>

        @if (session('success'))
            <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-400 text-green-700 animate-fade-in">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white shadow-sm border border-slate-200 rounded-2xl overflow-hidden">
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-8">
                @csrf
                @method('PUT')

                <!-- Profile Information -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-6 border-b border-gray-100 pb-2">Profile Information
                    </h3>

                    <div class="mb-8 flex items-center gap-6">
                        <div class="relative group">
                            <div class="w-24 h-24 rounded-full overflow-hidden bg-gray-100 border-2 border-gray-200">
                                @if ($user->profile_picture)
                                    <img id="profile-preview" src="{{ asset('storage/' . $user->profile_picture) }}"
                                        alt="Profile" class="w-full h-full object-cover">
                                @else
                                    <div id="profile-placeholder"
                                        class="w-full h-full flex items-center justify-center text-gray-400 font-bold text-2xl bg-gray-50">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                    <img id="profile-preview" src="#" alt="Profile" class="hidden w-full h-full object-cover">
                                @endif
                            </div>
                            <label for="profile_picture"
                                class="absolute bottom-0 right-0 p-1.5 bg-white rounded-full shadow-lg border border-gray-100 cursor-pointer hover:bg-gray-50 transition-smooth">
                                <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </label>
                            <input type="file" name="profile_picture" id="profile_picture" class="hidden"
                                onchange="previewImage(this)">
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-900">Profile Picture</h4>
                            <p class="text-sm text-gray-500">JPG, GIF or PNG. Max size 2MB.</p>
                            @error('profile_picture')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-1">
                            <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                            <input type="text" name="first_name" id="first_name"
                                value="{{ old('first_name', $user->first_name) }}"
                                class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-accent/20 focus:border-primary-accent transition-smooth"
                                required>
                            @error('first_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="space-y-1">
                            <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                            <input type="text" name="last_name" id="last_name"
                                value="{{ old('last_name', $user->last_name) }}"
                                class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-accent/20 focus:border-primary-accent transition-smooth"
                                required>
                            @error('last_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="space-y-1 md:col-span-2">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                                class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-accent/20 focus:border-primary-accent transition-smooth"
                                required>
                            @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <!-- Password Update -->
                <div class="pt-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-6 border-b border-gray-100 pb-2">Security</h3>
                    <div class="space-y-6">
                        <div class="space-y-1">
                            <label for="current_password" class="block text-sm font-medium text-gray-700">Current Password
                                (optional)</label>
                            <input type="password" name="current_password" id="current_password"
                                class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-accent/20 focus:border-primary-accent transition-smooth">
                            <p class="text-xs text-gray-500 mt-1">Required only if changing password.</p>
                            @error('current_password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-1">
                                <label for="new_password" class="block text-sm font-medium text-gray-700">New
                                    Password</label>
                                <input type="password" name="new_password" id="new_password"
                                    class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-accent/20 focus:border-primary-accent transition-smooth">
                                @error('new_password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div class="space-y-1">
                                <label for="new_password_confirmation"
                                    class="block text-sm font-medium text-gray-700">Confirm New Password</label>
                                <input type="password" name="new_password_confirmation" id="new_password_confirmation"
                                    class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-accent/20 focus:border-primary-accent transition-smooth">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pt-8 flex justify-between items-center border-t border-gray-100">
                    <a href="{{ route('dashboard') }}"
                        class="text-sm font-medium text-gray-500 hover:text-gray-700 transition-colors">← Back to
                        Dashboard</a>
                    <button type="submit"
                        class="px-8 py-3 bg-emerald-600 text-white font-semibold rounded-xl hover:bg-emerald-700 transition-smooth shadow-lg shadow-emerald-200">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
    @push('scripts')
        <script>
            function previewImage(input) {
                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        const preview = document.getElementById('profile-preview');
                        const placeholder = document.getElementById('profile-placeholder');

                        preview.src = e.target.result;
                        preview.classList.remove('hidden');

                        if (placeholder) {
                            placeholder.classList.add('hidden');
                        }
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>
    @endpush
@endsection