<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductVariantController extends Controller
{
    public function index(Product $product)
    {
        $variants = $product->variants()->latest()->paginate(15);
        return view('admin.variants.index', compact('product', 'variants'));
    }

    public function create(Product $product)
    {
        return view('admin.variants.create', compact('product'));
    }

    public function store(Request $request, Product $product)
    {
        $validated = $request->validate([
            'size' => [
                'required',
                'string',
                'max:50',
                Rule::unique('product_variants')->where(function ($query) use ($product, $request) {
                    return $query->where('product_id', $product->id)
                                 ->where('color', $request->color);
                })
            ],
            'color' => 'required|string|max:50',
            'stock_quantity' => 'required|integer|min:0',
        ], [
            'size.unique' => 'A variant with this size and color already exists for this product.'
        ]);

        $product->variants()->create($validated);

        return redirect()->route('admin.variants.index', $product)
            ->with('success', 'Variant added successfully.');
    }

    public function edit(Product $product, ProductVariant $variant)
    {
        return view('admin.variants.edit', compact('product', 'variant'));
    }

    public function update(Request $request, Product $product, ProductVariant $variant)
    {
        $validated = $request->validate([
            'size' => [
                'required',
                'string',
                'max:50',
                Rule::unique('product_variants')->where(function ($query) use ($product, $request) {
                    return $query->where('product_id', $product->id)
                                 ->where('color', $request->color);
                })->ignore($variant->id)
            ],
            'color' => 'required|string|max:50',
            'stock_quantity' => 'required|integer|min:0',
        ], [
            'size.unique' => 'A variant with this size and color already exists for this product.'
        ]);

        $variant->update($validated);

        return redirect()->route('admin.variants.index', $product)
            ->with('success', 'Variant updated successfully.');
    }

    public function destroy(Product $product, ProductVariant $variant)
    {
        $variant->delete();

        return redirect()->route('admin.variants.index', $product)
            ->with('success', 'Variant deleted successfully.');
    }
}
