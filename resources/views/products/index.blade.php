@extends('layouts.app')

@section('title', 'Shop Our Collection')

@section('content')
<div class="bg-indigo-900 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl font-extrabold text-white tracking-tight sm:text-5xl">Our Products</h1>
        <p class="mt-4 max-w-xl mx-auto text-xl text-indigo-200">Shop the latest arrivals, exclusive collections, and premium fashion.</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="flex flex-col md:flex-row gap-8">
        <!-- Sidebar filters -->
        <div class="hidden md:block w-64 flex-shrink-0">
            <h2 class="text-lg font-bold text-gray-900 mb-6 uppercase tracking-wider">Categories</h2>
            <div class="space-y-4">
                <a href="{{ route('products.index') }}" class="block text-base font-medium transition-colors hover:text-indigo-600 {{ !request('category') ? 'text-indigo-600 font-bold' : 'text-gray-600' }}">
                    All Categories
                </a>
                @foreach($categories as $category)
                    <a href="{{ route('products.index', ['category' => $category->slug]) }}" class="block text-base font-medium transition-colors hover:text-indigo-600 {{ request('category') === $category->slug ? 'text-indigo-600 font-bold' : 'text-gray-600' }}">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>
            
            <div class="mt-10 border-t border-gray-200 pt-8">
                <h2 class="text-lg font-bold text-gray-900 mb-6 uppercase tracking-wider">Filters</h2>
                <div class="p-4 bg-gray-50 rounded-xl border border-gray-100 text-center">
                    <p class="text-sm text-gray-500">More filters coming soon.</p>
                </div>
            </div>
        </div>

        <!-- Product Grid -->
        <div class="flex-1">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-2xl font-bold text-gray-900">
                    {{ request('category') ? $categories->where('slug', request('category'))->first()->name ?? 'Collection' : 'All Products' }}
                </h2>
                <div class="text-sm text-gray-500">
                    Showing {{ $products->firstItem() ?? 0 }} - {{ $products->lastItem() ?? 0 }} of {{ $products->total() }} results
                </div>
            </div>

            @if($products->isEmpty())
                <div class="text-center py-24 bg-white rounded-3xl border border-gray-100 shadow-sm">
                    <svg class="mx-auto h-20 w-20 text-gray-300 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    <h3 class="text-2xl font-bold text-gray-900">No products found</h3>
                    <p class="mt-2 text-gray-500 text-lg">Try adjusting your category filter.</p>
                    <a href="{{ route('products.index') }}" class="mt-6 inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-full shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 transition duration-300">
                        View all products
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($products as $product)
                        <a href="{{ route('products.show', $product->slug) }}" class="group bg-white rounded-2xl overflow-hidden border border-gray-100 hover:border-transparent hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 block">
                            <div class="relative h-80 w-full overflow-hidden bg-gray-50 flex items-center justify-center p-4">
                                @if($product->images->isNotEmpty())
                                    <img src="{{ $product->images->first()->image_path }}" alt="{{ $product->name }}" class="h-full w-full object-cover object-center group-hover:scale-105 transition-transform duration-500 rounded-xl">
                                @else
                                    <svg class="w-20 h-20 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                @endif
                                <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-5 transition-opacity duration-300"></div>
                            </div>
                            <div class="p-6">
                                <p class="text-sm text-indigo-600 font-semibold mb-1 uppercase tracking-wider">{{ $product->category->name }}</p>
                                <h3 class="text-lg font-bold text-gray-900 line-clamp-2 leading-snug group-hover:text-indigo-600 transition-colors">{{ $product->name }}</h3>
                                <div class="mt-4 flex items-center justify-between">
                                    <p class="text-xl font-black text-gray-900">${{ number_format($product->price, 2) }}</p>
                                    <span class="text-sm font-medium text-gray-500 hover:text-indigo-600 flex items-center transition-colors">
                                        Details <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                    </span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
                
                <div class="mt-12 flex justify-center">
                    {{ $products->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
