<nav class="fixed top-0 w-full z-50 rounded-none bg-black/70 backdrop-blur-2xl flex justify-between items-center px-8 h-20 max-w-none">
    <div class="flex items-center gap-12">
        <a href="/" class="text-2xl font-black tracking-tighter text-white font-headline">BRUTALIST GALLERY</a>
        <div class="hidden md:flex gap-8 items-center">
            <a href="/products" class="font-headline uppercase tracking-tighter font-bold text-zinc-500 hover:text-white transition-colors">T-Shirts</a>
            <a href="/products" class="font-headline uppercase tracking-tighter font-bold text-zinc-500 hover:text-white transition-colors">Hoodies</a>
            <a href="/products" class="font-headline uppercase tracking-tighter font-bold text-zinc-500 hover:text-white transition-colors">Pants</a>
        </div>
    </div>
    <div class="flex items-center gap-6">
        <a href="{{ route('cart.index') }}" class="relative text-white hover:opacity-80 transition-opacity flex items-center justify-center">
            <span class="material-symbols-outlined" data-icon="shopping_bag">shopping_bag</span>
            @php $cartCount = collect(session('cart'))->sum('quantity'); @endphp
            @if($cartCount > 0)
                <span class="absolute -top-2 -right-2 bg-white text-black text-[10px] font-bold px-1.5 py-0.5 rounded-full">{{ $cartCount }}</span>
            @endif
        </a>
        <button class="md:hidden material-symbols-outlined text-white" data-icon="menu">menu</button>
    </div>
</nav>
