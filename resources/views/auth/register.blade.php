@extends('layouts.guest')

@section('title', 'Register')

@section('content')
<div class="glass-card w-full max-w-md p-8 rounded-3xl shadow-2xl text-white backdrop-blur-xl">

    <h2 class="text-3xl font-bold text-center mb-6">Register</h2>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="mb-5 relative">
            <input id="name" type="text" name="name" value="{{ old('name') }}" placeholder="Full Name" required
                class="w-full p-4 rounded-xl bg-white/10 border border-white/20 text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-400">
            <span class="absolute right-4 top-4 text-gray-300">
                <i class="fas fa-user"></i>
            </span>
        </div>

        <!-- Email -->
        <div class="mb-5 relative">
            <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="Email" required
                class="w-full p-4 rounded-xl bg-white/10 border border-white/20 text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-400">
            <span class="absolute right-4 top-4 text-gray-300">
                <i class="fas fa-envelope"></i>
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

        <!-- Confirm Password -->
        <div class="mb-6 relative">
            <input id="password_confirmation" type="password" name="password_confirmation" placeholder="Confirm Password" required
                class="w-full p-4 rounded-xl bg-white/10 border border-white/20 text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-400">
            <span class="absolute right-4 top-4 text-gray-300">
                <i class="fas fa-lock"></i>
            </span>
        </div>

        <!-- Submit -->
        <button type="submit"
            class="w-full py-3 rounded-full bg-purple-600 hover:bg-purple-700 font-semibold transition">
            Create Account
        </button>

        <!-- Login link -->
        <p class="text-center text-sm mt-6">
            Already have an account?
            <a href="{{ route('login') }}" class="text-purple-300 hover:text-purple-400 font-semibold">Login</a>
        </p>
    </form>
</div>
@endsection
