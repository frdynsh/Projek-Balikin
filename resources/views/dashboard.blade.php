<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Beranda') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-12 text-gray-900 dark:text-gray-100">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                        {{-- Kolom Teks Sambutan --}}
                        <div class="space-y-6">
                            <h1 class="text-4xl font-bold text-gray-800 dark:text-white">
                                Selamat Datang di Balikin
                            </h1>
                            
                            <div class="space-y-4">
                                <div>
                                    <h3 class="font-semibold text-lg">Kamu kehilangan Sesuatu?</h3>
                                    <p class="text-gray-600 dark:text-gray-400">
                                        Coba cari di Menu <a href="{{ route('found-items.index') }}" class="text-indigo-600 dark:text-indigo-400 hover:underline font-semibold">Barang Temuan</a>
                                        atau <a href="{{ route('lost-items.create') }}" class="text-indigo-600 dark:text-indigo-400 hover:underline font-semibold">Tambah Laporan Kehilangan</a>.
                                    </p>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-lg">Kamu menemukan Sesuatu?</h3>
                                    <p class="text-gray-600 dark:text-gray-400">
                                        Bantu kembalikan dengan <a href="{{ route('found-items.create') }}" class="text-indigo-600 dark:text-indigo-400 hover:underline font-semibold">Tambah Laporan Penemuan</a>.
                                    </p>
                                </div>
                            </div>
                        </div>

                        {{-- Kolom Ilustrasi --}}
                        <div class="flex justify-center">
                            {{-- Anda bisa mengganti URL gambar ini dengan ilustrasi lain yang Anda suka --}}
                            <img src="{{ asset('images/ilustrasi.png') }}" alt="Ilustrasi Lost and Found" class="max-w-sm w-full">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
