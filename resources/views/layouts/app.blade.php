<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Library CMS')</title>
    
    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Heroicons -->
    <link href="https://cdn.jsdelivr.net/npm/heroicons@2.0.18/outline/index.min.css" rel="stylesheet">
    
    <!-- TinyMCE -->
    <script src="https://cdn.jsdelivr.net/npm/tinymce@6.8.6/tinymce.min.js" referrerpolicy="origin"></script>
    
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
        
        :root {
            --color-primary: #1F2937;
            --color-secondary: #10B981;
            --color-danger: #EF4444;
            --color-warning: #F59E0B;
            --color-success: #10B981;
            --color-bg: #F9FAFB;
            --color-surface: #FFFFFF;
            --color-text: #1F2937;
            --color-text-light: #6B7280;
            --color-border: #E5E7EB;
        }
        
        body {
            background-color: var(--color-bg);
            color: var(--color-text);
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="flex h-screen bg-gray-100">
        <!-- Sidebar -->
        @include('layouts.sidebar')
        
        <!-- Main Content -->
        <div class="flex-1 overflow-auto">
            <!-- Top Navigation -->
            @include('layouts.navbar')
            
            <!-- Page Content -->
            <main class="p-8">
                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                        <h3 class="text-red-800 font-semibold mb-2">Errors</h3>
                        <ul class="text-red-700 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>• {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                @if (session('success'))
                    <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg animate-fade-in-out">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="text-green-800">{{ session('success') }}</span>
                        </div>
                    </div>
                @endif
                
                @yield('content')
            </main>
        </div>
    </div>
    
    <script>
        // Global alert notification
        function showNotification(message, type = 'success') {
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 p-4 rounded-lg shadow-lg animate-slide-in-right z-50
                ${type === 'success' ? 'bg-green-50 text-green-800 border border-green-200' : 
                  type === 'error' ? 'bg-red-50 text-red-800 border border-red-200' :
                  'bg-blue-50 text-blue-800 border border-blue-200'}`;
            
            notification.innerHTML = message;
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.remove();
            }, 4000);
        }
    </script>
    
    @stack('scripts')
</body>
</html>
