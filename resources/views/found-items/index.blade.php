<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="mb-8 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Daftar Barang Temuan') }}
            </h2>
            @if (session('success'))
                <div class="mb-6 p-4 bg-green-200 text-green-800 rounded-lg dark:bg-green-800 dark:text-green-200">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($barangTemuans as $barang)
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
                                <a href="{{ route('found-items.show', $barang) }}" class="text-indigo-600 dark:text-indigo-400 hover:underline">Lihat Detail</a>
                                
                                <div class="flex space-x-2">
                                    @if (auth()->id() === $barang->user_id)
                                        <a href="{{ route('found-items.edit', $barang) }}" class="text-sm text-yellow-600 dark:text-yellow-400 hover:underline">Edit</a>
                                    @endif

                                    @if (auth()->user()->role === 'admin')
                                        <form action="{{ route('found-items.destroy', $barang) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus laporan ini?');">
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
                        <p>Belum ada laporan barang temuan yang disetujui oleh Admin.</p>
                    </div>
                @endforelse
            </div>
            
            <div class="mt-6">
                {{ $barangTemuans->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
