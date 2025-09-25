@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto mt-10 p-4 sm:p-6 lg:p-8">
    
    {{-- Header/Judul --}}
    <div class="mb-6">
        <h3 class="text-xl font-semibold text-gray-800">Halaman Lapor Barang Temuan</h3>
        <h4 class="text-lg font-medium text-gray-700 mt-1">Form Lapor Barang Temuan</h4>
    </div>

    {{-- Form --}}
    <form action="{{ route('barang-temuan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            {{-- KOLOM KIRI: Upload Gambar --}}
            <div class="lg:col-span-1">
                <div class="border border-purple-300 rounded-lg p-6 text-center bg-purple-50 dark:bg-purple-800 shadow-sm h-full flex flex-col justify-center items-center">
                    
                    {{-- Preview / Placeholder --}}
                    <div class="flex justify-center items-center w-full h-40 mb-4 bg-purple-100 dark:bg-purple-900 border border-dashed border-purple-300 dark:border-purple-700 rounded">
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="text-purple-400" viewBox="0 0 16 16">
                            <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                            <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm.5 12-1-1 1-1V3.5h11V13h-11z"/>
                        </svg>
                    </div>
                    
                    {{-- Tombol Tambah Gambar --}}
                    <label for="gambar" class="px-4 py-2 bg-purple-800 dark:bg-purple-700 text-white font-semibold rounded-md shadow-md hover:bg-purple-900 dark:hover:bg-purple-600 cursor-pointer transition duration-150">
                        Tambah Gambar
                    </label>
                    <input type="file" id="gambar" name="gambar" class="hidden" required>
                    <x-input-error :messages="$errors->get('gambar')" class="mt-2" />
                </div>
            </div>

            {{-- KOLOM KANAN: Form Input --}}
            <div class="lg:col-span-2 space-y-4">
                
                {{-- Input Nama Barang --}}
                <div>
                    <label for="nama_barang" class="block text-sm font-medium text-gray-700">Nama Barang</label>
                    <input type="text" id="nama_barang" name="nama_barang" value="{{ old('nama_barang') }}" class="mt-1 block w-full border-purple-300 dark:border-purple-700 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 dark:focus:ring-purple-400 dark:focus:border-purple-400" required>
                    <x-input-error :messages="$errors->get('nama_barang')" class="mt-2" />
                </div>

                {{-- Input Deskripsi Barang --}}
                <div>
                    <label for="deskripsi_barang" class="block text-sm font-medium text-gray-700">Deskripsi Barang (Ciri-ciri, warna, merek, dll.)</label>
                    <textarea id="deskripsi_barang" name="deskripsi_barang" rows="3" class="mt-1 block w-full border-purple-300 dark:border-purple-700 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 dark:focus:ring-purple-400 dark:focus:border-purple-400" required>{{ old('deskripsi_barang') }}</textarea>
                    <x-input-error :messages="$errors->get('deskripsi_barang')" class="mt-2" />
                </div>

                {{-- Input Tanggal Penemuan --}}
                <div>
                    <label for="tgl_penemuan" class="block text-sm font-medium text-gray-700">Tanggal Penemuan</label>
                    <input type="date" id="tgl_penemuan" name="tgl_penemuan" value="{{ old('tgl_penemuan') }}" class="mt-1 block w-full border-purple-300 dark:border-purple-700 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 dark:focus:ring-purple-400 dark:focus:border-purple-400" required>
                    <x-input-error :messages="$errors->get('tgl_penemuan')" class="mt-2" />
                </div>

                {{-- Input Lokasi Penemuan --}}
                <div>
                    <label for="lokasi_penemuan" class="block text-sm font-medium text-gray-700">Lokasi Penemuan</label>
                    <input type="text" id="lokasi_penemuan" name="lokasi_penemuan" value="{{ old('lokasi_penemuan') }}" class="mt-1 block w-full border-purple-300 dark:border-purple-700 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 dark:focus:ring-purple-400 dark:focus:border-purple-400" required>
                    <x-input-error :messages="$errors->get('lokasi_penemuan')" class="mt-2" />
                </div>
                
                {{-- Tombol Submit --}}
                <div class="flex justify-end pt-4">
                    <button type="submit" class="px-6 py-2 bg-purple-800 dark:bg-purple-700 text-white font-semibold rounded-md shadow-md hover:bg-purple-900 dark:hover:bg-purple-600 focus:outline-none focus:ring-2 focus:ring-purple-500 dark:focus:ring-purple-400 focus:ring-offset-2">
                        Kirim Laporan
                    </button>
                </div>
            </div>

        </div> {{-- Grid End --}}
        
    </form>
</div>
@endsection
