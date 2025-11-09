@extends('layouts.guest')

@section('title', 'Login')

@section('content')
<div class="glass-card w-full max-w-md p-8 rounded-3xl shadow-2xl text-white backdrop-blur-xl">

    <h2 class="text-3xl font-bold text-center mb-6">Login</h2>
    
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Username -->
        <div class="mb-5 relative">
            <input id="email" type="email" name="email" placeholder="Email" required
                class="w-full p-4 rounded-xl bg-white/10 border border-white/20 text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-400">
            <span class="absolute right-4 top-4 text-gray-300">
                <i class="fas fa-user"></i>
            </span>
        </div>

        <!-- Password -->
        <div class="mb-5 relative">
            <input id="password" type="password" name="password" placeholder="Password" required
                class="w-full p-4 rounded-xl bg-white/10 border border-white/20 text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-400">
            <span class="absolute right-4 top-4 text-gray-300">
                <i class="fas fa-lock"></i>
            </span>
        </div>

        <div class="flex items-center justify-between mb-6 text-sm">
            <label class="flex items-center space-x-2">
                <input type="checkbox" class="rounded text-purple-500 bg-transparent border-gray-400">
                <span>Remember me</span>
            </label>
            <a href="{{ route('password.request') }}" class="text-purple-300 hover:text-purple-400">Forgot password?</a>
        </div>

        <!-- Submit -->
        <button type="submit"
            class="w-full py-3 rounded-full bg-purple-600 hover:bg-purple-700 font-semibold transition">
            Login
        </button>

        <!-- Register link -->
        <p class="text-center text-sm mt-6">
            Don’t have an account?
            <a href="{{ route('register') }}" class="text-purple-300 hover:text-purple-400 font-semibold">Register</a>
        </p>
    </form>
</div>
@endsection