<x-app-layout>
    <div class="py-24">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="mb-8 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Lapor Barang Temuan') }}
            </h2>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('found-items.store') }}" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Nama Barang -->
                        <div>
                            <x-input-label for="nama_barang" :value="__('Nama Barang Ditemukan')" />
                            <x-text-input id="nama_barang" class="block mt-1 w-full" type="text" name="nama_barang" :value="old('nama_barang')" required autofocus />
                        </div>

                        <!-- Deskripsi -->
                        <div class="mt-4">
                            <x-input-label for="deskripsi_barang" :value="__('Deskripsi Barang (Ciri-ciri, merek, warna, dll.)')" />
                            <textarea id="deskripsi_barang" name="deskripsi_barang" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm" required>{{ old('deskripsi_barang') }}</textarea>
                        </div>

                        <!-- Tanggal Penemuan -->
                        <div class="mt-4">
                            <x-input-label for="tgl_penemuan" :value="__('Tanggal Penemuan')" />
                            <x-text-input id="tgl_penemuan" class="block mt-1 w-full" type="date" name="tgl_penemuan" :value="old('tgl_penemuan')" required />
                        </div>

                        <!-- Lokasi Penemuan -->
                        <div class="mt-4">
                            <x-input-label for="lokasi_penemuan" :value="__('Lokasi Penemuan')" />
                            <x-text-input id="lokasi_penemuan" class="block mt-1 w-full" type="text" name="lokasi_penemuan" :value="old('lokasi_penemuan')" required />
                        </div>

                        <!-- Gambar -->
                        <div class="mt-4">
                            <x-input-label for="gambar" :value="__('Foto Barang')" />
                            <input id="gambar" name="gambar" type="file" class="block mt-1 w-full text-gray-900 dark:text-gray-100 border-gray-300 dark:border-gray-700 rounded-md p-2 bg-white dark:bg-gray-900" required>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>{{ __('Kirim Laporan') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
