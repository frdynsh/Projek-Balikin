<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Daftar Barang Hilang') }}
            </h2>
            <a href="{{ route('lostitems.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                Lapor Kehilangan
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Notifikasi Sukses -->
            @if (session('success'))
                <div class="mb-6 p-4 bg-green-200 text-green-800 rounded-lg dark:bg-green-800 dark:text-green-200">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Menggunakan Grid Layout dari Tailwind CSS --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                {{-- Loop data dengan variabel $barangHilangs dari Controller --}}
                @forelse ($barangHilangs as $barang)
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg flex flex-col">
                        {{-- Mengambil gambar dari Storage Laravel --}}
                        @if ($barang->gambar)
                            <img src="{{ Storage::url($barang->gambar) }}" alt="{{ $barang->nama_barang }}" class="w-full h-48 object-cover">
                        @else
                            {{-- Placeholder jika tidak ada gambar --}}
                            <div class="w-full h-48 bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                                <span class="text-gray-500">Tidak ada gambar</span>
                            </div>
                        @endif
                        <div class="p-6 flex flex-col flex-grow">
                            <h3 class="font-semibold text-lg text-gray-900 dark:text-gray-100">{{ $barang->nama_barang }}</h3>
                            {{-- Menggunakan kolom 'tgl_kehilangan' dan 'lokasi_kehilangan' dari database --}}
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Hilang pada: {{ \Carbon\Carbon::parse($barang->tgl_kehilangan)->isoFormat('D MMMM YYYY') }}</p>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Lokasi: {{ $barang->lokasi_kehilangan }}</p>
                            <p class="mt-2 text-gray-800 dark:text-gray-200 flex-grow">{{ Str::limit($barang->deskripsi_barang, 100) }}</p>
                            {{-- Mengambil nama pelapor dari relasi 'user' --}}
                            <p class="mt-4 text-xs text-gray-500">Dilaporkan oleh: {{ $barang->user->name }}</p>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-16 text-gray-500 dark:text-gray-400">
                        <p>Belum ada laporan barang hilang yang disetujui oleh Admin.</p>
                    </div>
                @endforelse
            </div>
            
            {{-- Menampilkan link Paginasi --}}
            <div class="mt-6">
                {{ $barangHilangs->links() }}
            </div>
        </div>
    </div>
</x-app-layout>