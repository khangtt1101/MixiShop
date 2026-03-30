@extends('layouts.app')

@section('title', 'Your Bag - Brutalist Gallery')

@section('content')
<main class="pt-32 pb-24 px-6 md:px-12 lg:px-20 max-w-[1600px] mx-auto min-h-screen">
    <!-- Header -->
    <header class="mb-16">
        <h1 class="font-headline text-5xl md:text-7xl font-black tracking-tighter uppercase mb-4">
            YOUR BAG 
            @if(isset($cart) && count($cart) > 0)
                [{{ str_pad(count($cart), 2, '0', STR_PAD_LEFT) }} ITEMS]
            @else
                [00 ITEMS]
            @endif
        </h1>
        <div class="h-1 w-24 bg-primary"></div>
    </header>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-start">
        <!-- Cart Items List -->
        <div class="lg:col-span-8 space-y-12">
            @if(isset($cart) && count($cart) > 0)
                @foreach($cart as $variantId => $item)
                    @php $variant = $variants[$variantId] ?? null; @endphp
                    @if($variant)
                    <!-- Item -->
                    <article class="group flex flex-col md:flex-row gap-8 pb-12 border-b border-outline-variant/20">
                        <div class="w-full md:w-64 aspect-[3/4] bg-surface-container-low overflow-hidden">
                            <img src="{{ $variant->product->images->first()->image_path ?? 'https://via.placeholder.com/300x400' }}" 
                                 alt="{{ $variant->product->name ?? 'Product' }}" 
                                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" />
                        </div>
                        <div class="flex-1 flex flex-col justify-between py-2">
                            <div class="space-y-4">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h2 class="font-headline text-2xl font-bold tracking-tight uppercase">{{ $variant->product->name }}</h2>
                                        <p class="font-label text-sm text-outline tracking-widest uppercase">{{ $variant->product->category->name ?? 'ARCHIVE' }}</p>
                                    </div>
                                    <span class="font-headline text-2xl font-medium">${{ number_format($variant->product->price, 2) }}</span>
                                </div>
                                <div class="flex items-center gap-4 pt-2">
                                    <span class="text-xs uppercase tracking-widest text-outline">Size:</span>
                                    <span class="text-sm font-bold border border-outline-variant/40 px-3 py-1">{{ $variant->size }}</span>
                                    <span class="text-xs uppercase tracking-widest text-outline ml-2">Color:</span>
                                    <span class="text-sm font-bold border border-outline-variant/40 px-3 py-1">{{ $variant->color }}</span>
                                </div>
                            </div>
                            
                            <div class="flex items-center justify-between mt-8 md:mt-0">
                                <form action="{{ route('cart.update') }}" method="POST" class="flex items-center border border-outline-variant/30">
                                    @csrf
                                    <input type="hidden" name="variant_id" value="{{ $variantId }}">
                                    <button type="submit" name="quantity" value="{{ $item['quantity'] - 1 }}" 
                                            class="px-4 py-2 hover:bg-surface-container-high transition-colors material-symbols-outlined" 
                                            {{ $item['quantity'] <= 1 ? 'disabled' : '' }}>remove</button>
                                    <span class="px-6 font-headline font-bold">{{ str_pad($item['quantity'], 2, '0', STR_PAD_LEFT) }}</span>
                                    <button type="submit" name="quantity" value="{{ $item['quantity'] + 1 }}" 
                                            class="px-4 py-2 hover:bg-surface-container-high transition-colors material-symbols-outlined">add</button>
                                </form>
                                <form action="{{ route('cart.remove') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="variant_id" value="{{ $variantId }}">
                                    <button type="submit" class="font-headline text-xs uppercase tracking-[0.2em] underline underline-offset-8 text-outline hover:text-primary transition-colors">REMOVE</button>
                                </form>
                            </div>
                        </div>
                    </article>
                    @endif
                @endforeach
            @else
                <div class="py-12 border-b border-outline-variant/20 text-center">
                    <p class="font-headline text-xl text-zinc-500 uppercase tracking-widest mb-6">Your bag is currently empty.</p>
                    <a href="/products" class="inline-block bg-primary text-on-primary py-4 px-8 font-headline font-bold uppercase tracking-widest hover:bg-primary/90 transition-all">
                        Discover Archive
                    </a>
                </div>
            @endif
        </div>

        <!-- Summary Section -->
        <aside class="lg:col-span-4 sticky top-32">
            <div class="bg-surface-container-low p-10">
                <h3 class="font-headline text-xl font-bold tracking-tight uppercase mb-8">Order Summary</h3>
                <div class="space-y-6 mb-12">
                    <div class="flex justify-between items-center">
                        <span class="text-outline uppercase text-xs tracking-widest">Subtotal</span>
                        <span class="font-headline font-medium text-lg">${{ number_format($total ?? 0, 2) }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-outline uppercase text-xs tracking-widest">Shipping</span>
                        <span class="text-outline uppercase text-[10px] tracking-[0.15em] text-right">Calculated at Checkout</span>
                    </div>
                    <div class="h-px bg-outline-variant/20 pt-4"></div>
                    <div class="flex justify-between items-end pt-4">
                        <span class="font-headline font-bold uppercase text-lg tracking-widest">Total</span>
                        <span class="font-headline font-black text-3xl tracking-tighter">${{ number_format($total ?? 0, 2) }}</span>
                    </div>
                </div>
                
                <div class="space-y-6">
                    <a href="/checkout" class="block text-center w-full bg-primary text-on-primary py-6 px-4 font-headline font-bold uppercase tracking-widest hover:bg-primary/90 transition-all active:scale-[0.98]">
                        Proceed to Checkout
                    </a>
                    <div class="bg-surface-bright/20 p-4 border-l-2 border-primary">
                        <p class="text-[10px] font-bold uppercase tracking-[0.2em] text-on-surface">FREE SHIPPING ON ORDERS OVER $200</p>
                    </div>
                </div>
                
                <div class="mt-12 space-y-4">
                    <p class="text-[10px] text-outline leading-relaxed uppercase tracking-widest">
                        Secure checkout with encrypted data protection. Returns accepted within 14 days of delivery for archive items.
                    </p>
                    <div class="flex gap-4 opacity-40">
                        <span class="material-symbols-outlined" data-icon="lock">lock</span>
                        <span class="material-symbols-outlined" data-icon="verified_user">verified_user</span>
                        <span class="material-symbols-outlined" data-icon="local_shipping">local_shipping</span>
                    </div>
                </div>
            </div>
        </aside>
    </div>
</main>
@endsection
