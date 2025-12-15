<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title', 'Library CMS')</title>

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <!-- Tailwind CSS -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <!-- Alpine.js -->
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

  <style>
    body {
      font-family: 'Outfit', sans-serif;
      background-color: #f3f4f6;
      /* Gray-100 */
    }

    [x-cloak] {
      display: none !important;
    }
  </style>
  @stack('styles')
</head>

<body class="antialiased text-gray-800 flex flex-col min-h-screen">

  @include('library.partials.header')

  <main class="flex-grow">
    @yield('content')
  </main>

  @include('library.partials.footer')

  @stack('scripts')
</body>

</html>