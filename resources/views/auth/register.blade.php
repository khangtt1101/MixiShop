@extends('layouts.app')

@section('content')
<main class="flex-grow flex items-center justify-center px-4 py-12">
    <div class="w-full max-w-md">
        <h1 class="text-4xl md:text-5xl font-black font-headline tracking-tighter uppercase mb-2">Register</h1>
        <p class="text-zinc-400 mb-8 font-headline tracking-tight">Create a new account to join the dark side.</p>

        <form method="POST" action="{{ route('register') }}" class="space-y-6">
            @csrf

            <!-- Name -->
            <div>
                <label for="name" class="block font-headline font-bold text-sm tracking-widest uppercase mb-2">Name</label>
                <input id="name" class="w-full bg-zinc-900 border-2 border-zinc-800 text-white px-4 py-3 focus:border-white focus:ring-0 transition-colors font-headline" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-500 font-bold text-sm" />
            </div>

            <!-- Email Address -->
            <div>
                <label for="email" class="block font-headline font-bold text-sm tracking-widest uppercase mb-2">Email</label>
                <input id="email" class="w-full bg-zinc-900 border-2 border-zinc-800 text-white px-4 py-3 focus:border-white focus:ring-0 transition-colors font-headline" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 font-bold text-sm" />
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block font-headline font-bold text-sm tracking-widest uppercase mb-2">Password</label>
                <input id="password" class="w-full bg-zinc-900 border-2 border-zinc-800 text-white px-4 py-3 focus:border-white focus:ring-0 transition-colors font-headline" type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 font-bold text-sm" />
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="block font-headline font-bold text-sm tracking-widest uppercase mb-2">Confirm Password</label>
                <input id="password_confirmation" class="w-full bg-zinc-900 border-2 border-zinc-800 text-white px-4 py-3 focus:border-white focus:ring-0 transition-colors font-headline" type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-500 font-bold text-sm" />
            </div>

            <button type="submit" class="w-full bg-white text-black font-black font-headline uppercase tracking-widest py-4 hover:bg-zinc-200 transition-colors mt-8">
                Register
            </button>
            
            <p class="text-center text-zinc-500 mt-6 font-headline tracking-wider text-sm">
                Already registered? <a href="{{ route('login') }}" class="text-white hover:underline underline-offset-4">Log in</a>
            </p>
        </form>
    </div>
</main>
@endsection
