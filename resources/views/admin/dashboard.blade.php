@extends('layouts.admin')

@section('header', 'Dashboard Overview')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Stat Card 1 -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex items-center">
        <div class="w-14 h-14 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 mr-4">
            <i class="fa-solid fa-shopping-cart text-2xl"></i>
        </div>
        <div>
            <p class="text-sm text-gray-500 font-medium">Total Orders</p>
            <h3 class="text-2xl font-bold text-gray-800">{{ $totalOrders }}</h3>
        </div>
    </div>

    <!-- Stat Card 2 -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex items-center">
        <div class="w-14 h-14 rounded-full bg-green-100 flex items-center justify-center text-green-600 mr-4">
            <i class="fa-solid fa-dollar-sign text-2xl"></i>
        </div>
        <div>
            <p class="text-sm text-gray-500 font-medium">Total Revenue</p>
            <h3 class="text-2xl font-bold text-gray-800">${{ number_format($totalRevenue, 2) }}</h3>
        </div>
    </div>

    <!-- Stat Card 3 -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex items-center">
        <div class="w-14 h-14 rounded-full bg-purple-100 flex items-center justify-center text-purple-600 mr-4">
            <i class="fa-solid fa-box-open text-2xl"></i>
        </div>
        <div>
            <p class="text-sm text-gray-500 font-medium">Total Products</p>
            <h3 class="text-2xl font-bold text-gray-800">{{ $totalProducts }}</h3>
        </div>
    </div>

    <!-- Stat Card 4 -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex items-center">
        <div class="w-14 h-14 rounded-full bg-orange-100 flex items-center justify-center text-orange-600 mr-4">
            <i class="fa-solid fa-tags text-2xl"></i>
        </div>
        <div>
            <p class="text-sm text-gray-500 font-medium">Categories</p>
            <h3 class="text-2xl font-bold text-gray-800">{{ $totalCategories }}</h3>
        </div>
    </div>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
        <h3 class="text-lg font-bold text-gray-800">Recent Orders</h3>
        <a href="{{ route('admin.orders.index') }}" class="text-sm text-blue-600 hover:text-blue-800">View All</a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-gray-50 text-gray-600 text-sm uppercase">
                <tr>
                    <th class="px-6 py-3">Order ID</th>
                    <th class="px-6 py-3">Customer</th>
                    <th class="px-6 py-3">Date</th>
                    <th class="px-6 py-3">Amount</th>
                    <th class="px-6 py-3">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($recentOrders as $order)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4 font-medium text-gray-900">#{{ $order->id }}</td>
                    <td class="px-6 py-4">{{ $order->user->name ?? 'Guest' }}</td>
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
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-gray-500">No recent orders found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
