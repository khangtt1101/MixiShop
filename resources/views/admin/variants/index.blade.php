@extends('layouts.admin')

@section('header', 'Product Variants')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h2 class="text-xl font-bold text-gray-800">Variants for: {{ $product->name }}</h2>
        <p class="text-sm text-gray-500">Manage sizes, colors, and stock levels</p>
    </div>
    <div class="flex gap-2">
        <a href="{{ route('admin.products.index') }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition">
            <i class="fa-solid fa-arrow-left mr-2"></i> Products
        </a>
        <a href="{{ route('admin.products.variants.create', $product) }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
            <i class="fa-solid fa-plus mr-2"></i> Add Variant
        </a>
    </div>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-gray-50 text-gray-600 text-sm uppercase">
                <tr>
                    <th class="px-6 py-3">ID</th>
                    <th class="px-6 py-3">Size</th>
                    <th class="px-6 py-3">Color</th>
                    <th class="px-6 py-3">Stock Quantity</th>
                    <th class="px-6 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($variants as $variant)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4 text-gray-500">{{ $variant->id }}</td>
                    <td class="px-6 py-4 font-medium text-gray-900">{{ $variant->size }}</td>
                    <td class="px-6 py-4">{{ $variant->color }}</td>
                    <td class="px-6 py-4">
                        @if($variant->stock_quantity > 10)
                            <span class="text-green-600 font-semibold"><i class="fa-solid fa-check-circle mr-1"></i> {{ $variant->stock_quantity }}</span>
                        @elseif($variant->stock_quantity > 0)
                            <span class="text-yellow-600 font-semibold"><i class="fa-solid fa-exclamation-triangle mr-1"></i> {{ $variant->stock_quantity }}</span>
                        @else
                            <span class="text-red-600 font-semibold"><i class="fa-solid fa-times-circle mr-1"></i> Out of Stock</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('admin.products.variants.edit', [$product, $variant]) }}" class="text-blue-500 hover:text-blue-700 bg-blue-50 hover:bg-blue-100 p-2 rounded transition" title="Edit">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <form action="{{ route('admin.products.variants.destroy', [$product, $variant]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this variant?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 bg-red-50 hover:bg-red-100 p-2 rounded transition">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-gray-500">No variants found for this product.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($variants->hasPages())
    <div class="px-6 py-4 border-t border-gray-100">
        {{ $variants->links() }}
    </div>
    @endif
</div>
@endsection
