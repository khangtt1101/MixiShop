@extends('layouts.app')

@section('title', 'Product Detail - Brutalist Gallery')

@section('content')
<main class="flex-grow pt-24 pb-20 max-w-[1440px] mx-auto w-full">
    <!-- Breadcrumbs -->
    <div class="px-8 py-6">
        <nav class="flex text-on-secondary-fixed-variant font-label text-sm uppercase tracking-widest gap-2">
            <a href="/" class="hover:text-primary transition-colors">Archive</a>
            <span>/</span>
            <a href="/products" class="hover:text-primary transition-colors">Outerwear</a>
            <span>/</span>
            <span class="text-primary font-bold">{{ $product->name ?? 'Raw Edge Hoodie' }}</span>
        </nav>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-0 min-h-[calc(100vh-160px)]">
        <!-- Left: High-End Product Gallery (Asymmetric Layout) -->
        <div class="lg:col-span-7 px-4 md:px-8 space-y-8 pb-12">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Hero Image -->
                <div class="md:col-span-2 aspect-[4/5] bg-surface-container-lowest overflow-hidden">
                    <img src="{{ $product->thumbnail ?? 'https://lh3.googleusercontent.com/aida-public/AB6AXuD_TNasqdQPJJ5Izl5Bt7Hgknw7vEGfeTeK7wcSPm_5Q1Dc68dF1mA9H3x-HlqqKiUyEBfwN7fT-i9UjIhyZcciNhcSuffqzKCowW3jyFcjmehEzCVzmkm3uT87MvckGL6RtKsITcpWjrRRdpZZHYB8EXH2EnA9D4dfjK2vKkXkr1pteH3rMGChiIa6dOzacA7YwU8GstgBI-PiK5UzRU6RW78atSvU8Bqwzo4tr04-oI2WhdSxeyq0O3CsB7H-r6WMtwvhv0PvRQQ' }}" 
                         alt="{{ $product->name ?? 'Front view of raw edge hoodie' }}" 
                         class="w-full h-full object-cover grayscale brightness-90 hover:grayscale-0 transition-all duration-700"/>
                </div>
                <!-- Detail 1 -->
                <div class="aspect-square bg-surface-container-low overflow-hidden">
                    <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuC6Exdh4BUcPRVSEW8aPy6z8PWgawdWbjTpqfwIL2xALAZdj7sDqf3vdPlaFzQYcOiiHR2cG4yc2I7CyueL7yKADR6_C2eiAnCus46G34XZvzq0ouKdWgzXKbI2-7c5sCiudYR6dwC0ivMHddaHoaUPdya61F4p5zeB60EyBHE_2Vizp6N2VEALvYdPLrYzBuwKNjz0uep0-Cl6nvtd_k3Jes65doI26d8FvBIhEmmbnqGo5tNkoqUDvf-UbGwGqSlVX9MRU9wqOAA" 
                         alt="Texture detail" 
                         class="w-full h-full object-cover grayscale brightness-90 hover:grayscale-0 transition-all duration-700"/>
                </div>
                <!-- Detail 2 -->
                <div class="aspect-square bg-surface-container-low overflow-hidden">
                    <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuBUr8Gylp1q5JBaMWzCm-RiIo6wFjRsfoFW8DMKvTj7beQNOvj2o5lbFRtANHC7t1sIalWkm59EokCcRxj9G_Y363pXFMSwKw9O1X4Sg-5lbDCPmy-piTQbMOG7oZYdoIq4SFpjV2W8gGhdvQN-kfYxxfthAQecl0NrdRDrtrUaNu3--9lyIuYL2q9WPTcCDxPkygnbZnI-Ds-t13GvWPLR4vJwCOEuhBD0q1IIRWKSVbFTo6vszbHD__D4t1YuWSlQpzRAPuZYXno" 
                         alt="Fit detail" 
                         class="w-full h-full object-cover grayscale brightness-90 hover:grayscale-0 transition-all duration-700"/>
                </div>
            </div>
        </div>

        <!-- Right: Product Info & Actions (Sticky) -->
        <div class="lg:col-span-5 px-8 lg:px-12 lg:sticky lg:top-32 h-fit pb-20">
            <header class="mb-12">
                <h1 class="font-headline text-5xl md:text-7xl font-black uppercase tracking-tighter leading-[0.9] mb-4 text-white">
                    {{ $product->name ?? "RAW EDGE\nDECONSTRUCTED" }}
                </h1>
                <div class="flex items-baseline justify-between border-b border-outline-variant/20 pb-6">
                    <span class="font-body text-2xl font-light text-zinc-400">ARCHIVE_012</span>
                    <span class="font-headline text-3xl font-bold text-white">${{ number_format($product->price ?? 245.00, 2) }}</span>
                </div>
            </header>

            <!-- Product Description -->
            <div class="mb-12 max-w-md">
                <p class="font-body text-on-surface-variant leading-relaxed mb-6">
                    {{ $product->description ?? 'Custom-milled 500GSM heavy loopback cotton. Featuring deconstructed raw seams, dropped shoulder silhouette, and architectural hood construction. Hand-finished in our London studio.' }}
                </p>
                <ul class="text-xs uppercase tracking-[0.2em] space-y-2 font-medium text-zinc-500">
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-primary rounded-full"></span> 100% Organic Heavyweight Cotton</li>
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-primary rounded-full"></span> Garment Dyed &amp; Pre-shrunk</li>
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-primary rounded-full"></span> Limited Edition: 1 of 100</li>
                </ul>
            </div>

            <!-- Variant Selector & Add to Bag -->
            <form action="{{ route('cart.add') }}" method="POST" class="flex flex-col gap-4">
                @csrf
                <div class="mb-10">
                    <div class="flex justify-between items-end mb-4">
                        <span class="font-label text-xs uppercase tracking-widest font-bold text-white">Select Variant</span>
                        <button type="button" class="text-[10px] uppercase tracking-widest text-zinc-500 underline underline-offset-4 hover:text-white transition-colors">Size Guide</button>
                    </div>
                    
                    <select name="variant_id" required class="w-full bg-transparent border border-outline-variant text-white font-headline font-bold py-4 px-4 uppercase transition-all mb-4 outline-none focus:border-white appearance-none">
                        <option value="" disabled selected class="bg-surface-container-highest text-zinc-400">Choose Size & Color</option>
                        @foreach($product->variants as $variant)
                            <option value="{{ $variant->id }}" class="bg-surface-container-highest text-white" {{ $variant->stock_quantity <= 0 ? 'disabled' : '' }}>
                                {{ $variant->size }} - {{ $variant->color }} 
                                @if($variant->stock_quantity <= 0) (OUT OF STOCK) @endif
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex h-16 border border-outline-variant/30">
                    <button type="button" class="w-16 flex items-center justify-center hover:bg-surface-container-high transition-colors" onclick="document.getElementById('quantity').stepDown()">
                        <span class="material-symbols-outlined text-sm" data-icon="remove">remove</span>
                    </button>
                    <input type="number" id="quantity" name="quantity" value="1" min="1" class="flex-grow flex items-center justify-center font-headline font-bold text-xl text-center bg-transparent border-none focus:ring-0 text-white">
                    <button type="button" class="w-16 flex items-center justify-center hover:bg-surface-container-high transition-colors" onclick="document.getElementById('quantity').stepUp()">
                        <span class="material-symbols-outlined text-sm" data-icon="add">add</span>
                    </button>
                </div>
                
                @if(session('error'))
                    <div class="text-red-500 text-sm font-bold mt-2 uppercase">{{ session('error') }}</div>
                @endif
                @if(session('success'))
                    <div class="text-green-500 text-sm font-bold mt-2 uppercase">{{ session('success') }}</div>
                @endif

                <button type="submit" class="h-16 bg-white text-black font-headline font-black text-lg uppercase tracking-widest hover:bg-zinc-200 transition-colors flex items-center justify-center gap-3 mt-4">
                    ADD TO CART
                    <span class="material-symbols-outlined" data-icon="arrow_forward">arrow_forward</span>
                </button>
                <button type="button" class="h-16 border border-outline-variant/30 text-white font-headline font-bold text-sm uppercase tracking-widest hover:bg-surface-container-low transition-colors">
                    ADD TO WISHLIST
                </button>
            </form>

            <!-- Details Accordion (Minimalist) -->
            <div class="mt-12 border-t border-outline-variant/20">
                <details class="group py-6 border-b border-outline-variant/20 cursor-pointer">
                    <summary class="flex justify-between items-center list-none font-headline uppercase font-bold text-sm tracking-widest">
                        SHIPPING &amp; RETURNS
                        <span class="material-symbols-outlined group-open:rotate-180 transition-transform" data-icon="expand_more">expand_more</span>
                    </summary>
                    <p class="mt-4 text-sm text-zinc-500 leading-relaxed font-body">
                        Complimentary worldwide shipping on orders over $500. Returns accepted within 14 days of delivery.
                    </p>
                </details>
                <details class="group py-6 border-b border-outline-variant/20 cursor-pointer">
                    <summary class="flex justify-between items-center list-none font-headline uppercase font-bold text-sm tracking-widest">
                        CARE INSTRUCTIONS
                        <span class="material-symbols-outlined group-open:rotate-180 transition-transform" data-icon="expand_more">expand_more</span>
                    </summary>
                    <p class="mt-4 text-sm text-zinc-500 leading-relaxed font-body">
                        Cold machine wash inside out. Do not tumble dry. Iron on reverse. Handled with precision.
                    </p>
                </details>
            </div>
        </div>
    </div>
</main>
@endsection
