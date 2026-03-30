<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
    {
        $totalOrders = Order::count();
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalRevenue = Order::where('status', '!=', 'cancelled')->sum('total_price');

        $recentOrders = Order::with('user')->orderBy('created_at', 'desc')->take(5)->get();

        return view('admin.dashboard', compact('totalOrders', 'totalProducts', 'totalCategories', 'totalRevenue', 'recentOrders'));
    }
}
