@extends('layouts.app')

@section('content')
<main class="flex-grow flex items-center justify-center px-4 py-12">
    <div class="w-full max-w-md">
        <h1 class="text-4xl md:text-5xl font-black font-headline tracking-tighter uppercase mb-2">Login</h1>
        <p class="text-zinc-400 mb-8 font-headline tracking-tight">Enter your credentials to access your account.</p>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4 text-green-400 font-bold" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <!-- Email Address -->
            <div>
                <label for="email" class="block font-headline font-bold text-sm tracking-widest uppercase mb-2">Email</label>
                <input id="email" class="w-full bg-zinc-900 border-2 border-zinc-800 text-white px-4 py-3 focus:border-white focus:ring-0 transition-colors font-headline" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 font-bold text-sm" />
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block font-headline font-bold text-sm tracking-widest uppercase mb-2">Password</label>
                <input id="password" class="w-full bg-zinc-900 border-2 border-zinc-800 text-white px-4 py-3 focus:border-white focus:ring-0 transition-colors font-headline" type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 font-bold text-sm" />
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between">
                <label for="remember_me" class="flex items-center gap-2 cursor-pointer">
                    <input id="remember_me" type="checkbox" class="w-5 h-5 bg-zinc-900 border-2 border-zinc-800 text-white focus:ring-0 focus:ring-offset-0 rounded-none cursor-pointer" name="remember">
                    <span class="text-sm font-headline tracking-wider text-zinc-400">Remember me</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="text-sm font-headline tracking-wider text-zinc-400 hover:text-white transition-colors underline decoration-zinc-600 underline-offset-4" href="{{ route('password.request') }}">
                        Forgot password?
                    </a>
                @endif
            </div>

            <button type="submit" class="w-full bg-white text-black font-black font-headline uppercase tracking-widest py-4 hover:bg-zinc-200 transition-colors mt-8">
                Log In
            </button>
            
            <p class="text-center text-zinc-500 mt-6 font-headline tracking-wider text-sm">
                Don't have an account? <a href="{{ route('register') }}" class="text-white hover:underline underline-offset-4">Register here</a>
            </p>
        </form>
    </div>
</main>
@endsection
