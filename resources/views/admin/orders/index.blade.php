@extends('layouts.admin')

@section('header', 'Orders')

@section('content')
<div class="mb-6">
    <h2 class="text-xl font-bold text-gray-800">Manage Orders</h2>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-gray-50 text-gray-600 text-sm uppercase">
                <tr>
                    <th class="px-6 py-3">Order ID</th>
                    <th class="px-6 py-3">Customer</th>
                    <th class="px-6 py-3">Date</th>
                    <th class="px-6 py-3">Total Amount</th>
                    <th class="px-6 py-3">Status</th>
                    <th class="px-6 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($orders as $order)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4 font-medium text-gray-900">#{{ $order->id }}</td>
                    <td class="px-6 py-4">
                        <div>{{ $order->user->name ?? 'Guest' }}</div>
                        <div class="text-xs text-gray-500">{{ $order->phone }}</div>
                    </td>
                    <td class="px-6 py-4 text-gray-500">{{ $order->created_at->format('M d, Y H:i') }}</td>
                    <td class="px-6 py-4 font-semibold">${{ number_format($order->total_price, 2) }}</td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 rounded-full text-xs font-medium 
                            @if($order->status == 'completed') bg-green-100 text-green-800 
                            @elseif($order->status == 'cancelled') bg-red-100 text-red-800 
                            @elseif($order->status == 'processing') bg-blue-100 text-blue-800
                            @else bg-yellow-100 text-yellow-800 @endif">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{ route('admin.orders.show', $order) }}" class="px-3 py-1 bg-blue-50 text-blue-600 hover:bg-blue-100 rounded text-sm transition">
                            View Details
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-gray-500">No orders found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($orders->hasPages())
    <div class="px-6 py-4 border-t border-gray-100">
        {{ $orders->links() }}
    </div>
    @endif
</div>
@endsection
