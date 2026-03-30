@extends('layouts.app')

@section('title', 'Home - Brutalist Gallery')

@section('content')
<main class="flex-grow max-w-[1440px] mx-auto w-full px-4 sm:px-8 py-24 flex flex-col gap-24">
    <!-- Hero Section -->
    <section class="relative w-full h-[716px] min-h-[600px] bg-surface-container-lowest overflow-hidden flex items-center justify-center">
        <div class="absolute inset-0 z-0">
            <div class="w-full h-full bg-center bg-cover opacity-60" data-alt="Editorial shot of a model wearing dark, avant-garde streetwear in an industrial concrete setting, harsh directional lighting, desaturated tones" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuAQIbxzqeyT1_tJt_c1ZPfCOVG8rqp1qwxNCyE4cLjJhuFxr31CDeOMNR3M1FiuFsKiLvpbjxJ29QJcCnU1V04vnnrJTM0DtCU_96Dq1mlxsZFGFd74fwGJREb2N469kGnCJqEuMKLQy0COkk0bs9Yg16_PtOnIE_eeGsYtdQA2OSNIaKCSozWteC7ZWsy4iDBa_dlkD8iAODk6nOeD_HdsXn1niVvlMXowumHexnssTtjeedFSe9SNBVVZd6UsvlUH4L-UMyRBmME");'>
            </div>
            <div class="absolute inset-0 bg-gradient-to-t from-background via-transparent to-transparent"></div>
        </div>
        <div class="relative z-10 flex flex-col items-center text-center max-w-4xl px-4 mt-auto pb-24">
            <h1 class="text-primary text-[5rem] sm:text-[7rem] font-black leading-[0.85] tracking-tighter uppercase font-headline mb-6 drop-shadow-2xl">
                SYSTEM<br/>OVERRIDE
            </h1>
            <p class="text-on-surface text-lg sm:text-xl font-body max-w-2xl mb-10 opacity-90">
                The new collection redefines urban utility. Structural silhouettes forged in raw textiles.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="/products" class="bg-primary text-on-primary px-10 py-4 text-sm font-bold tracking-widest uppercase hover:opacity-90 transition-opacity">
                    Explore Collection
                </a>
                <a href="#lookbook" class="bg-transparent border border-outline-variant text-primary px-10 py-4 text-sm font-bold tracking-widest uppercase hover:bg-surface-container-low transition-colors">
                    View Lookbook
                </a>
            </div>
        </div>
    </section>

    <!-- Featured Products -->
    <section class="flex flex-col gap-12">
        <div class="flex items-end justify-between border-b border-surface-container-high pb-4">
            <h2 class="text-primary text-3xl font-bold tracking-tight uppercase font-headline">Latest Arrivals</h2>
            <a class="text-on-surface-variant hover:text-primary text-sm font-bold tracking-widest uppercase transition-colors flex items-center gap-2" href="/products">
                View All <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
            </a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @if(isset($featuredProducts) && count($featuredProducts) > 0)
                @foreach($featuredProducts as $product)
                    <x-product-card :product="$product" />
                @endforeach
            @else
                <p class="col-span-4 text-center text-zinc-500 py-10">No products available at the moment.</p>
            @endif
        </div>
    </section>

    <!-- Category Grid (Asymmetric) -->
    <section class="grid grid-cols-1 md:grid-cols-12 gap-6 h-auto md:h-[600px]">
        <!-- Main Category -->
        <a class="md:col-span-7 relative group overflow-hidden bg-surface-container-lowest h-[400px] md:h-full flex items-center justify-center" href="/products">
            <div class="absolute inset-0 bg-center bg-cover opacity-70 group-hover:opacity-100 transition-opacity duration-700 group-hover:scale-105" data-alt="Model wearing layered outerwear jackets in an urban setting, brutalist architecture background, desaturated tones" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuA24rR-Jcr5aCiTehvwSSFbxH4RUr0Ii5ACqVeAetqT3tMDDcqUexJXD9GKXypHcg14FsLsO1rEZW1irrKmob5PartIa3jHyewzTZqV2YwatUTlrSOcEurscBK_qwQGYt3rfCM8oa9bmf0pNxFxq6ivAGb1_-jEiLEuDcFdgar1tNIgAJCW8Xui--RFC7i67R57r_QZo2f08NKXidcJnHlgO58ffJmNBn6aWVJ1LNsnjoG1XYktzTDhUn77OQUqjoSUnwpHru28XC4");'>
            </div>
            <div class="absolute inset-0 bg-black/30"></div>
            <h3 class="relative z-10 text-primary text-5xl font-black uppercase font-headline tracking-tighter mix-blend-difference">Outerwear</h3>
        </a>
        <div class="md:col-span-5 flex flex-col gap-6">
            <!-- Sub Category 1 -->
            <a class="relative flex-1 group overflow-hidden bg-surface-container-lowest flex items-center justify-center min-h-[250px]" href="/products">
                <div class="absolute inset-0 bg-center bg-cover opacity-70 group-hover:opacity-100 transition-opacity duration-700 group-hover:scale-105" data-alt="Close up of a premium blank t-shirt folded neatly on dark concrete surface, showcasing texture" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuBh3xNcF1AOmyu4GChO_Amta84_BzH6siuaFf2fnmm5NmeMKH1Lwzsd1ZP4DC0mN34itOyi2PNZ_5HbVXouqgImG_JC7PEN9TIiIpyF2-rWdV8lmFJYH4M5BZXGIQVWmTbhcpZO5m7-1SGAOw2wFUa0bHH95zNCqo4uvrQ2JklnK7PLxwOMvZSjWHmvLBTV6ZScDgNsXE-7AQt67Xqnam3cdNin0vTBwtD0b_G1BfR7IsEEDL4A5BKq7BMiTOo5ST1KNfuJjxuXSjo");'>
                </div>
                <div class="absolute inset-0 bg-black/30"></div>
                <h3 class="relative z-10 text-primary text-3xl font-black uppercase font-headline tracking-tighter">Essentials</h3>
            </a>
            <!-- Sub Category 2 -->
            <a class="relative flex-1 group overflow-hidden bg-surface-container-lowest flex items-center justify-center min-h-[250px]" href="/products">
                <div class="absolute inset-0 bg-center bg-cover opacity-70 group-hover:opacity-100 transition-opacity duration-700 group-hover:scale-105" data-alt="Collection of minimalist silver chains and rings on a dark slate background, high contrast lighting" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDZ7ZvG__DPFinLKbGE3mVd1K5wAaMGxtsDRViw4wn_eP9yVEcUaYXQgDQt9udfYkqGYYccG7pQJhzKBtWXfoLQBriNT4_MjY3kcAoU-z_T1IRzwBBUFV3t8NNHAgC9n2piTbwW26Z-EA87E9XyfAxtcDo24sYNJLYteXy7WgSeYrgtrtfdiwJU1ZCmZP9sASZUUNFWxZFLHdvYp_2t-Sl3PoD-Odn7bWdjSsGfTSDlNdFf_ZTr32kjsZnlrxs-RrureaNkul_pHEI");'>
                </div>
                <div class="absolute inset-0 bg-black/30"></div>
                <h3 class="relative z-10 text-primary text-3xl font-black uppercase font-headline tracking-tighter">Hardware</h3>
            </a>
        </div>
    </section>
</main>
@endsection
