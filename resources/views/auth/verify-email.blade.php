@extends('layouts.guest')

@section('title', 'Verifikasi Email')

@section('content')
<div class="glass-card w-full max-w-md p-8 rounded-3xl shadow-2xl text-white backdrop-blur-xl">

    <!-- Logo -->
    <div class="text-center">
        <a href="/" class="inline-block">
            <img src="{{ asset('images/icon/logo.png') }}" alt="Logo" class="w-20 h-20 mx-auto rounded-full" />
        </a>
        <h2 class="mt-6 text-2xl font-bold text-white">
            Satu Langkah Lagi!
        </h2>
        <p class="mt-2 text-sm text-gray-300">
            Terima kasih telah mendaftar! Sebelum memulai, silakan verifikasi alamat email Anda dengan mengklik link
            yang baru saja kami kirimkan. <br>
            Jika belum menerima email, kami dapat mengirimkannya kembali untuk Anda.
        </p>
    </div>

    <!-- Pesan sukses kirim ulang -->
    @if (session('status') == 'verification-link-sent')
        <div class="mt-6 text-sm text-green-400 bg-green-400/10 border border-green-400/30 px-3 py-2 rounded-md text-center transition-all duration-300">
            Link verifikasi baru telah dikirim ke email Anda.
        </div>
    @endif

    <!-- Tombol -->
    <div class="mt-8 space-y-4">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit"
                class="w-full bg-purple-600 hover:bg-purple-700 transition rounded-lg py-3 font-semibold text-white">
                Kirim Ulang Email Verifikasi
            </button>
        </form>

        <!-- Tombol logout -->
        <form method="POST" action="{{ route('logout') }}" class="text-center">
            @csrf
            <button type="submit"
                class="text-sm text-gray-400 hover:text-gray-200 underline">
                Keluar dari Akun
            </button>
        </form>
    </div>
</div>
@endsection
