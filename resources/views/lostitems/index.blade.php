<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Daftar Barang Hilang') }}
            </h2>
            <a href="{{ route('lostitems.create') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
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

            {{-- Grid Layout --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($barangHilangs as $barang)
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg flex flex-col">
                    {{-- Gambar --}}
                    @if ($barang->gambar)
                    <img src="{{ Storage::url($barang->gambar) }}" alt="{{ $barang->nama_barang }}" class="w-full h-48 object-cover">
                    @else
                    <div class="w-full h-48 bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                        <span class="text-gray-500">Tidak ada gambar</span>
                    </div>
                    @endif

                    {{-- Isi Card --}}
                    <div class="p-6 flex flex-col flex-grow">
                        <h3 class="font-semibold text-lg text-gray-900 dark:text-gray-100">
                            {{ $barang->nama_barang }}
                        </h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                            Hilang pada: {{ \Carbon\Carbon::parse($barang->tgl_kehilangan)->isoFormat('D MMMM YYYY') }}
                        </p>
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            Lokasi: {{ $barang->lokasi_kehilangan }}
                        </p>
                        <p class="mt-2 text-gray-800 dark:text-gray-200 flex-grow">
                            {{ Str::limit($barang->deskripsi_barang, 100) }}
                        </p>
                        <p class="mt-4 text-xs text-gray-500">
                            Dilaporkan oleh: {{ $barang->user->name }}
                        </p>

                        {{-- 🔥 Tombol Aksi --}}
                        <div class="mt-4 flex space-x-2">
                            {{-- PASTIKAN HANYA USER PEMILIK YANG BISA MELAKUKAN EDIT/HAPUS --}}
                            @if (Auth::check() && Auth::id() === $barang->user_id)
                            <a href="{{ route('lostitems.edit', $barang->id) }}"
                                class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600 text-sm">
                                Edit
                            </a>

                            <form action="{{ route('lostitems.destroy', $barang->id) }}" method="POST" onsubmit="return confirm('Yakin ingin hapus?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 text-sm">
                                    Hapus
                                </button>
                            </form>
                            @else
                            {{-- Opsional: Tombol "Hubungi Pelapor" untuk user lain --}}
                            <a href="#" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 text-sm">
                                Telah Ditemukan?
                            </a>
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

            {{-- Paginasi --}}
            <div class="mt-6">
                {{ $barangHilangs->links() }}
            </div>
        </div>
    </div>
</x-app-layout>