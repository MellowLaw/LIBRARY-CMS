@extends('layouts.public')

@section('title', $page->title . ' - AddLib')

@section('content')
    <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <article class="bg-white rounded-lg shadow-sm border border-gray-200 p-8">
            <header class="mb-8 pb-6 border-b border-gray-200">
                <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $page->title }}</h1>
                @if($page->meta_description)
                    <p class="text-xl text-gray-600">{{ $page->meta_description }}</p>
                @endif
                <p class="text-sm text-gray-500 mt-4">
                    Published {{ $page->published_at->format('F d, Y') }}
                </p>
            </header>

            <div class="prose prose-lg max-w-none">
                @if($page->content)
                    {!! $page->content !!}
                @else
                    <p class="text-gray-500 italic">Content coming soon...</p>
                @endif
            </div>
        </article>

        <div class="mt-8 text-center">
            <a href="{{ route('public.home') }}" class="text-emerald-600 hover:text-emerald-700 font-medium">
                ← Back to Home
            </a>
        </div>
    </main>
@endsection