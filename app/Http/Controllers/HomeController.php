<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $featuredProducts = Product::with('images')->where('is_active', true)->take(8)->get();
        return view('home', compact('categories', 'featuredProducts'));
    }
}
