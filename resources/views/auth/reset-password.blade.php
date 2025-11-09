@extends('layouts.guest')

@section('title', 'Reset Password')

@section('content')
<div class="glass-card w-full max-w-md p-8 rounded-3xl shadow-2xl text-white backdrop-blur-xl">

    <!-- Judul -->
    <h2 class="text-3xl font-bold text-center mb-6">Reset Your Password</h2>

    <!-- Pesan Status -->
    @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-400 text-center">
            {{ session('status') }}
        </div>
    @endif

    <!-- Form Reset Password -->
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email -->
        <div class="mb-5 relative">
            <input id="email" type="email" name="email" placeholder="Email" value="{{ old('email', $request->email) }}" required autofocus
                class="w-full p-4 rounded-xl bg-white/10 border border-white/20 text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-400">
            <span class="absolute right-4 top-4 text-gray-300">
                <i class="fas fa-envelope"></i>
            </span>
            @error('email')
                <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-5 relative">
            <input id="password" type="password" name="password" placeholder="New Password" required
                class="w-full p-4 rounded-xl bg-white/10 border border-white/20 text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-400">
            <span class="absolute right-4 top-4 text-gray-300">
                <i class="fas fa-lock"></i>
            </span>
            @error('password')
                <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mb-6 relative">
            <input id="password_confirmation" type="password" name="password_confirmation" placeholder="Confirm New Password" required
                class="w-full p-4 rounded-xl bg-white/10 border border-white/20 text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-400">
            <span class="absolute right-4 top-4 text-gray-300">
                <i class="fas fa-lock"></i>
            </span>
            @error('password_confirmation')
                <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Tombol Submit -->
        <button type="submit"
            class="w-full py-3 rounded-full bg-purple-600 hover:bg-purple-700 font-semibold transition">
            Reset Password
        </button>

        <!-- Link Kembali ke Login -->
        <p class="text-center text-sm mt-6">
            Remember your password?
            <a href="{{ route('login') }}" class="text-purple-300 hover:text-purple-400 font-semibold">Login</a>
        </p>
    </form>
</div>
@endsection
