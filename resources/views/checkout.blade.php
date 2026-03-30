@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-5xl">
    <h1 class="text-3xl font-bold mb-8 text-gray-800 tracking-tight">Checkout</h1>

    @if(session('error'))
        <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
            <p>{{ session('error') }}</p>
        </div>
    @endif

    <div class="flex flex-col md:flex-row gap-8">
        
        <!-- Form Section -->
        <div class="w-full md:w-2/3 bg-white shadow-xl rounded-2xl p-6 md:p-8 border border-gray-100">
            <h2 class="text-xl font-semibold mb-6 text-gray-800 border-b pb-4">Shipping & Contact Details</h2>
            
            <form action="{{ route('checkout.process') }}" method="POST" id="checkout-form">
                @csrf
                
                <div class="mb-6">
                    <label for="shipping_address" class="block text-sm font-medium text-gray-700 mb-2">Shipping Address</label>
                    <textarea 
                        name="shipping_address" 
                        id="shipping_address" 
                        rows="3" 
                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-3 border transition duration-150 @error('shipping_address') border-red-500 @enderror" 
                        required
                        placeholder="123 Example St, City, State, ZIP">{{ old('shipping_address') }}</textarea>
                    @error('shipping_address')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-8">
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                    <input 
                        type="text" 
                        name="phone" 
                        id="phone" 
                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-3 border transition duration-150 @error('phone') border-red-500 @enderror" 
                        value="{{ old('phone') }}" 
                        required
                        placeholder="+1 (555) 000-0000">
                    @error('phone')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="flex items-center justify-end mt-4 pt-4 border-t">
                    <a href="{{ route('cart.index') }}" class="text-sm text-indigo-600 hover:text-indigo-900 mr-4 font-medium transition duration-150">Return to Cart</a>
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 px-8 rounded-lg shadow-md hover:shadow-lg transition duration-200 transform hover:-translate-y-0.5 w-full sm:w-auto flex justify-center items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                        </svg>
                        Place Order securely
                    </button>
                </div>
            </form>
        </div>

        <!-- Order Summary Section -->
        <div class="w-full md:w-1/3">
            <div class="bg-gray-50 rounded-2xl p-6 shadow-md border border-gray-100 sticky top-8">
                <h2 class="text-lg font-semibold mb-4 text-gray-800">Order Summary</h2>
                
                <div class="divide-y divide-gray-200 mb-4 h-64 overflow-y-auto pr-2 custom-scrollbar">
                    @foreach($cart as $variantId => $item)
                        @if(isset($variants[$variantId]))
                            @php
                                $variant = $variants[$variantId];
                                $price = $variant->product->price ?? 0;
                            @endphp
                            <div class="py-4 flex justify-between items-center group">
                                <div class="flex flex-col">
                                    <span class="text-sm font-medium text-gray-900 group-hover:text-indigo-600 transition duration-150">{{ $variant->product->name }}</span>
                                    <span class="text-xs text-gray-500 mt-1">
                                        Qty: <span class="font-semibold text-gray-700">{{ $item['quantity'] }}</span> 
                                        @if($variant->size) | Size: {{ $variant->size }} @endif
                                        @if($variant->color) | Color: {{ $variant->color }} @endif
                                    </span>
                                </div>
                                <span class="text-sm font-semibold text-gray-900">${{ number_format($price * $item['quantity'], 2) }}</span>
                            </div>
                        @endif
                    @endforeach
                </div>
                
                <div class="border-t border-gray-200 pt-4 mt-4">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-sm text-gray-600">Subtotal</span>
                        <span class="text-sm font-medium text-gray-900">${{ number_format($total, 2) }}</span>
                    </div>
                    <!-- Shipping is free for this example -->
                    <div class="flex justify-between items-center mb-4 pb-4 border-b border-gray-200">
                        <span class="text-sm text-gray-600">Shipping</span>
                        <span class="text-sm font-medium text-green-600">Free</span>
                    </div>
                    
                    <div class="flex justify-between items-center">
                        <span class="text-base font-bold text-gray-900">Total</span>
                        <span class="text-xl font-bold text-indigo-600">${{ number_format($total, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>

<style>
/* Custom Scrollbar for summary list */
.custom-scrollbar::-webkit-scrollbar {
  width: 6px;
}
.custom-scrollbar::-webkit-scrollbar-track {
  background: transparent;
}
.custom-scrollbar::-webkit-scrollbar-thumb {
  background-color: #cbd5e1;
  border-radius: 20px;
}
</style>
@endsection
