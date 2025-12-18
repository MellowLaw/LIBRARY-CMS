<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Library CMS')</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/favicon.png') }}">

    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">

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
<div class="flex flex-col min-h-screen bg-primary-bg">
    <!-- Top Navigation -->
    @include('layouts.navbar')

    <!-- Main Content -->
    <div class="flex-1">
        <!-- Sidebar only for authenticated admin/staff, obscured for viewers if desired, or removed entirely if Unified Navbar is primary. 
                  User request says "Navbar menu items: Home, News, Staff, Resources". 
                  It implies Sidebar might be deprecated or secondary. 
                  For now, I will Comment out the Sidebar include to strictly follow "Unified Navbar" request 
                  unless the user specifically asked for backend specific layouts. 
                  Wait, the plan said "I will keep the sidebar for Admin functions". 
                  But the layout here is `app.blade.php`. 
                  Let's check if there is a specific `public.blade.php` layout. 
                  All pages must use the same navbar. 
                  Let's make app.blade.php the universal layout. 
             -->

        <!-- Page Content -->
        <main class="p-8 pt-28 max-w-7xl mx-auto">
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-green-800">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    @unless(isset($hideFooter) && $hideFooter)
        @include('layouts.footer')
    @endunless
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

    // Custom Logout Modal Logic
    let logoutFormTarget = null;

    function openLogoutModal(form) {
        logoutFormTarget = form;
        document.getElementById('logoutModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden'; // Prevent background scrolling
    }

    function closeLogoutModal() {
        logoutFormTarget = null;
        document.getElementById('logoutModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    function confirmLogout() {
        if (logoutFormTarget) {
            logoutFormTarget.submit();
        }
        closeLogoutModal();
    }

    // Close on escape key
    document.addEventListener('keydown', function (event) {
        if (event.key === "Escape") {
            closeLogoutModal();
        }
    });
</script>

<!-- Logout Confirmation Modal -->
<div id="logoutModal" class="hidden fixed inset-0 z-[200] overflow-y-auto" aria-labelledby="modal-title" role="dialog"
    aria-modal="true">
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity backdrop-blur-sm"
        onclick="closeLogoutModal()"></div>

    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
        <div
            class="relative transform overflow-hidden rounded-[50px] bg-[#efeae4] text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg border border-[#e5dcd6]">
            <div class="bg-[#efeae4] px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div
                        class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                        <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                        </svg>
                    </div>
                    <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                        <h3 class="text-xl font-semibold leading-6 text-gray-900" id="modal-title">Confirm Sign Out</h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">Are you sure you want to sign out of your account?</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-[#efeae4] px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                <button type="button" onclick="confirmLogout()"
                    class="inline-flex w-full justify-center rounded-md bg-[#ec3412] px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-700 sm:ml-3 sm:w-auto transition-colors">Yes,
                    Sign Out</button>
                <button type="button" onclick="closeLogoutModal()"
                    class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto transition-colors">Cancel</button>
            </div>
        </div>
    </div>
</div>

@stack('scripts')
</body>

</html>