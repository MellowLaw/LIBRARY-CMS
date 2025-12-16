@extends('layouts.admin')

@section('page-title', 'Edit Staff Member')
@section('page-subtitle', 'Update staff profile')

@section('content')
    <div class="max-w-2xl">
        <form method="POST" action="{{ route('staff.update', $staff) }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 space-y-4">
                @if($staff->profile_image)
                    <div class="mb-4">
                        <img src="{{ asset('storage/' . $staff->profile_image) }}" alt="{{ $staff->name }}"
                            class="w-24 h-24 rounded-full object-cover">
                    </div>
                @endif

                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Name <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $staff->name) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500"
                        required>
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Position <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="position" value="{{ old('position', $staff->position) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500"
                        required>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email', $staff->email) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Phone</label>
                    <input type="text" name="phone" value="{{ old('phone', $staff->phone) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Bio</label>
                    <textarea name="bio" rows="4"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">{{ old('bio', $staff->bio) }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Profile Image</label>
                    <input type="file" name="profile_image" accept="image/*"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">
                    <p class="mt-1 text-xs text-gray-500">Leave empty to keep current image</p>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Display Order</label>
                    <input type="number" name="display_order" value="{{ old('display_order', $staff->display_order) }}"
                        min="0"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">
                </div>

                <div class="flex items-center gap-2">
                    <input type="checkbox" name="is_published" id="is_published" value="1" {{ $staff->is_published ? 'checked' : '' }} class="w-4 h-4 rounded border-gray-300">
                    <label for="is_published" class="text-sm text-gray-700">Published</label>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <button type="submit"
                    class="px-6 py-2.5 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition-smooth font-medium">
                    Update Staff Member
                </button>
                <a href="{{ route('staff.index') }}"
                    class="px-6 py-2.5 border border-gray-300 rounded-lg hover:bg-gray-50 transition-smooth font-medium text-gray-700">
                    Cancel
                </a>
            </div>
        </form>
    </div>
@endsection