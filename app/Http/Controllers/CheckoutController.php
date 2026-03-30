<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    /**
     * Display the checkout page.
     */
    public function index()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $variantIds = array_keys($cart);
        $variants = ProductVariant::with('product')->whereIn('id', $variantIds)->get()->keyBy('id');

        $total = 0;

        foreach ($cart as $variantId => $item) {
            if (isset($variants[$variantId]) && $variants[$variantId]->product) {
                $price = (float) $variants[$variantId]->product->price;
                $quantity = (int) $item['quantity'];
                $total += $price * $quantity;
            }
        }

        return view('checkout', compact('cart', 'variants', 'total'));
    }

    /**
     * Process the checkout.
     */
    public function process(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $request->validate([
            'shipping_address' => 'required|string|max:1000',
            'phone' => 'required|string|max:20',
        ]);

        try {
            DB::beginTransaction();

            $variantIds = array_keys($cart);
            
            // Fetch variants with lockForUpdate to prevent race conditions on stock check
            $variants = ProductVariant::with('product')->whereIn('id', $variantIds)->lockForUpdate()->get()->keyBy('id');

            $totalPrice = 0;
            $itemsData = [];

            // 1. Validate stock and calculate total price
            foreach ($cart as $variantId => $item) {
                if (!isset($variants[$variantId]) || !$variants[$variantId]->product) {
                    throw new \Exception('Some products are no longer available.');
                }

                $variant = $variants[$variantId];
                $quantity = (int) $item['quantity'];

                if ($quantity > $variant->stock_quantity) {
                    throw new \Exception("Insufficient stock for product '{$variant->product->name}'. Only {$variant->stock_quantity} available.");
                }

                $price = (float) $variant->product->price;
                $totalPrice += $price * $quantity;

                $itemsData[] = [
                    'variant' => $variant,
                    'quantity' => $quantity,
                    'price' => $price,
                ];
            }

            // 2. Create the Order
            $order = Order::create([
                'user_id' => Auth::id(), // Will be null for guests
                'total_price' => $totalPrice,
                'status' => 'pending',
                'shipping_address' => $request->input('shipping_address'),
                'phone' => $request->input('phone'),
            ]);

                // 3. Create OrderItems and decrement stock
            foreach ($itemsData as $data) {
                /** @var \App\Models\ProductVariant $variant */
                $variant = $data['variant'];
                $quantity = $data['quantity'];

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $variant->product_id,
                    'product_variant_id' => $variant->id,
                    'quantity' => $quantity,
                    'price' => $data['price'],
                ]);

                // Reduce stock quantity
                $variant->stock_quantity -= $quantity;
                $variant->save();
            }

            // 4. Clear the cart
            session()->forget('cart');

            DB::commit();

            return redirect()->route('home')->with('success', 'Checkout successful! Order #'.$order->id.' has been placed.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Checkout failed: ' . $e->getMessage());
        }
    }
}
