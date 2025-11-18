<x-app-layout>
    <div class="py-32 relative min-h-screen overflow-hidden bg-white dark:bg-[#111828] text-gray-900 dark:text-white transition-colors duration-500 isolate px-6 lg:px-8">
        {{-- === GRADIENT BACKGROUND === --}}
        <div 
            class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80" 
            aria-hidden="true">
            <div 
                class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] 
                       -translate-x-1/6 rotate-[30deg] 
                       bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] dark:from-[#4f46e5] dark:to-[#9333ea] opacity-30 
                       sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]" 
                style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 
                       85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 
                       60.2% 62.4%, 52.4% 68.1%, 
                       47.5% 58.3%, 45.2% 34.5%, 
                       27.5% 76.7%, 0.1% 64.9%, 
                       17.9% 100%, 27.6% 76.8%, 
                       76.1% 97.7%, 74.1% 44.1%)">
            </div>
        </div>
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
                            placeholder="Cari nama atau deskripsi barang..." 
                            value="{{ old('search', $search) }}"
                            class="block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 
                                focus:border-purple-500 dark:focus:border-purple-600 
                                focus:ring-purple-500 dark:focus:ring-purple-600 rounded-md shadow-sm"
                        >
                        <button type="submit" 
                                class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" 
                                fill="none" 
                                viewBox="0 0 24 24" 
                                stroke-width="1.5" 
                                stroke="currentColor" 
                                class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" 
                                    d="M21 21l-4.35-4.35m1.8-4.65a7.5 7.5 0 11-15 0 7.5 7.5 0 0115 0z" />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>

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
                                <a href="{{ route('lost-items.show', $barang) }}" class="text-purple-600 dark:text-purple-400 hover:underline">Lihat Detail</a>
                                
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
                        @if (!empty($search))
                            <p>Tidak ditemukan barang dengan kata "<strong>{{ $search }}</strong>".</p>
                        @else
                            <p>Belum ada laporan barang hilang yang diterima oleh Admin.</p>
                        @endif
                    </div>
                @endforelse
            </div>
            
            <div class="mt-6">
                {{ $barangHilangs->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
