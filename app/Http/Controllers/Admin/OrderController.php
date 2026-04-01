<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->latest()->paginate(15);
        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load(['user', 'items.variant.product']);
        return view('admin.orders.show', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|string|in:' . implode(',', Order::getStatuses()),
        ]);

        $newStatus = $validated['status'];

        if (!$order->canTransitionTo($newStatus)) {
            $message = "Invalid status transition from '{$order->status}' to '{$newStatus}'.";
            if ($request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => $message
                ], 422);
            }
            return redirect()->back()->with('error', $message);
        }

        $order->update(['status' => $newStatus]);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Order status updated successfully.',
                'status' => $newStatus
            ]);
        }

        return redirect()->back()->with('success', 'Order status updated successfully.');
    }
}
