@extends('layouts.admin')

@section('header', 'Order Details')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h2 class="text-xl font-bold text-gray-800">Order #{{ $order->id }}</h2>
    <a href="{{ route('admin.orders.index') }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition">
        <i class="fa-solid fa-arrow-left mr-2"></i> Back to Orders
    </a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Left Column: Details -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Order Items -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100">
                <h3 class="font-bold text-gray-800">Order Items</h3>
            </div>
            <div class="p-6">
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-sm text-gray-500 border-b">
                            <th class="pb-3">Product</th>
                            <th class="pb-3">Price</th>
                            <th class="pb-3 text-center">Qty</th>
                            <th class="pb-3 text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($order->items as $item)
                        <tr>
                            <td class="py-4">
                                <div class="font-medium text-gray-900">{{ $item->variant->product->name ?? 'Unknown Product' }}</div>
                                <div class="text-sm text-gray-500">Size: {{ $item->variant->size ?? 'N/A' }} | Color: {{ $item->variant->color ?? 'N/A' }}</div>
                            </td>
                            <td class="py-4">${{ number_format($item->price, 2) }}</td>
                            <td class="py-4 text-center">{{ $item->quantity }}</td>
                            <td class="py-4 text-right font-medium">${{ number_format($item->price * $item->quantity, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="border-t font-bold text-lg">
                            <td colspan="3" class="pt-4 text-right pr-4">Total Amount:</td>
                            <td class="pt-4 text-right">${{ number_format($order->total_price, 2) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <!-- Right Column: Status & Customer Info -->
    <div class="space-y-6">
        <!-- Status Update -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h3 class="font-bold text-gray-800 mb-4">Order Status</h3>
            <form action="{{ route('admin.orders.update', $order) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                        <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>
                <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                    Update Status
                </button>
            </form>
        </div>

        <!-- Customer Information -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h3 class="font-bold text-gray-800 mb-4">Customer Details</h3>
            <div class="space-y-3 text-sm">
                <div>
                    <span class="text-gray-500 block">Name</span>
                    <span class="font-medium">{{ $order->user->name ?? 'Guest' }}</span>
                </div>
                @if($order->user)
                <div>
                    <span class="text-gray-500 block">Email</span>
                    <span>{{ $order->user->email }}</span>
                </div>
                @endif
                <div>
                    <span class="text-gray-500 block">Phone</span>
                    <span>{{ $order->phone }}</span>
                </div>
                <div>
                    <span class="text-gray-500 block">Shipping Address</span>
                    <span class="leading-relaxed">{{ $order->shipping_address }}</span>
                </div>
                <div>
                    <span class="text-gray-500 block">Order Date</span>
                    <span>{{ $order->created_at->format('F d, Y H:i:s') }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
