@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto mt-10 p-4 sm:p-6 lg:p-8">
    
    {{-- Header/Judul --}}
    <div class="mb-6">
        <h3 class="text-xl font-semibold text-gray-800">Halaman Edit Barang Hilang</h3>
        <h4 class="text-lg font-medium text-gray-700 mt-1">Form Edit Barang Hilang</h4>
    </div>

    {{-- Form --}}
    {{-- Menggunakan route('update') dengan ID dan method PUT --}}
    <form action="{{ route('lostitems.update', $item->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            {{-- KOLOM KIRI: Preview dan Ganti Gambar --}}
            <div class="lg:col-span-1">
                <div class="border border-gray-300 rounded-lg p-6 text-center bg-white shadow-sm h-full flex flex-col justify-center items-center">
                    
                    {{-- Preview Gambar yang Sudah Ada --}}
                    @if ($item->gambar)
                        <img src="{{ asset('storage/' . $item->gambar) }}" alt="Gambar Barang" class="w-full h-40 object-cover mb-4 rounded-lg border border-gray-300">
                    @else
                        {{-- Placeholder jika tidak ada gambar --}}
                        <div class="flex justify-center items-center w-full h-40 mb-4 bg-gray-50 border border-dashed border-gray-300 rounded">
                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="text-gray-400" viewBox="0 0 16 16">
                                <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm.5 12-1-1 1-1V3.5h11V13h-11z"/>
                            </svg>
                        </div>
                    @endif
                    
                    {{-- Tombol Ganti Gambar --}}
                    <label for="gambar" class="px-4 py-2 bg-red-600 text-white font-semibold rounded-md shadow-md hover:bg-red-700 cursor-pointer transition duration-150">
                        Ganti Gambar
                    </label>
                    <input type="file" id="gambar" name="gambar" class="hidden">
                </div>
            </div>

            {{-- KOLOM KANAN: Form Input --}}
            <div class="lg:col-span-2 space-y-4">
                
                {{-- Input Nama Barang --}}
                <div>
                    <label for="nama_barang" class="block text-sm font-medium text-gray-700">Nama Barang</label>
                    {{-- Mengisi input dengan data yang sudah ada --}}
                    <input type="text" id="nama_barang" name="nama_barang" value="{{ $item->nama_barang }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500">
                </div>

                {{-- Input Deskripsi Barang --}}
                <div>
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi Barang</label>
                    {{-- Mengisi textarea dengan data yang sudah ada --}}
                    <textarea id="deskripsi" name="deskripsi" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500">{{ $item->deskripsi }}</textarea>
                </div>

                {{-- Input Tanggal Kehilangan --}}
                <div>
                    <label for="tanggal" class="block text-sm font-medium text-gray-700">Tanggal Kehilangan</label>
                    {{-- Mengisi input dengan data yang sudah ada --}}
                    <input type="date" id="tanggal" name="tanggal" value="{{ $item->tanggal }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500">
                </div>

                {{-- Input Lokasi Kehilangan --}}
                <div>
                    <label for="lokasi" class="block text-sm font-medium text-gray-700">Lokasi Kehilangan</label>
                    {{-- Mengisi input dengan data yang sudah ada --}}
                    <input type="text" id="lokasi" name="lokasi" value="{{ $item->lokasi }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500">
                </div>
                
                {{-- Tombol Simpan --}}
                <div class="flex justify-end pt-4">
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-md shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Simpan Perubahan
                    </button>
                </div>
            </div>

        </div> {{-- Grid End --}}
        
    </form>
</div>
@endsection
