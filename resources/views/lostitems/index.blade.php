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
            {{-- Notifikasi untuk pesan sukses (misalnya setelah menghapus laporan) --}}
            @if (session('success'))
                <div class="mb-6 p-4 bg-green-200 text-green-800 rounded-lg dark:bg-green-800 dark:text-green-200">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($barangHilangs as $barang)
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg flex flex-col">
                        @if ($barang->gambar)
                            <img src="{{ Storage::url($barang->gambar) }}" alt="{{ $barang->nama_barang }}" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                                <span class="text-gray-500">Tidak ada gambar</span>
                            </div>
                        @endif
                        <div class="p-6 flex flex-col flex-grow">
                            <h3 class="font-semibold text-lg text-gray-900 dark:text-gray-100">{{ $barang->nama_barang }}</h3>
                            <p class="mt-2 text-gray-800 dark:text-gray-200 flex-grow">{{ Str::limit($barang->deskripsi_barang, 100) }}</p>
                            <div class="mt-4 pt-4 border-t dark:border-gray-600 flex justify-between items-center">
                                <a href="{{ route('lostitems.show', $barang) }}" class="text-indigo-600 dark:text-indigo-400 hover:underline">Lihat Detail</a>
                                {{-- Hanya tampilkan tombol Edit & Hapus jika user adalah pemilik laporan atau admin --}}
                                @if (auth()->id() === $barang->user_id || auth()->user()->role === 'admin')
                                    <div class="flex space-x-2">
                                        <a href="{{ route('lostitems.edit', $barang) }}" class="text-sm text-yellow-600 dark:text-yellow-400 hover:underline">Edit</a>
                                        <form action="{{ route('lostitems.destroy', $barang) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus laporan ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-sm text-red-600 dark:text-red-400 hover:underline">Hapus</button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-16 text-gray-500 dark:text-gray-400">
                        <p>Belum ada laporan barang hilang yang disetujui oleh Admin.</p>
                    </div>
                @endforelse
            </div>
            
            {{-- Link untuk Paginasi --}}
            <div class="mt-6">
                {{ $barangHilangs->links() }}
            </div>
        </div>
    </div>
</x-app-layout>