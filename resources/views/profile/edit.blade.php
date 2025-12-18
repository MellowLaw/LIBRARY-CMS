@extends('layouts.app', ['hideFooter' => true])

@section('title', 'Account Settings - AddLib')

@section('content')
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="mb-10 flex flex-col md:flex-row md:items-center md:justify-between gap-4 animate-fade-in-up">
            <div>
                <nav class="flex mb-2" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="{{ route('dashboard') }}"
                                class="text-gray-500 hover:text-primary-accent transition-colors text-sm font-medium">Dashboard</a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 9 4-4-4-4" />
                                </svg>
                                <span class="text-gray-900 text-sm font-medium ml-1">Settings</span>
                            </div>
                        </li>
                    </ol>
                </nav>
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 font-display">Account Settings</h1>
                <p class="text-gray-600 mt-2">Manage your profile information and security.</p>
            </div>

            @if (session('success'))
                <div
                    class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg flex items-center animate-fade-in shadow-sm">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif
        </div>

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                {{-- Left Column: Profile Picture Card --}}
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 text-center h-full">
                        <h3 class="font-bold text-gray-900 text-lg mb-6 text-left">Profile Image</h3>

                        <div class="relative inline-block group mb-6">
                            <div
                                class="w-40 h-40 rounded-full overflow-hidden border-4 border-gray-50 shadow-md mx-auto relative group-hover:border-primary-accent/20 transition-colors">
                                @if ($user->profile_picture)
                                    <img id="profile-preview" src="{{ asset('storage/' . $user->profile_picture) }}"
                                        alt="Profile" class="w-full h-full object-cover">
                                @else
                                    <div id="profile-placeholder"
                                        class="w-full h-full flex items-center justify-center bg-gray-100 text-gray-400 font-bold text-5xl">
                                        {{ substr($user->first_name, 0, 1) }}
                                    </div>
                                    <img id="profile-preview" src="#" alt="Profile" class="hidden w-full h-full object-cover">
                                @endif

                                {{-- Overlay for hover effect --}}
                                <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer"
                                    onclick="document.getElementById('profile_picture').click()">
                                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                            </div>

                            {{-- Edit Button (Visible) --}}
                            <button type="button" onclick="document.getElementById('profile_picture').click()"
                                class="absolute bottom-2 right-2 bg-white text-gray-700 p-2 rounded-full shadow-lg border border-gray-100 hover:text-primary-accent transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                    </path>
                                </svg>
                            </button>
                        </div>

                        <input type="file" name="profile_picture" id="profile_picture" class="hidden"
                            onchange="previewImage(this)">

                        <div class="text-center">
                            <h2 class="text-xl font-bold text-gray-900">{{ $user->first_name }} {{ $user->last_name }}</h2>
                            <p class="text-gray-500 text-sm mb-4">{{ $user->email }}</p>

                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-primary-bg text-primary-text border border-primary-accent/20 uppercase tracking-widest">
                                {{ $user->role }}
                            </span>

                            <p class="text-xs text-gray-400 mt-6">
                                Upload a new avatar.<br>JPG, GIF or PNG. Max size 2MB.
                            </p>
                            @error('profile_picture')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Right Column: Edit Details --}}
                <div class="lg:col-span-2 space-y-8">

                    {{-- Personal Information --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                        <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-100">
                            <div
                                class="w-10 h-10 rounded-full bg-orange-50 text-primary-accent flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900">Personal Information</h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label for="first_name" class="text-sm font-semibold text-gray-700">First Name</label>
                                <input type="text" name="first_name" id="first_name"
                                    value="{{ old('first_name', $user->first_name) }}"
                                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-accent/20 focus:border-primary-accent focus:bg-white transition-all outline-none"
                                    required>
                                @error('first_name') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                            </div>

                            <div class="space-y-2">
                                <label for="last_name" class="text-sm font-semibold text-gray-700">Last Name</label>
                                <input type="text" name="last_name" id="last_name"
                                    value="{{ old('last_name', $user->last_name) }}"
                                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-accent/20 focus:border-primary-accent focus:bg-white transition-all outline-none"
                                    required>
                                @error('last_name') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                            </div>

                            <div class="space-y-2 md:col-span-2">
                                <label for="email" class="text-sm font-semibold text-gray-700">Email Address</label>
                                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-accent/20 focus:border-primary-accent focus:bg-white transition-all outline-none"
                                    required>
                                @error('email') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Security --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                        <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-100">
                            <div class="w-10 h-10 rounded-full bg-gray-50 text-gray-700 flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                    </path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900">Security</h3>
                        </div>

                        <div class="space-y-6">
                            <div class="space-y-2">
                                <label for="current_password" class="text-sm font-semibold text-gray-700">Current Password
                                    <span class="text-gray-400 font-normal">(Leave blank if unchanged)</span></label>
                                <input type="password" name="current_password" id="current_password"
                                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-accent/20 focus:border-primary-accent focus:bg-white transition-all outline-none">
                                @error('current_password') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label for="new_password" class="text-sm font-semibold text-gray-700">New
                                        Password</label>
                                    <input type="password" name="new_password" id="new_password"
                                        class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-accent/20 focus:border-primary-accent focus:bg-white transition-all outline-none">
                                    @error('new_password') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                                </div>

                                <div class="space-y-2">
                                    <label for="new_password_confirmation"
                                        class="text-sm font-semibold text-gray-700">Confirm New Password</label>
                                    <input type="password" name="new_password_confirmation" id="new_password_confirmation"
                                        class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-accent/20 focus:border-primary-accent focus:bg-white transition-all outline-none">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="flex items-center justify-end gap-4 p-4">
                        <a href="{{ route('dashboard') }}"
                            class="text-gray-500 font-bold hover:text-gray-800 transition-colors">Cancel</a>
                        <button type="submit"
                            class="px-8 py-3 bg-[#1e1e1e] text-[#efeae4] font-bold rounded-full hover:bg-primary-accent hover:text-white hover:shadow-lg border-2 border-transparent transition-all duration-300 transform hover:scale-105">
                            Save Changes
                        </button>
                    </div>

                    {{-- Danger Zone --}}
                    <div class="bg-red-50 rounded-2xl shadow-sm border border-red-100 p-8 mt-12">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 rounded-full bg-red-100 text-red-600 flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                    </path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-red-900">Danger Zone</h3>
                        </div>

                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                            <div>
                                <h4 class="font-bold text-gray-900">Delete Account</h4>
                                <p class="text-gray-600 text-sm mt-1">
                                    Once you delete your account, there is no going back. All of your personal data will be
                                    permanently removed.
                                </p>
                            </div>
                            <button type="button" onclick="openDeleteModal()"
                                class="px-6 py-2 bg-red-600 text-white font-bold rounded-lg hover:bg-red-700 transition-colors shrink-0">
                                Delete Account
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    {{-- Delete Confirmation Modal --}}
    <div id="deleteModal" class="fixed inset-0 z-50 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity backdrop-blur-sm"></div>

        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div
                    class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg border-2 border-red-100">
                    <form action="{{ route('profile.destroy') }}" method="POST" class="p-6">
                        @csrf
                        @method('DELETE')

                        <div class="sm:flex sm:items-start">
                            <div
                                class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                                <h3 class="text-base font-bold leading-6 text-gray-900" id="modal-title">Delete Account</h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">Are you sure you want to delete your account? This
                                        action is permanent and cannot be undone.</p>

                                    <div class="mt-4">
                                        <label for="password_confirmation"
                                            class="block text-sm font-medium text-gray-700 mb-1">Please enter your password
                                            to confirm:</label>
                                        <input type="password" name="password" id="password_confirmation" required
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none"
                                            placeholder="Password">
                                        @error('password', 'userDeletion')
                                            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-8 sm:flex sm:flex-row-reverse gap-3">
                            <button type="submit"
                                class="inline-flex w-full justify-center rounded-lg bg-red-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:w-auto transition-colors">Delete
                                Account</button>
                            <button type="button" onclick="closeDeleteModal()"
                                class="mt-3 inline-flex w-full justify-center rounded-lg bg-white px-4 py-2.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto transition-colors">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function openDeleteModal() {
                const modal = document.getElementById('deleteModal');
                if (modal) {
                    modal.classList.remove('hidden');
                }
            }

            function closeDeleteModal() {
                const modal = document.getElementById('deleteModal');
                if (modal) {
                    modal.classList.add('hidden');
                }
            }

            function previewImage(input) {
                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        const preview = document.getElementById('profile-preview');
                        const placeholder = document.getElementById('profile-placeholder');

                        // Handles both img tag and placeholder div
                        if (preview) {
                            preview.src = e.target.result;
                            preview.classList.remove('hidden');
                        }

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