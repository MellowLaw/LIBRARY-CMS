@extends('layouts.admin')

@section('page-title', 'Create Menu Item')
@section('page-subtitle', 'Add a new menu item')

@section('content')
    <div class="max-w-2xl">
        <form method="POST" action="{{ route('menus.store') }}" class="space-y-6">
            @csrf

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Name (Internal) <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="main-menu"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500"
                        required>
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Label (Display) <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="label" value="{{ old('label') }}" placeholder="Home"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500"
                        required>
                    @error('label')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">URL</label>
                    <input type="text" name="url" value="{{ old('url') }}" placeholder="/home or https://example.com"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">
                    @error('url')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Parent Menu</label>
                    <select name="parent_id"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        <option value="">None (Top Level)</option>
                        @foreach($parentMenus as $parent)
                            <option value="{{ $parent->id }}">{{ $parent->label }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Display Order</label>
                    <input type="number" name="display_order" value="{{ old('display_order', 0) }}" min="0"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">
                </div>

                <div class="flex items-center gap-2">
                    <input type="checkbox" name="is_visible" id="is_visible" value="1" checked
                        class="w-4 h-4 rounded border-gray-300">
                    <label for="is_visible" class="text-sm text-gray-700">Visible in menu</label>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <button type="submit"
                    class="px-6 py-2.5 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition-smooth font-medium">
                    Create Menu Item
                </button>
                <a href="{{ route('menus.index') }}"
                    class="px-6 py-2.5 border border-gray-300 rounded-lg hover:bg-gray-50 transition-smooth font-medium text-gray-700">
                    Cancel
                </a>
            </div>
        </form>
    </div>
@endsection