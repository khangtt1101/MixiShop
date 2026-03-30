<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'MixiShop') }} - Admin Panel</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Inter Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 antialiased h-screen flex overflow-hidden">

    <!-- Sidebar -->
    <aside class="w-64 bg-slate-900 text-slate-300 flex-shrink-0 flex flex-col transition-all duration-300">
        <!-- Logo -->
        <div class="h-16 flex items-center justify-center border-b border-slate-800">
            <h1 class="text-2xl font-bold tracking-wider text-white">
                <i class="fa-solid fa-store mr-2 text-blue-500"></i>Mixi<span class="text-blue-500">Admin</span>
            </h1>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 overflow-y-auto py-4">
            <ul class="space-y-1 px-3">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white' : 'hover:bg-slate-800 hover:text-white' }}">
                        <i class="fa-solid fa-chart-pie w-5"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg transition-colors {{ request()->routeIs('admin.categories.*') ? 'bg-blue-600 text-white' : 'hover:bg-slate-800 hover:text-white' }}">
                        <i class="fa-solid fa-tags w-5"></i> Categories
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.products.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg transition-colors {{ request()->routeIs('admin.products.*') || request()->routeIs('admin.variants.*') ? 'bg-blue-600 text-white' : 'hover:bg-slate-800 hover:text-white' }}">
                        <i class="fa-solid fa-box-open w-5"></i> Products
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.orders.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg transition-colors {{ request()->routeIs('admin.orders.*') ? 'bg-blue-600 text-white' : 'hover:bg-slate-800 hover:text-white' }}">
                        <i class="fa-solid fa-shopping-cart w-5"></i> Orders
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Footer Profile -->
        <div class="p-4 border-t border-slate-800">
            <div class="flex items-center gap-3">
                <div class="h-10 w-10 rounded-full bg-slate-700 flex items-center justify-center text-white font-bold">
                    A
                </div>
                <div>
                    <h4 class="text-sm font-medium text-white">Administrator</h4>
                    <p class="text-xs text-slate-400">Manage System</p>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col h-screen overflow-hidden">
        <!-- Header -->
        <header class="h-16 bg-white border-b flex items-center justify-between px-6 flex-shrink-0 shadow-sm z-10">
            <div class="flex items-center gap-2 text-xl font-semibold text-gray-800">
                @yield('header')
            </div>
            <div class="flex items-center gap-4">
                <a href="{{ route('home') }}" target="_blank" class="text-sm text-blue-600 hover:underline">
                    <i class="fa-solid fa-external-link-alt mr-1"></i> View Store
                </a>
            </div>
        </header>

        <!-- Page Content -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-6">
            @if(session('success'))
                <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-sm" role="alert">
                    <p class="font-bold">Success</p>
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded shadow-sm" role="alert">
                    <p class="font-bold">Error</p>
                    <p>{{ session('error') }}</p>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    @stack('scripts')
</body>
</html>
