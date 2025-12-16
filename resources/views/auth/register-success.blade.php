<!DOCTYPE html>
<html lang="en" class="h-full bg-[#efeae4]">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Created - AddLib</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Outfit', sans-serif;
        }
    </style>
</head>

<body class="h-full flex items-center justify-center p-4">
    <!-- Decorative Background Elements -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-[-10%] right-[-5%] w-[500px] h-[500px] bg-[#ec3412]/5 rounded-full blur-[100px]"></div>
        <div class="absolute bottom-[-10%] left-[-5%] w-[500px] h-[500px] bg-[#ec3412]/5 rounded-full blur-[100px]"></div>
    </div>

    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl overflow-hidden border border-white/50 relative z-10 transform transition-all hover:scale-[1.01] duration-300">
        <div class="p-8 text-center">
            <!-- Icon -->
            <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-green-50 mb-6 animate-bounce-subtle">
                <svg class="h-10 w-10 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>

            <h2 class="text-3xl font-bold text-gray-900 mb-2">Welcome Aboard!</h2>
            <p class="text-gray-500 text-lg mb-8">Your account has been successfully created. You're all set to explore AddLib.</p>

            <div class="space-y-4">
                <a href="{{ route('dashboard') }}"
                    class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-semibold rounded-xl text-white bg-[#ec3412] hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-all duration-200 shadow-lg hover:shadow-orange-500/30 transform active:scale-95">
                    Go to Dashboard
                    <svg class="ml-2 -mr-1 w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </a>
                
                <a href="{{ route('public.home') }}" class="block text-sm font-medium text-gray-500 hover:text-[#ec3412] transition-colors">
                    Back to Home
                </a>
            </div>
        </div>
        
        <!-- Bottom flair -->
        <div class="h-1.5 w-full bg-gradient-to-r from-orange-400 via-[#ec3412] to-orange-600"></div>
    </div>
</body>

</html>