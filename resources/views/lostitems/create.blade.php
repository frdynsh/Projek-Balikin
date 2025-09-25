@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto mt-10 p-4 sm:p-6 lg:p-8">

    {{-- Header/Judul --}}
    <div class="mb-6">
        <h3 class="text-xl font-semibold text-gray-800">Halaman Tambah Barang Hilang</h3>
        <h4 class="text-lg font-medium text-gray-700 mt-1">Form Tambah Barang Hilang</h4>
    </div>

    {{-- Form --}}
    <form action="{{ route('lostitems.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- KOLOM KIRI: Upload Gambar --}}
            <div class="lg:col-span-1">
                <div class="border border-gray-300 rounded-lg p-6 text-center bg-white shadow-sm h-full flex flex-col justify-center items-center">

                    {{-- Preview / Placeholder --}}
                    <div class="flex justify-center items-center w-full h-40 mb-4 bg-gray-50 border border-dashed border-gray-300 rounded">
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="text-gray-400" viewBox="0 0 16 16">
                            <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                            <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm.5 12-1-1 1-1V3.5h11V13h-11z" />
                        </svg>
                    </div>

                    {{-- Tombol Tambah Gambar --}}
                    <label for="gambar" class="px-4 py-2 bg-red-600 text-white font-semibold rounded-md shadow-md hover:bg-red-700 cursor-pointer transition duration-150">
                        <i class="fas fa-plus-circle mr-2"></i> Tambah Gambar
                    </label>
                    <input type="file" id="gambar" name="gambar" class="hidden">
                </div>
            </div>

            {{-- KOLOM KANAN: Form Input --}}
            <div class="lg:col-span-2 space-y-4">

                {{-- Input Nama Barang --}}
                <div>
                    <label for="nama_barang" class="block text-sm font-medium text-gray-700">Nama Barang</label>
                    <input type="text" id="nama_barang" name="nama_barang" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500">
                </div>

                {{-- Input Deskripsi Barang --}}
                <div>
                    <label for="deskripsi_barang" class="block text-sm font-medium text-gray-700">Deskripsi Barang</label>
                    <textarea id="deskripsi_barang" name="deskripsi_barang" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500"></textarea>
                </div>

                {{-- Input Tanggal Kehilangan --}}
                <div>
                    <label for="tgl_kehilangan" class="block text-sm font-medium text-gray-700">Tanggal Kehilangan</label>
                    <input type="date" id="tgl_kehilangan" name="tgl_kehilangan" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500">
                </div>

                {{-- Input Lokasi Kehilangan --}}
                <div>
                    <label for="lokasi_kehilangan" class="block text-sm font-medium text-gray-700">Lokasi Kehilangan</label>
                    <input type="text" id="lokasi_kehilangan" name="lokasi_kehilangan" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500">
                </div>


                {{-- Tombol Upload --}}
                <div class="flex justify-end pt-4">
                    <button type="submit" class="px-6 py-2 bg-red-600 text-white font-semibold rounded-md shadow-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                        Upload
                    </button>
                </div>
            </div>

        </div> {{-- Grid End --}}

    </form>
</div>
@endsection