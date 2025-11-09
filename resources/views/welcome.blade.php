@extends('layouts.guest')

@section('content')
    <div class="text-center max-w-3xl">
        <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight">
            Kehilangan Barang <br> di Kampus?
        </h1>

        <p class="text-gray-300 mb-8 max-w-xl mx-auto">
            Jangan panik. "Balikin" membantumu menemukan kembali barang berhargamu dan melaporkan barang yang kamu temukan. 
            Platform Lost & Found untuk seluruh warga kampus.
        </p>

        <div class="flex justify-center gap-4">
            <a href="{{ route('register') }}" class="px-6 py-3 bg-purple-600 hover:bg-purple-700 rounded-lg font-semibold text-white">
                Gabung Sekarang
            </a>
            <a href="{{ route('login') }}" class="px-6 py-3 border border-gray-500 hover:border-purple-500 rounded-lg font-semibold">
                Lihat Barang Hilang
            </a>
        </div>
    </div>
@endsection