@extends('layouts.app')

@section('page-title', $page->title)
@section('page-subtitle', 'Page Preview')

@section('content')
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8">
        <div class="mb-6 pb-6 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">{{ $page->title }}</h1>
                    @if($page->meta_description)
                        <p class="text-gray-600 mt-2">{{ $page->meta_description }}</p>
                    @endif
                </div>
                <div class="flex items-center gap-3">
                    @if($page->is_published)
                        <span
                            class="inline-flex items-center gap-1 px-3 py-1 bg-green-100 text-green-700 text-xs font-medium rounded-full">
                            <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                            Published
                        </span>
                    @else
                        <span
                            class="inline-flex items-center gap-1 px-3 py-1 bg-gray-100 text-gray-700 text-xs font-medium rounded-full">
                            <span class="w-2 h-2 bg-gray-500 rounded-full"></span>
                            Draft
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <div class="prose prose-lg max-w-none">
            @if($page->content)
                {!! $page->content !!}
            @else
                <p class="text-gray-500 italic">No content added yet. Click "Edit Page" to add content.</p>
            @endif
        </div>

        <div class="mt-8 pt-6 border-t border-gray-200 flex items-center justify-between">
            <div class="text-sm text-gray-500">
                <p>Created by {{ $page->creator->name }} on {{ $page->created_at->format('M d, Y') }}</p>
                @if($page->updated_at != $page->created_at)
                    <p>Last updated {{ $page->updated_at->format('M d, Y') }}</p>
                @endif
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('pages.edit', $page) }}"
                    class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition-smooth font-medium">
                    Edit Page
                </a>
                <a href="{{ route('pages.index') }}"
                    class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition-smooth font-medium text-gray-700">
                    Back to List
                </a>
            </div>
        </div>
    </div>
@endsection