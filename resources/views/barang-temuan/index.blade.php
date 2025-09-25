@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-12 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-semibold text-gray-800">Daftar Barang Temuan</h2>
        <a href="{{ route('barang-temuan.create') }}" class="px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700">
            Lapor Penemuan
        </a>
    </div>

    <!-- Notifikasi Sukses -->
    @if (session('success'))
        <div class="mb-6 p-4 bg-green-200 text-green-800 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($barangTemuans as $barang)
            <div class="bg-white overflow-hidden shadow-sm rounded-lg flex flex-col">
                @if ($barang->gambar)
                    <img src="{{ Storage::url($barang->gambar) }}" alt="{{ $barang->nama_barang }}" class="w-full h-48 object-cover">
                @else
                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                        <span class="text-gray-500">Tidak ada gambar</span>
                    </div>
                @endif
                <div class="p-6 flex flex-col flex-grow">
                    <h3 class="font-semibold text-lg text-gray-900">{{ $barang->nama_barang }}</h3>
                    <p class="text-sm text-gray-600 mt-1">Ditemukan pada: {{ \Carbon\Carbon::parse($barang->tgl_penemuan)->isoFormat('D MMMM YYYY') }}</p>
                    <p class="text-sm text-gray-600">Lokasi: {{ $barang->lokasi_penemuan }}</p>
                    <p class="mt-2 text-gray-800 flex-grow">{{ Str::limit($barang->deskripsi_barang, 100) }}</p>
                    <p class="mt-4 text-xs text-gray-500">Dilaporkan oleh: {{ $barang->user->name }}</p>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-16 text-gray-500">
                Belum ada laporan barang temuan yang disetujui oleh Admin.
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $barangTemuans->links() }}
    </div>
</div>
@endsection
