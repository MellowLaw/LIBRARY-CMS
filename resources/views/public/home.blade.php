<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library CMS - Home</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <h1 class="text-xl font-bold text-gray-900">Library CMS</h1>
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
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Hero Section -->
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Welcome to Our Library</h2>
            <p class="text-xl text-gray-600">Discover our resources and services</p>
        </div>

        <!-- Pages Section -->
        @if($pages->count() > 0)
            <section class="mb-12">
                <h3 class="text-2xl font-bold text-gray-900 mb-6">Recent Pages</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($pages as $page)
                        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-smooth">
                            <h4 class="text-lg font-semibold text-gray-900 mb-2">
                                <a href="{{ route('public.page', $page->slug) }}" class="hover:text-emerald-600">
                                    {{ $page->title }}
                                </a>
                            </h4>
                            @if($page->meta_description)
                                <p class="text-sm text-gray-600">{{ Str::limit($page->meta_description, 100) }}</p>
                            @endif
                            <p class="text-xs text-gray-500 mt-2">Published {{ $page->published_at->diffForHumans() }}</p>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        <!-- Staff Section -->
        @if($staff->count() > 0)
            <section class="mb-12">
                <h3 class="text-2xl font-bold text-gray-900 mb-6">Our Staff</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($staff as $member)
                        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 text-center">
                            <div class="w-20 h-20 bg-gradient-to-br from-emerald-400 to-emerald-600 rounded-full mx-auto mb-4 flex items-center justify-center text-white text-2xl font-bold">
                                {{ substr($member->name, 0, 1) }}
                            </div>
                            <h4 class="text-lg font-semibold text-gray-900">{{ $member->name }}</h4>
                            <p class="text-sm text-gray-600">{{ $member->position }}</p>
                            @if($member->email)
                                <p class="text-xs text-gray-500 mt-2">{{ $member->email }}</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        <!-- Resources Section -->
        @if($resources->count() > 0)
            <section>
                <h3 class="text-2xl font-bold text-gray-900 mb-6">Resources</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($resources as $resource)
                        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
                            <a href="{{ $resource->url }}" 
                               target="{{ $resource->is_external ? '_blank' : '_self' }}"
                               class="text-emerald-600 hover:text-emerald-700 font-medium">
                                {{ $resource->title }}
                            </a>
                            @if($resource->description)
                                <p class="text-sm text-gray-600 mt-1">{{ $resource->description }}</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            </section>
        @endif
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <p class="text-center text-gray-400">&copy; {{ date('Y') }} Library CMS. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>

