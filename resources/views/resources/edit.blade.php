@extends('layouts.admin')

@section('page-title', 'Edit Resource Link')
@section('page-subtitle', 'Update resource information')

@section('content')
    <div class="max-w-2xl">
        <form method="POST" action="{{ route('resources.update', $resource) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Title <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="title" value="{{ old('title', $resource->title) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500"
                        required>
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">URL <span
                            class="text-red-500">*</span></label>
                    <input type="url" name="url" value="{{ old('url', $resource->url) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500"
                        required>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Description</label>
                    <textarea name="description" rows="3"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">{{ old('description', $resource->description) }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Category</label>
                    <input type="text" name="category" value="{{ old('category', $resource->category) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Display Order</label>
                    <input type="number" name="display_order" value="{{ old('display_order', $resource->display_order) }}"
                        min="0"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">
                </div>

                <div class="space-y-2">
                    <div class="flex items-center gap-2">
                        <input type="checkbox" name="is_external" id="is_external" value="1" {{ $resource->is_external ? 'checked' : '' }} class="w-4 h-4 rounded border-gray-300">
                        <label for="is_external" class="text-sm text-gray-700">External link (opens in new tab)</label>
                    </div>
                    <div class="flex items-center gap-2">
                        <input type="checkbox" name="is_active" id="is_active" value="1" {{ $resource->is_active ? 'checked' : '' }} class="w-4 h-4 rounded border-gray-300">
                        <label for="is_active" class="text-sm text-gray-700">Active</label>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <button type="submit"
                    class="px-6 py-2.5 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition-smooth font-medium">
                    Update Resource
                </button>
                <a href="{{ route('resources.index') }}"
                    class="px-6 py-2.5 border border-gray-300 rounded-lg hover:bg-gray-50 transition-smooth font-medium text-gray-700">
                    Cancel
                </a>
            </div>
        </form>
    </div>
@endsection