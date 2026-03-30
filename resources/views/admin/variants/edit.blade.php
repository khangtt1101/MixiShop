@extends('layouts.admin')

@section('header', 'Edit Variant')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h2 class="text-xl font-bold text-gray-800">Edit Variant for: {{ $product->name }}</h2>
    <a href="{{ route('admin.variants.index', $product) }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition">
        <i class="fa-solid fa-arrow-left mr-2"></i> Back to Variants
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 max-w-xl">
    <form action="{{ route('admin.products.variants.update', [$product, $variant]) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-4">
            <label for="size" class="block text-sm font-medium text-gray-700 mb-1">Size <span class="text-red-500">*</span></label>
            <input type="text" id="size" name="size" value="{{ old('size', $variant->size) }}" required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition @error('size') border-red-500 @enderror">
            @error('size')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="color" class="block text-sm font-medium text-gray-700 mb-1">Color <span class="text-red-500">*</span></label>
            <input type="text" id="color" name="color" value="{{ old('color', $variant->color) }}" required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition @error('color') border-red-500 @enderror">
            @error('color')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="stock_quantity" class="block text-sm font-medium text-gray-700 mb-1">Stock Quantity <span class="text-red-500">*</span></label>
            <input type="number" id="stock_quantity" name="stock_quantity" value="{{ old('stock_quantity', $variant->stock_quantity) }}" min="0" required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition @error('stock_quantity') border-red-500 @enderror">
            @error('stock_quantity')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end gap-3 mt-8">
            <a href="{{ route('admin.variants.index', $product) }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">Cancel</a>
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">Update Variant</button>
        </div>
    </form>
</div>
@endsection
