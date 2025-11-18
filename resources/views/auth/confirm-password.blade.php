@extends('layouts.guest')

@section('title', 'Konfirmasi Password')

@section('content')
<div class="glass-card w-full max-w-md p-8 rounded-3xl shadow-2xl text-white backdrop-blur-xl">

    <!-- Logo -->
    <div class="text-center">
        <a href="/" class="inline-block">
            <img src="{{ asset('images/icon/logo.png') }}" alt="Logo" class="w-20 h-20 mx-auto rounded-full" />
        </a>
        <h2 class="mt-6 text-2xl font-bold text-white">
            Konfirmasi Akses
        </h2>
        <p class="mt-2 text-sm text-gray-300">
            Ini adalah area aman. Mohon konfirmasi password Anda sebelum melanjutkan.
        </p>
    </div>

    <!-- Form -->
    <form method="POST" action="{{ route('password.confirm') }}" class="mt-6 space-y-6">
        @csrf

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm mb-2 text-gray-200">Password</label>
            <input id="password" type="password" name="password" required
                autocomplete="current-password"
                class="w-full p-3 rounded-lg bg-[#1E1E3F] border border-gray-600 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500"
                placeholder="Masukkan password Anda">
        </div>

        <!-- Tombol -->
        <button type="submit"
            class="w-full bg-purple-600 hover:bg-purple-700 transition rounded-lg py-3 font-semibold text-white">
            Konfirmasi Password
        </button>
    </form>

    <!-- Link kembali -->
    <div class="text-center mt-4">
        <a href="{{ route('login') }}" class="text-sm text-purple-400 hover:text-purple-300">
            Kembali ke halaman login
        </a>
    </div>
</div>
@endsection
