<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mixi Clothing - @yield('title', 'Premium E-Commerce')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800 font-sans antialiased flex flex-col min-h-screen">
    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="text-2xl font-black text-indigo-600 tracking-wider">MIXI</a>
                </div>
                <div class="flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-gray-600 hover:text-indigo-600 font-medium transition duration-200">Home</a>
                    <a href="{{ route('products.index') }}" class="text-gray-600 hover:text-indigo-600 font-medium transition duration-200">Shop</a>
                    <a href="#" class="text-gray-600 hover:text-indigo-600 font-medium transition duration-200 relative">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        <span class="absolute -top-2 -right-2 bg-indigo-600 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">0</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-grow">
        @yield('content')
    </main>

    <footer class="bg-gray-900 text-white mt-12 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center text-center py-6">
                <div class="mb-4 md:mb-0">
                    <span class="text-2xl font-black text-white tracking-wider">MIXI</span>
                    <p class="text-gray-400 text-sm mt-2">Premium clothing for everyone.</p>
                </div>
                <p class="text-gray-400 text-sm">&copy; {{ date('Y') }} Mixi Clothing. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>
