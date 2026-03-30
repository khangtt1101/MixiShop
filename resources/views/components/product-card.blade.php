@props(['product'])

<div class="group flex flex-col gap-4">
    <div class="relative w-full aspect-[3/4] bg-surface-container-lowest overflow-hidden">
        @php
            $thumb = $product->thumbnail ?? 'https://via.placeholder.com/300x400';
        @endphp
        <div class="w-full h-full bg-center bg-cover transition-transform duration-700 group-hover:scale-105" 
             style="background-image: url('{{ $thumb }}');">
        </div>
        <!-- Quick Add Overlay (Glassmorphism) -->
        <div class="absolute inset-x-0 bottom-0 p-4 translate-y-full group-hover:translate-y-0 transition-transform duration-300">
            <div class="bg-surface/80 backdrop-blur-md p-4 border border-outline-variant/30">
                <p class="text-xs font-bold text-on-surface-variant mb-2 uppercase tracking-wider text-center">Select Size</p>
                <div class="flex justify-between gap-2">
                    <a href="{{ route('products.show', $product->slug) }}" class="flex-1 text-center py-2 text-xs font-bold bg-surface-container hover:bg-primary hover:text-on-primary transition-colors border border-outline-variant/50 block">S</a>
                    <a href="{{ route('products.show', $product->slug) }}" class="flex-1 text-center py-2 text-xs font-bold bg-surface-container hover:bg-primary hover:text-on-primary transition-colors border border-outline-variant/50 block">M</a>
                    <a href="{{ route('products.show', $product->slug) }}" class="flex-1 text-center py-2 text-xs font-bold bg-surface-container hover:bg-primary hover:text-on-primary transition-colors border border-outline-variant/50 block">L</a>
                    <a href="{{ route('products.show', $product->slug) }}" class="flex-1 text-center py-2 text-xs font-bold bg-surface-container hover:bg-primary hover:text-on-primary transition-colors border border-outline-variant/50 block">XL</a>
                </div>
            </div>
        </div>
    </div>
    <div class="flex flex-col">
        <a href="{{ route('products.show', $product->slug) }}" class="hover:underline">
            <h3 class="text-primary text-base font-medium font-body uppercase truncate">{{ $product->name }}</h3>
        </a>
        <p class="text-on-surface-variant text-sm font-medium mt-1">${{ number_format($product->price ?? 0, 2) }}</p>    </div>
</div>
