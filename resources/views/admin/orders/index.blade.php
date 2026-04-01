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
                    <td class="px-6 py-4">
                        <span id="status-badge-{{ $order->id }}" class="px-3 py-1 rounded-full text-xs font-medium inline-block text-center
                            @if($order->status == 'pending') bg-yellow-100 text-yellow-800
                            @elseif($order->status == 'confirmed') bg-purple-100 text-purple-800
                            @elseif($order->status == 'shipping') bg-blue-100 text-blue-800
                            @elseif($order->status == 'completed') bg-green-100 text-green-800
                            @elseif($order->status == 'cancelled') bg-red-100 text-red-800
                            @endif">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex flex-wrap items-center justify-end gap-2" id="action-buttons-{{ $order->id }}">
                            <a href="{{ route('admin.orders.show', $order) }}" class="px-3 py-1 bg-gray-50 text-gray-600 border border-gray-200 hover:bg-gray-100 rounded text-sm transition">
                                <i class="fa-solid fa-eye"></i> View
                            </a>
                            
                            @if($order->status === 'pending')
                                <button onclick="updateOrderStatus({{ $order->id }}, 'confirmed', this)" class="px-3 py-1 bg-purple-600 text-white hover:bg-purple-700 rounded text-sm transition shadow-sm">
                                    <i class="fa-solid fa-check"></i> Xác nhận đơn
                                </button>
                            @elseif($order->status === 'confirmed')
                                <button onclick="updateOrderStatus({{ $order->id }}, 'shipping', this)" class="px-3 py-1 bg-blue-600 text-white hover:bg-blue-700 rounded text-sm transition shadow-sm">
                                    <i class="fa-solid fa-truck"></i> Giao hàng
                                </button>
                            @elseif($order->status === 'shipping')
                                <button onclick="updateOrderStatus({{ $order->id }}, 'completed', this)" class="px-3 py-1 bg-green-600 text-white hover:bg-green-700 rounded text-sm transition shadow-sm">
                                    <i class="fa-solid fa-flag-checkered"></i> Hoàn thành
                                </button>
                            @endif

                            @if($order->status !== 'completed' && $order->status !== 'cancelled')
                                <button onclick="if(confirm('Bạn có chắc chắn muốn hủy đơn hàng này không?')) updateOrderStatus({{ $order->id }}, 'cancelled', this)" class="px-3 py-1 bg-red-50 text-red-600 hover:bg-red-100 border border-red-100 rounded text-sm transition">
                                    <i class="fa-solid fa-xmark"></i> Hủy đơn
                                </button>
                            @endif
                        </div>
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

@push('scripts')
<script>
    function updateOrderStatus(orderId, newStatus, buttonElement) {
        if (!buttonElement) return;
        
        const originalHtml = buttonElement.innerHTML;
        buttonElement.disabled = true;
        buttonElement.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> ...';
        buttonElement.classList.add('opacity-75');

        fetch(`/admin/orders/${orderId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                _method: 'PUT',
                status: newStatus
            })
        })
        .then(async response => {
            const data = await response.json();
            if (!response.ok) {
                throw new Error(data.message || 'Network response was not ok');
            }
            return data;
        })
        .then(data => {
            if (data.success) {
                // Update badge
                const badge = document.getElementById(`status-badge-${orderId}`);
                if (badge) {
                    const colorMap = {
                        'pending': 'bg-yellow-100 text-yellow-800',
                        'confirmed': 'bg-purple-100 text-purple-800',
                        'shipping': 'bg-blue-100 text-blue-800',
                        'completed': 'bg-green-100 text-green-800',
                        'cancelled': 'bg-red-100 text-red-800'
                    };
                    badge.className = `px-3 py-1 rounded-full text-xs font-medium inline-block text-center ${colorMap[data.status]}`;
                    badge.textContent = data.status.charAt(0).toUpperCase() + data.status.slice(1);
                }

                // Update Action Buttons Container
                const container = document.getElementById(`action-buttons-${orderId}`);
                if (container) {
                    let buttonsHtml = `<a href="/admin/orders/${orderId}" class="px-3 py-1 bg-gray-50 text-gray-600 border border-gray-200 hover:bg-gray-100 rounded text-sm transition"><i class="fa-solid fa-eye"></i> View</a>`;
                    
                    if (data.status === 'pending') {
                        buttonsHtml += ` <button onclick="updateOrderStatus(${orderId}, 'confirmed', this)" class="px-3 py-1 bg-purple-600 text-white hover:bg-purple-700 rounded text-sm transition shadow-sm"><i class="fa-solid fa-check"></i> Xác nhận đơn</button>`;
                    } else if (data.status === 'confirmed') {
                        buttonsHtml += ` <button onclick="updateOrderStatus(${orderId}, 'shipping', this)" class="px-3 py-1 bg-blue-600 text-white hover:bg-blue-700 rounded text-sm transition shadow-sm"><i class="fa-solid fa-truck"></i> Giao hàng</button>`;
                    } else if (data.status === 'shipping') {
                        buttonsHtml += ` <button onclick="updateOrderStatus(${orderId}, 'completed', this)" class="px-3 py-1 bg-green-600 text-white hover:bg-green-700 rounded text-sm transition shadow-sm"><i class="fa-solid fa-flag-checkered"></i> Hoàn thành</button>`;
                    }

                    if (data.status !== 'completed' && data.status !== 'cancelled') {
                        buttonsHtml += ` <button onclick="if(confirm('Bạn có chắc chắn muốn hủy đơn hàng này không?')) updateOrderStatus(${orderId}, 'cancelled', this)" class="px-3 py-1 bg-red-50 text-red-600 hover:bg-red-100 border border-red-100 rounded text-sm transition"><i class="fa-solid fa-xmark"></i> Hủy đơn</button>`;
                    }
                    
                    container.innerHTML = buttonsHtml;
                }

                showToast('Status updated successfully!', 'success');
            }
        })
        .catch(error => {
            console.error('Error updating status:', error);
            buttonElement.disabled = false;
            buttonElement.innerHTML = originalHtml;
            buttonElement.classList.remove('opacity-75');
            showToast(error.message || 'Failed to update status.', 'error');
        });
    }

    function showToast(message, type = 'success') {
        const toast = document.createElement('div');
        toast.className = `fixed bottom-4 right-4 px-6 py-3 rounded-lg shadow-lg text-white font-medium transition-opacity duration-300 z-50 ${type === 'success' ? 'bg-green-500' : 'bg-red-500'}`;
        toast.textContent = message;
        
        document.body.appendChild(toast);
        
        setTimeout(() => toast.classList.add('opacity-0'), 2500);
        setTimeout(() => toast.remove(), 2800);
    }
</script>
@endpush
