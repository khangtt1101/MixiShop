@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="bg-gray-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumbs -->
        <nav class="flex text-sm text-gray-500 mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="hover:text-indigo-600 transition-colors">Home</a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 text-gray-400 mx-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        <a href="{{ route('products.index') }}" class="hover:text-indigo-600 transition-colors">Products</a>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 text-gray-400 mx-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        <a href="{{ route('products.index', ['category' => $product->category->slug]) }}" class="hover:text-indigo-600 transition-colors">{{ $product->category->name }}</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 text-gray-400 mx-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        <span class="text-gray-900 font-medium line-clamp-1">{{ $product->name }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="lg:grid lg:grid-cols-2 lg:gap-x-12 xl:gap-x-16">
            <!-- Image Gallery -->
            <div class="flex flex-col-reverse">
                <!-- Image Selector -->
                <div class="mt-6 w-full max-w-2xl mx-auto hidden sm:block lg:max-w-none">
                    <div class="grid grid-cols-4 gap-6" aria-orientation="horizontal" role="tablist">
                        @forelse($product->images as $image)
                            <button class="relative h-24 bg-white rounded-xl flex items-center justify-center text-sm font-medium uppercase text-gray-900 cursor-pointer hover:bg-gray-50 focus:outline-none focus:ring focus:ring-opacity-50 focus:ring-offset-4 focus:ring-indigo-500 overflow-hidden border border-gray-200">
                                <span class="absolute inset-0">
                                    <img src="{{ $image->image_path }}" alt="" class="w-full h-full object-center object-cover">
                                </span>
                            </button>
                        @empty
                            <div class="h-24 bg-gray-200 rounded-xl border border-gray-300 border-dashed flex items-center justify-center">
                                <span class="text-gray-400 text-xs">No image</span>
                            </div>
                        @endforelse
                    </div>
                </div>

                <div class="w-full aspect-w-1 aspect-h-1 bg-white rounded-3xl overflow-hidden shadow-sm border border-gray-100 flex items-center justify-center">
                    @if($product->images->isNotEmpty())
                        <img src="{{ $product->images->first()->image_path }}" alt="{{ $product->name }}" class="w-full h-full object-center object-cover">
                    @else
                        <div class="p-24 bg-gray-50 w-full h-full flex flex-col items-center justify-center text-gray-400">
                            <svg class="w-24 h-24 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <span>No Image Available</span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Product Info -->
            <div class="mt-10 px-4 sm:px-0 lg:mt-0">
                <h1 class="text-3xl font-extrabold tracking-tight text-gray-900">{{ $product->name }}</h1>
                
                <div class="mt-4 border-b border-gray-200 pb-6">
                    <p class="text-3xl text-indigo-600 font-black">${{ number_format($product->price, 2) }}</p>
                </div>
                
                <div class="mt-6">
                    <h3 class="sr-only">Description</h3>
                    <div class="text-base text-gray-700 leading-relaxed font-normal">
                        <p>{{ $product->description ?: 'Premium product crafted with fine materials and an eye for enduring style. A perfect addition to any modern wardrobe.' }}</p>
                    </div>
                </div>

                <form class="mt-8" action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    @if($product->variants->isNotEmpty())
                    <div class="mb-6">
                        <label for="variant_id" class="block text-sm text-gray-900 font-bold uppercase tracking-wider mb-2">Select Variant</label>
                        <select name="variant_id" id="variant_id" required class="mt-1 block w-full pl-3 pr-10 py-3 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md shadow-sm border bg-white">
                            <option value="" disabled selected>Choose Size & Color</option>
                            @foreach($product->variants as $variant)
                                <option value="{{ $variant->id }}" {{ $variant->stock_quantity <= 0 ? 'disabled' : '' }}>
                                    {{ $variant->size }} @if($variant->color) - {{ $variant->color }} @endif 
                                    @if($variant->stock_quantity <= 0) (OUT OF STOCK) @endif
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @endif

                    <div class="mb-6">
                        <label for="quantity" class="block text-sm text-gray-900 font-bold uppercase tracking-wider mb-2">Quantity</label>
                        <input type="number" name="quantity" id="quantity" value="1" min="1" class="mt-1 block w-24 pl-3 pr-3 py-3 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md shadow-sm border bg-white text-center">
                    </div>

                    @if(session('error'))
                        <div class="text-red-500 text-sm font-bold mt-2">{{ session('error') }}</div>
                    @endif
                    @if(session('success'))
                        <div class="text-green-500 text-sm font-bold mt-2">{{ session('success') }}</div>
                    @endif

                    <div class="mt-10 flex gap-4">
                        <button type="submit" class="flex-1 bg-indigo-600 border border-transparent rounded-full py-4 px-8 flex items-center justify-center text-base font-bold text-white hover:bg-indigo-700 shadow-md transform hover:-translate-y-0.5 transition-all duration-300">
                            Add to Cart
                        </button>
                        <button type="button" class="flex-none rounded-full py-4 px-4 bg-white text-gray-400 hover:bg-gray-50 hover:text-red-500 border border-gray-200 shadow-sm transition-all duration-300">
                            <svg class="h-6 w-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                        </button>
                    </div>
                </form>
                
                <div class="mt-10 border-t border-gray-200 pt-8 pt-6">
                    <ul class="space-y-4 text-sm font-medium text-gray-500">
                        <li class="flex items-center">
                            <svg class="w-5 h-5 mr-3 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Free shipping on orders over $100
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 mr-3 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> 30-day return policy
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 mr-3 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Secure international payment
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
