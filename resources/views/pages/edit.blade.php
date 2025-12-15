@extends('layouts.app')

@section('page-title', 'Edit Page')
@section('page-subtitle', 'Update page information')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Main Form -->
    <div class="lg:col-span-2">
        <form method="POST" action="{{ route('pages.update', $page) }}" class="space-y-6">
            @csrf
            @method('PUT')
            
            <!-- Basic Info Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Page Information</h3>
                
                <div class="space-y-4">
                    <!-- Title -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">Page Title <span class="text-red-500">*</span></label>
                        <input type="text" 
                               name="title" 
                               value="{{ old('title', $page->title) }}"
                               placeholder="Enter page title"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent"
                               required>
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Slug -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">Slug <span class="text-red-500">*</span></label>
                        <div class="flex items-center gap-2">
                            <span class="text-gray-600 text-sm">/</span>
                            <input type="text" 
                                   name="slug" 
                                   value="{{ old('slug', $page->slug) }}"
                                   placeholder="page-slug"
                                   class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent text-sm"
                                   required>
                        </div>
                        <p class="mt-2 text-xs text-gray-500">URL-friendly identifier</p>
                        @error('slug')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Meta Description -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">Meta Description</label>
                        <textarea name="meta_description" 
                                  placeholder="Brief description for SEO (160 characters max)"
                                  rows="2"
                                  maxlength="160"
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent text-sm">{{ old('meta_description', $page->meta_description) }}</textarea>
                        <p class="mt-1 text-xs text-gray-500">Used for search engine listings</p>
                        @error('meta_description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            
            <!-- Buttons -->
            <div class="flex items-center gap-3">
                <button type="submit"
                        class="inline-flex items-center gap-2 px-6 py-2.5 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition-smooth font-medium">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Update Page
                </button>
                <a href="{{ route('pages.index') }}" class="px-6 py-2.5 border border-gray-300 rounded-lg hover:bg-gray-50 transition-smooth font-medium text-gray-700">
                    Cancel
                </a>
            </div>
        </form>
    </div>
    
    <!-- Sidebar -->
    <div class="lg:col-span-1 space-y-6">
        <!-- Page Status -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Page Status</h3>
            
            <div class="space-y-3">
                @if($page->is_published)
                    <div class="flex items-center gap-2 text-green-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="font-medium">Published</span>
                    </div>
                    <p class="text-xs text-gray-500">Published on {{ $page->published_at->format('M d, Y') }}</p>
                @elseif($page->scheduled_at)
                    <div class="flex items-center gap-2 text-blue-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="font-medium">Scheduled</span>
                    </div>
                    <p class="text-xs text-gray-500">Scheduled for {{ $page->scheduled_at->format('M d, Y H:i') }}</p>
                @else
                    <div class="flex items-center gap-2 text-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        <span class="font-medium">Draft</span>
                    </div>
                @endif
            </div>
        </div>
        
        <!-- Quick Actions -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Quick Actions</h3>
            <div class="space-y-2">
                @if(!$page->is_published)
                    <form method="POST" action="{{ route('pages.update', $page) }}" class="inline">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="is_published" value="1">
                        <button type="submit" class="w-full text-left px-4 py-2 bg-emerald-50 hover:bg-emerald-100 rounded-lg text-emerald-700 font-medium text-sm">
                            Publish Now
                        </button>
                    </form>
                @endif
                <a href="{{ route('pages.show', $page) }}" target="_blank" class="block px-4 py-2 bg-blue-50 hover:bg-blue-100 rounded-lg text-blue-700 font-medium text-sm text-center">
                    Preview Page
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

