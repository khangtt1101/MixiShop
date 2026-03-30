<?php

namespace App\Http\Controllers;

use App\Models\ProductVariant;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display the cart page.
     */
    public function viewCart()
    {
        $cart = session()->get('cart', []);
        
        $variantIds = array_keys($cart);
        $variants = ProductVariant::with('product')->whereIn('id', $variantIds)->get()->keyBy('id');
        
        $total = 0;
        $cartUpdated = false;

        foreach ($cart as $variantId => $item) {
            // Check if variant or its associated product still exists
            if (!isset($variants[$variantId]) || !$variants[$variantId]->product) {
                unset($cart[$variantId]);
                $cartUpdated = true;
                continue;
            }

            // Robust price calculation
            $price = (float) $variants[$variantId]->product->price;
            $quantity = (int) $item['quantity'];
            $total += $price * $quantity;
        }

        // Sync session if stale items were removed
        if ($cartUpdated) {
            session()->put('cart', $cart);
        }

        return view('cart', compact('cart', 'variants', 'total'));
    }

    /**
     * Add an item to the cart.
     */
    public function addToCart(Request $request)
    {
        $request->validate([
            'variant_id' => 'required|exists:product_variants,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $variantId = $request->input('variant_id');
        $quantityToAdd = (int) $request->input('quantity');

        $variant = ProductVariant::findOrFail($variantId);
        $cart = session()->get('cart', []);

        $currentQuantity = $cart[$variantId]['quantity'] ?? 0;
        $newQuantity = $currentQuantity + $quantityToAdd;

        // Check stock
        if ($newQuantity > $variant->stock_quantity) {
            return back()->with('error', "Cannot add {$quantityToAdd} items. Only {$variant->stock_quantity} in stock.");
        }

        // Add or update cart
        $cart[$variantId] = [
            'variant_id' => $variantId,
            'quantity' => $newQuantity
        ];

        session()->put('cart', $cart);

        return back()->with('success', 'Item added to cart.');
    }

    /**
     * Update an item's quantity in the cart.
     */
    public function updateCart(Request $request)
    {
        // Change min validation to 0 so we can process removal logic
        $request->validate([
            'variant_id' => 'required|exists:product_variants,id',
            'quantity' => 'required|integer|min:0'
        ]);

        $variantId = $request->input('variant_id');
        $quantity = (int) $request->input('quantity');
        
        $cart = session()->get('cart', []);

        if (!isset($cart[$variantId])) {
            return back()->with('error', 'Item not found in cart.');
        }

        // Remove item if quantity is 0
        if ($quantity <= 0) {
            unset($cart[$variantId]);
            session()->put('cart', $cart);
            return back()->with('success', 'Item removed from cart.');
        }

        $variant = ProductVariant::findOrFail($variantId);

        // Check stock constraints
        if ($quantity > $variant->stock_quantity) {
            return back()->with('error', "Only {$variant->stock_quantity} in stock.");
        }

        $cart[$variantId]['quantity'] = $quantity;
        session()->put('cart', $cart);

        return back()->with('success', 'Cart updated successfully.');
    }

    /**
     * Remove an item from the cart.
     */
    public function removeFromCart(Request $request)
    {
        $request->validate([
            'variant_id' => 'required'
        ]);

        $variantId = $request->input('variant_id');
        $cart = session()->get('cart', []);

        if (isset($cart[$variantId])) {
            unset($cart[$variantId]);
            session()->put('cart', $cart);
            return back()->with('success', 'Item removed from cart.');
        }

        return back()->with('error', 'Item not found in cart.');
    }
}
