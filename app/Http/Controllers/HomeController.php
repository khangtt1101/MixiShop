<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::where('is_active', true)->get();
        $featuredProducts = Product::with('images')
            ->where('is_active', true)
            ->whereHas('category', function($q) {
                $q->where('is_active', true);
            })
            ->take(8)->get();
        return view('home', compact('categories', 'featuredProducts'));
    }
}
