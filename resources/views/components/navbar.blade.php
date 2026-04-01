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
        @auth
            @if(auth()->user()->is_admin)
                <a href="{{ route('admin.dashboard') }}" class="text-zinc-400 hover:text-white font-headline text-sm font-bold uppercase tracking-wider transition-colors">Admin</a>
            @endif
            <span class="text-zinc-500 font-headline text-sm font-bold tracking-wider">{{ auth()->user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="text-zinc-400 hover:text-white font-headline text-sm font-bold uppercase tracking-wider transition-colors">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="text-zinc-400 hover:text-white font-headline text-sm font-bold uppercase tracking-wider transition-colors">Login</a>
            <a href="{{ route('register') }}" class="text-zinc-400 hover:text-white font-headline text-sm font-bold uppercase tracking-wider transition-colors">Register</a>
        @endauth
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
