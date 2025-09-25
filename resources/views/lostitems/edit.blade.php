<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Laporan Barang Hilang') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{-- Formulir ini mengirim data ke fungsi 'update' di BarangHilangController --}}
                    <form method="POST" action="{{ route('lostitems.update', $barangHilang) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH') {{-- Memberitahu Laravel ini adalah metode UPDATE --}}
                        
                        <!-- Nama Barang -->
                        <div>
                            <x-input-label for="nama_barang" :value="__('Nama Barang')" />
                            {{-- Mengisi input dengan data yang sudah ada --}}
                            <x-text-input id="nama_barang" class="block mt-1 w-full" type="text" name="nama_barang" :value="old('nama_barang', $barangHilang->nama_barang)" required autofocus />
                            <x-input-error :messages="$errors->get('nama_barang')" class="mt-2" />
                        </div>

                        <!-- Deskripsi -->
                        <div class="mt-4">
                            <x-input-label for="deskripsi_barang" :value="__('Deskripsi Barang (Ciri-ciri, merek, warna, dll.)')" />
                            {{-- Mengisi textarea dengan data yang sudah ada --}}
                            <textarea id="deskripsi_barang" name="deskripsi_barang" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>{{ old('deskripsi_barang', $barangHilang->deskripsi_barang) }}</textarea>
                            <x-input-error :messages="$errors->get('deskripsi_barang')" class="mt-2" />
                        </div>

                        <!-- Tanggal Kehilangan -->
                        <div class="mt-4">
                            <x-input-label for="tgl_kehilangan" :value="__('Perkiraan Tanggal Kehilangan')" />
                            <x-text-input id="tgl_kehilangan" class="block mt-1 w-full" type="date" name="tgl_kehilangan" :value="old('tgl_kehilangan', $barangHilang->tgl_kehilangan)" required />
                            <x-input-error :messages="$errors->get('tgl_kehilangan')" class="mt-2" />
                        </div>

                        <!-- Lokasi Kehilangan -->
                        <div class="mt-4">
                            <x-input-label for="lokasi_kehilangan" :value="__('Lokasi Terakhir Dilihat')" />
                            <x-text-input id="lokasi_kehilangan" class="block mt-1 w-full" type="text" name="lokasi_kehilangan" :value="old('lokasi_kehilangan', $barangHilang->lokasi_kehilangan)" required />
                            <x-input-error :messages="$errors->get('lokasi_kehilangan')" class="mt-2" />
                        </div>

                        <!-- Gambar -->
                        <div class="mt-4">
                            <x-input-label for="gambar" :value="__('Ganti Foto Barang (Opsional)')" />
                            <input id="gambar" name="gambar" type="file" class="block mt-1 w-full text-gray-900 dark:text-gray-100 border-gray-300 dark:border-gray-700 rounded-md p-2 bg-white dark:bg-gray-900">
                            {{-- Menampilkan gambar yang sudah ada saat ini --}}
                            @if ($barangHilang->gambar)
                                <div class="mt-2">
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Gambar saat ini:</p>
                                    <img src="{{ Storage::url($barangHilang->gambar) }}" alt="Gambar saat ini" class="w-32 h-32 object-cover rounded mt-1">
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

