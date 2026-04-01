@extends('layouts.admin')

@section('header', 'Products')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h2 class="text-xl font-bold text-gray-800">Manage Products</h2>
    <a href="{{ route('admin.products.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
        <i class="fa-solid fa-plus mr-2"></i> Add Product
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-gray-50 text-gray-600 text-sm uppercase">
                <tr>
                    <th class="px-6 py-3">ID</th>
                    <th class="px-6 py-3">Product Info</th>
                    <th class="px-6 py-3">Category</th>
                    <th class="px-6 py-3">Price</th>
                    <th class="px-6 py-3">Status</th>
                    <th class="px-6 py-3">Variants</th>
                    <th class="px-6 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($products as $product)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4 text-gray-500">{{ $product->id }}</td>
                    <td class="px-6 py-4">
                        <div class="font-medium text-gray-900">{{ $product->name }}</div>
                        <div class="text-xs text-gray-500">{{ $product->slug }}</div>
                    </td>
                    <td class="px-6 py-4 text-gray-600">{{ $product->category->name ?? 'None' }}</td>
                    <td class="px-6 py-4 font-semibold">${{ number_format($product->price, 2) }}</td>
                    <td class="px-6 py-4">
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" class="sr-only peer toggle-status" 
                                data-id="{{ $product->id }}"
                                data-url="{{ route('admin.products.toggle-status', $product) }}"
                                {{ $product->is_active ? 'checked' : '' }}>
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-500"></div>
                        </label>
                    </td>
                    <td class="px-6 py-4">
                        <a href="{{ route('admin.variants.index', $product) }}" class="inline-flex items-center gap-1 px-3 py-1 bg-purple-50 text-purple-700 hover:bg-purple-100 rounded-full text-xs font-semibold transition">
                            <i class="fa-solid fa-layer-group"></i> {{ $product->variants_count }}
                        </a>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('admin.products.edit', $product) }}" class="text-blue-500 hover:text-blue-700 bg-blue-50 hover:bg-blue-100 p-2 rounded transition" title="Edit">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 rounded transition flex items-center justify-center {{ $product->variants_count > 0 ? 'text-gray-400 bg-gray-100 cursor-not-allowed' : 'text-red-500 hover:text-red-700 bg-red-50 hover:bg-red-100' }}"
                                    {{ $product->variants_count > 0 ? 'disabled title="Cannot delete product with variants"' : '' }}>
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-8 text-center text-gray-500">No products found. Start by creating one!</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($products->hasPages())
    <div class="px-6 py-4 border-t border-gray-100">
        {{ $products->links() }}
    </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const toggleButtons = document.querySelectorAll('.toggle-status');
    
    toggleButtons.forEach(button => {
        button.addEventListener('change', function() {
            const url = this.dataset.url;
            const originalState = !this.checked;
            
            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (!data.success) {
                    this.checked = originalState; // Revert UI
                    alert('Error updating status.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                this.checked = originalState; // Revert UI
                alert('Connection error. Failed to update status.');
            });
        });
    });
});
</script>
@endpush
