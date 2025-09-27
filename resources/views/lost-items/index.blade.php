<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-8">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Daftar Barang Hilang') }}
                </h2>
                <form action="{{ route('lost-items.index') }}" method="GET" class="w-full max-w-sm">
                    <div class="relative">
                        <input 
                            type="text" 
                            name="search" 
                            placeholder="Cari nama barang..." 
                            value="{{ request('search') }}"
                            class="block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                        >
                        @if (request('search'))
                            <a href="{{ route('lost-items.index') }}" class="absolute inset-y-0 right-0 flex items-center pr-3 text-sm text-gray-400 hover:text-gray-600 dark:hover:text-gray-200" title="Hapus Pencarian">
                                ✕
                            </a>
                        @else
                            <button type="submit" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600 dark:hover:text-gray-200">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </button>
                        @endif
                    </div>
                </form>
            </div>
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
                            <div class="w-full h-48 bg-gray-200 dark:bg-gray-700 flex items-center justify-center"><span class="text-gray-500">Tidak ada gambar</span></div>
                        @endif
                        <div class="p-6 flex flex-col flex-grow">
                            <h3 class="font-semibold text-lg text-gray-900 dark:text-gray-100">{{ $barang->nama_barang }}</h3>
                            <p class="mt-2 text-gray-800 dark:text-gray-200 flex-grow">{{ Str::limit($barang->deskripsi_barang, 100) }}</p>
                            <div class="mt-4 pt-4 border-t dark:border-gray-600 flex justify-between items-center">
                                <a href="{{ route('lost-items.show', $barang) }}" class="text-indigo-600 dark:text-indigo-400 hover:underline">Lihat Detail</a>
                                
                                <div class="flex space-x-2">
                                    {{-- Tombol Edit: HANYA untuk pemilik laporan --}}
                                    @if (auth()->id() === $barang->user_id)
                                        <a href="{{ route('lost-items.edit', $barang) }}" class="text-sm text-yellow-600 dark:text-yellow-400 hover:underline">Edit</a>
                                    @endif

                                    {{-- Tombol Hapus: HANYA untuk admin --}}
                                    @if (auth()->user()->role === 'admin')
                                        <form action="{{ route('lost-items.destroy', $barang) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus laporan ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-sm text-red-600 dark:text-red-400 hover:underline">Hapus</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-16 text-gray-500 dark:text-gray-400">
                        <p>Belum ada laporan barang hilang yang disetujui oleh Admin.</p>
                    </div>
                @endforelse
            </div>
            
            <div class="mt-6">
                {{ $barangHilangs->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
