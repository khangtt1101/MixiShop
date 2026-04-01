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
            <h3 class="font-bold text-gray-800 mb-4 text-center">Order Status Action</h3>
            
            <div class="mb-6 flex justify-center">
                <span class="px-4 py-2 rounded-full text-sm font-bold tracking-wide uppercase shadow-sm border
                    @if($order->status == 'pending') bg-yellow-50 text-yellow-700 border-yellow-200
                    @elseif($order->status == 'confirmed') bg-purple-50 text-purple-700 border-purple-200
                    @elseif($order->status == 'shipping') bg-blue-50 text-blue-700 border-blue-200
                    @elseif($order->status == 'completed') bg-green-50 text-green-700 border-green-200
                    @elseif($order->status == 'cancelled') bg-red-50 text-red-700 border-red-200
                    @endif">
                    {{ $order->status }}
                </span>
            </div>

            <div class="space-y-3">
                @if($order->status === 'pending')
                    <form action="{{ route('admin.orders.update', $order) }}" method="POST">
                        @csrf @method('PUT')
                        <input type="hidden" name="status" value="confirmed">
                        <button type="submit" class="w-full px-4 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 font-medium transition shadow-sm flex justify-center items-center gap-2">
                            <i class="fa-solid fa-check"></i> Xác nhận đơn hàng
                        </button>
                    </form>
                @elseif($order->status === 'confirmed')
                    <form action="{{ route('admin.orders.update', $order) }}" method="POST">
                        @csrf @method('PUT')
                        <input type="hidden" name="status" value="shipping">
                        <button type="submit" class="w-full px-4 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium transition shadow-sm flex justify-center items-center gap-2">
                            <i class="fa-solid fa-truck"></i> Giao hàng
                        </button>
                    </form>
                @elseif($order->status === 'shipping')
                    <form action="{{ route('admin.orders.update', $order) }}" method="POST">
                        @csrf @method('PUT')
                        <input type="hidden" name="status" value="completed">
                        <button type="submit" class="w-full px-4 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 font-medium transition shadow-sm flex justify-center items-center gap-2">
                            <i class="fa-solid fa-flag-checkered"></i> Hoàn thành đơn
                        </button>
                    </form>
                @elseif($order->status === 'completed')
                    <div class="w-full px-4 py-3 bg-gray-50 text-gray-500 border border-gray-100 rounded-lg text-center font-medium">
                        Đơn hàng đã hoàn tất
                    </div>
                @endif

                @if($order->status !== 'completed' && $order->status !== 'cancelled')
                    <form action="{{ route('admin.orders.update', $order) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này không?');">
                        @csrf @method('PUT')
                        <input type="hidden" name="status" value="cancelled">
                        <button type="submit" class="w-full px-4 py-3 bg-red-50 text-red-600 border border-red-100 rounded-lg hover:bg-red-100 font-medium transition flex justify-center items-center gap-2">
                            <i class="fa-solid fa-xmark"></i> Hủy đơn hàng
                        </button>
                    </form>
                @endif
            </div>
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
