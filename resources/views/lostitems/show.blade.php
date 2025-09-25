@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10 p-4 sm:p-6 lg:p-8">

    {{-- Header --}}
    <div class="mb-6">
        <h3 class="text-xl font-semibold text-gray-800">Detail Barang Hilang</h3>
        <h4 class="text-lg text-gray-600 mt-1">Informasi lengkap barang yang dilaporkan</h4>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- Gambar --}}
        <div>
            @if ($barang->gambar)
                <img src="{{ Storage::url($barang->gambar) }}" 
                     alt="{{ $barang->nama_barang }}" 
                     class="w-full h-80 object-cover rounded-lg border">
            @else
                <div class="w-full h-80 bg-gray-200 flex items-center justify-center rounded-lg">
                    <span class="text-gray-500">Tidak ada gambar</span>
                </div>
            @endif
        </div>

        {{-- Detail --}}
        <div class="space-y-4">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                {{ $barang->nama_barang }}
            </h2>

            <p class="text-gray-700 dark:text-gray-300">
                <span class="font-semibold">Deskripsi:</span><br>
                {{ $barang->deskripsi_barang }}
            </p>

            <p class="text-gray-700 dark:text-gray-300">
                <span class="font-semibold">Tanggal Kehilangan:</span><br>
                {{ \Carbon\Carbon::parse($barang->tgl_kehilangan)->isoFormat('D MMMM YYYY') }}
            </p>

            <p class="text-gray-700 dark:text-gray-300">
                <span class="font-semibold">Lokasi Kehilangan:</span><br>
                {{ $barang->lokasi_kehilangan }}
            </p>

            <p class="text-sm text-gray-500">
                Dilaporkan oleh: <strong>{{ $barang->user->name }}</strong>
            </p>

            {{-- 🔥 Tombol Aksi --}}
            <div class="mt-6 flex space-x-3">
                {{-- Tombol klaim barang --}}
                <a href="#" class="px-5 py-2 bg-green-600 text-white rounded-md shadow hover:bg-green-700">
                    Lihat Barang
                </a>

                {{-- Tombol kembali --}}
                <a href="{{ route('lostitems.index') }}" 
                   class="px-5 py-2 bg-gray-500 text-white rounded-md shadow hover:bg-gray-600">
                    Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
