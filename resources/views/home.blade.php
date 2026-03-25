@extends('layouts.app')

@section('title', 'Home')

@section('content')
<!-- Hero Section -->
<div class="relative bg-gradient-to-r from-indigo-900 to-purple-900 overflow-hidden">
    <!-- Decorative abstract shapes -->
    <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 rounded-full bg-white opacity-5 blur-3xl"></div>
    <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 rounded-full bg-indigo-400 opacity-10 blur-3xl"></div>
    
    <div class="max-w-7xl mx-auto relative z-10">
        <div class="py-20 lg:py-32 px-4 sm:px-6 lg:px-8 text-center lg:text-left flex flex-col lg:flex-row items-center">
            <div class="lg:w-1/2">
                <h1 class="text-4xl tracking-tight font-extrabold text-white sm:text-5xl md:text-6xl drop-shadow-md">
                    <span class="block">Elevate your</span>
                    <span class="block text-indigo-300 mt-2">everyday style</span>
                </h1>
                <p class="mt-6 text-base text-indigo-100 sm:text-lg sm:max-w-xl sm:mx-auto lg:mx-0 leading-relaxed">
                    Discover the latest trends in premium clothing. High-quality materials, sustainable fashion, and unparalleled design tailored for the modern wardrobe.
                </p>
                <div class="mt-10 sm:flex sm:justify-center lg:justify-start">
                    <div class="rounded-full shadow-xl">
                        <a href="{{ route('products.index') }}" class="w-full flex items-center justify-center px-8 py-4 border border-transparent text-base font-bold rounded-full text-indigo-900 bg-white hover:bg-gray-100 md:text-lg transition duration-300 transform hover:-translate-y-1">
                            Explore New Arrivals
                        </a>
                    </div>
                    <div class="mt-4 sm:mt-0 sm:ml-4 rounded-full shadow-xl">
                        <a href="{{ route('products.index') }}" class="w-full flex items-center justify-center px-8 py-4 border-2 border-indigo-300 text-base font-bold rounded-full text-white hover:bg-indigo-800 md:text-lg transition duration-300">
                            Our Collections
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="lg:w-1/2 mt-16 lg:mt-0 hidden lg:block relative">
                 <div class="h-[500px] w-full rounded-2xl bg-indigo-800 backdrop-blur-md bg-opacity-30 border border-white border-opacity-20 shadow-2xl overflow-hidden flex items-center justify-center relative">
                    <!-- A stylized placeholder since we don't have images out of box -->
                    <div class="absolute inset-0 bg-gradient-to-tr from-transparent to-white opacity-10"></div>
                    <svg class="w-48 h-48 text-indigo-300 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                 </div>
            </div>
        </div>
    </div>
</div>

<!-- Featured Products Section -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 bg-gray-50">
    <div class="text-center mb-16">
        <h2 class="text-sm font-bold text-indigo-600 tracking-widest uppercase">Trendy Arrivals</h2>
        <h3 class="text-3xl font-extrabold text-gray-900 mt-2">Featured Collection</h3>
        <div class="mt-4 mx-auto w-16 h-1 bg-indigo-600 rounded"></div>
    </div>
    
    @if($featuredProducts->isEmpty())
        <div class="text-center py-16 text-gray-500 bg-white rounded-2xl shadow-sm border border-gray-100">
            <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
            <p class="text-xl font-medium">New collection arriving soon.</p>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10">
            @foreach($featuredProducts as $product)
                <a href="{{ route('products.show', $product->slug) }}" class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100">
                    <div class="relative h-80 w-full overflow-hidden bg-gray-100">
                        @if($product->images->isNotEmpty())
                            <img src="{{ $product->images->first()->image_path }}" alt="{{ $product->name }}" class="h-full w-full object-cover object-center group-hover:scale-110 transition-transform duration-700">
                        @else
                            <div class="h-full w-full flex items-center justify-center text-gray-400 bg-gradient-to-br from-gray-100 to-gray-200">
                                <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                        @endif
                        <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
                    </div>
                    <div class="p-6">
                        <h4 class="text-lg font-bold text-gray-900 line-clamp-1 group-hover:text-indigo-600 transition-colors">{{ $product->name }}</h4>
                        <p class="mt-2 text-xl font-black text-gray-900">${{ number_format($product->price, 2) }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    @endif
</div>
@endsection
