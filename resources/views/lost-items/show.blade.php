<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Barang Hilang') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="md:flex">
                    {{-- Kolom untuk Gambar --}}
                    @if ($barangHilang->gambar)
                        <div class="md:w-1/2">
                            <img src="{{ Storage::url($barangHilang->gambar) }}" alt="{{ $barangHilang->nama_barang }}" class="w-full h-full object-cover">
                        </div>
                    @endif
                    
                    {{-- Kolom untuk Detail Teks --}}
                    <div class="p-8 md:w-1/2 space-y-4">
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $barangHilang->nama_barang }}</h3>
                        
                        <div class="space-y-2 text-gray-700 dark:text-gray-300">
                            <p><strong>Dilaporkan oleh:</strong> {{ $barangHilang->user->name }}</p>
                            <p><strong>Tanggal Kehilangan:</strong> {{ \Carbon\Carbon::parse($barangHilang->tgl_kehilangan)->isoFormat('dddd, D MMMM YYYY') }}</p>
                            <p><strong>Lokasi Terakhir Dilihat:</strong> {{ $barangHilang->lokasi_kehilangan }}</p>
                        </div>

                        <div class="mt-4 pt-4 border-t dark:border-gray-600">
                             <h4 class="font-semibold text-gray-900 dark:text-gray-100">Deskripsi Lengkap:</h4>
                             <p class="mt-2 text-gray-800 dark:text-gray-200 whitespace-pre-wrap">{{ $barangHilang->deskripsi_barang }}</p>
                        </div>
                        
                        <div class="mt-6 flex justify-end">
                            <a href="{{ route('lostitems.index') }}" class="text-indigo-600 dark:text-indigo-400 hover:underline">
                                &larr; Kembali ke Daftar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

