<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $page->title }} - Library CMS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @if($page->meta_description)
        <meta name="description" content="{{ $page->meta_description }}">
    @endif
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <a href="{{ route('public.home') }}" class="text-xl font-bold text-gray-900 hover:text-emerald-600">
                        Library CMS
                    </a>
                </div>
                <div class="flex items-center gap-4">
                    @foreach($menus as $menu)
                        <a href="{{ $menu->url ?? '#' }}" class="text-gray-700 hover:text-emerald-600 font-medium">
                            {{ $menu->label }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
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

    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <p class="text-center text-gray-400">&copy; {{ date('Y') }} Library CMS. All rights reserved.</p>
        </div>
    </footer>
</body>

</html>