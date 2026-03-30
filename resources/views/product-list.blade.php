@extends('layouts.app')

@section('title', 'Curated Outfits & Products - Brutalist Gallery')

@section('content')
<main class="flex-grow pt-32 pb-20 px-8 max-w-[1440px] mx-auto w-full">
    <!-- Header Section -->
    <header class="mb-20 text-center">
        <h1 class="font-headline text-5xl md:text-7xl font-black uppercase tracking-tighter leading-none mb-6">
            CURATED OUTFITS <br/> <span class="text-outline">FOR YOU</span>
        </h1>
        <p class="font-body text-zinc-500 max-w-xl mx-auto text-lg uppercase tracking-widest">
            Our algorithm analyzes current street trends and editorial precision to select your next silhouette.
        </p>
    </header>

    <!-- Filter Selection Area -->
    <section class="mb-24 space-y-12">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-16 border-y border-outline-variant/20 py-12">
            <!-- Occasion Selection -->
            <div>
                <h3 class="font-headline text-xs font-bold uppercase tracking-[0.3em] text-zinc-500 mb-8">SELECT OCCASION</h3>
                <div class="flex flex-wrap gap-4">
                    <button class="px-8 py-4 bg-primary text-on-primary font-headline font-bold uppercase tracking-tighter transition-transform active:scale-95">Street</button>
                    <button class="px-8 py-4 border border-outline-variant/20 hover:border-primary/50 text-white font-headline font-bold uppercase tracking-tighter transition-all">Casual</button>
                    <button class="px-8 py-4 border border-outline-variant/20 hover:border-primary/50 text-white font-headline font-bold uppercase tracking-tighter transition-all">Evening</button>
                </div>
            </div>

            <!-- Goal Selection -->
            <div>
                <h3 class="font-headline text-xs font-bold uppercase tracking-[0.3em] text-zinc-500 mb-8">CHOOSE YOUR VIBE</h3>
                <div class="flex flex-wrap gap-4">
                    <button class="px-8 py-4 border border-outline-variant/20 hover:border-primary/50 text-white font-headline font-bold uppercase tracking-tighter transition-all">Minimalist</button>
                    <button class="px-8 py-4 border border-outline-variant/20 hover:border-primary/50 text-white font-headline font-bold uppercase tracking-tighter transition-all">Bold</button>
                    <button class="px-8 py-4 border border-outline-variant/20 hover:border-primary/50 text-white font-headline font-bold uppercase tracking-tighter transition-all">Layered</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Product Grid replacing Suggested Outfit Cards to make it a generic product list -->
    <section>
        <div class="flex items-end justify-between border-b border-surface-container-high pb-4 mb-8">
            <h2 class="text-primary text-3xl font-bold tracking-tight uppercase font-headline">All Products</h2>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @if(isset($products) && count($products) > 0)
                @foreach($products as $product)
                    <x-product-card :product="$product" />
                @endforeach
            @else
                <p class="col-span-4 text-center text-zinc-500 py-10">No products available at the moment.</p>
            @endif
        </div>
    </section>

</main>
@endsection
