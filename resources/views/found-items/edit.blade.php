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
            <h2 class="mb-8 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Edit Laporan Barang Temuan') }}
            </h2>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('found-items.update', $barangTemuan) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        
                        <!-- Nama Barang -->
                        <div>
                            <x-input-label for="nama_barang" :value="__('Nama Barang')" />
                            <x-text-input id="nama_barang" class="block mt-1 w-full" type="text" name="nama_barang" :value="old('nama_barang', $barangTemuan->nama_barang)" required autofocus />
                            <x-input-error :messages="$errors->get('nama_barang')" class="mt-2" />
                        </div>

                        <!-- Deskripsi -->
                        <div class="mt-4">
                            <x-input-label for="deskripsi_barang" :value="__('Deskripsi Barang')" />
                            <textarea id="deskripsi_barang" name="deskripsi_barang" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-purple-500 dark:focus:border-purple-600 focus:ring-purple-500 dark:focus:ring-purple-600 rounded-md shadow-sm" required>{{ old('deskripsi_barang', $barangTemuan->deskripsi_barang) }}</textarea>
                            <x-input-error :messages="$errors->get('deskripsi_barang')" class="mt-2" />
                        </div>

                        <!-- Tanggal Penemuan -->
                        <div class="mt-4">
                            <x-input-label for="tgl_penemuan" :value="__('Tanggal Penemuan')" />
                            <x-text-input id="tgl_penemuan" class="block mt-1 w-full" type="date" name="tgl_penemuan" :value="old('tgl_penemuan', $barangTemuan->tgl_penemuan)" required />
                            <x-input-error :messages="$errors->get('tgl_penemuan')" class="mt-2" />
                        </div>

                        <!-- Lokasi Penemuan -->
                        <div class="mt-4">
                            <x-input-label for="lokasi_penemuan" :value="__('Lokasi Penemuan')" />
                            <x-text-input id="lokasi_penemuan" class="block mt-1 w-full" type="text" name="lokasi_penemuan" :value="old('lokasi_penemuan', $barangTemuan->lokasi_penemuan)" required />
                            <x-input-error :messages="$errors->get('lokasi_penemuan')" class="mt-2" />
                        </div>

                        <!-- Gambar -->
                        <div class="mt-4">
                            <x-input-label for="gambar" :value="__('Ganti Foto Barang (Opsional)')" />
                            <input id="gambar" name="gambar" type="file" class="block mt-1 w-full text-gray-900 dark:text-gray-100 border-gray-300 dark:border-gray-700 rounded-md p-2 bg-white dark:bg-gray-900">
                            @if ($barangTemuan->gambar)
                                <div class="mt-2">
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Gambar saat ini:</p>
                                    <img src="{{ Storage::url($barangTemuan->gambar) }}" alt="Gambar saat ini" class="w-32 h-32 object-cover rounded mt-1">
                                </div>
                            @endif
                            <x-input-error :messages="$errors->get('gambar')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>
                                {{ __('Update Laporan') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
