<x-app-layout>
    <div class="py-24">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <h2 class="mb-8 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Detail Barang Hilang') }}
            </h2>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="md:flex">
                    {{-- Kolom untuk Gambar --}}
                    @if ($barangHilang->gambar)
                        <div class="md:w-1/2">
                            <img src="{{ Storage::url($barangHilang->gambar) }}" alt="{{ $barangHilang->nama_barang }}" class="w-full h-full object-cover">
                        </div>
                    @endif
                    
                    {{-- Kolom untuk Detail Teks --}}
                    <div class="p-8 md:w-1/2 space-y-4">
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $barangHilang->nama_barang }}</h3>
                        
                        <div class="space-y-2 text-gray-700 dark:text-gray-300">
                            <p><strong>Dilaporkan oleh:</strong> {{ $barangHilang->user->name }}</p>
                            <p><strong>Tanggal Kehilangan:</strong> {{ \Carbon\Carbon::parse($barangHilang->tgl_kehilangan)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</p>
                            <p><strong>Lokasi Terakhir Dilihat:</strong> {{ $barangHilang->lokasi_kehilangan }}</p>
                        </div>

                        <div class="mt-4 pt-4 border-t dark:border-gray-600">
                             <h4 class="font-semibold text-gray-900 dark:text-gray-100">Deskripsi Lengkap:</h4>
                             <p class="mt-2 text-gray-800 dark:text-gray-200 whitespace-pre-wrap">{{ $barangHilang->deskripsi_barang }}</p>
                        </div>

                        <div class="mt-6 pt-6 border-t dark:border-gray-600">
                            <h4 class="font-semibold text-gray-900 dark:text-gray-100">Kontak Pelapor:</h4>
                            @if ($barangHilang->user->nomor_telepon)
                                @php
                                    // Membersihkan nomor telepon dari spasi atau strip
                                    $telepon = str_replace([' ', '-', '+'], '', $barangHilang->user->nomor_telepon);
                                    // Mengganti awalan '0' dengan '62' untuk format WhatsApp internasional
                                    if (substr($telepon, 0, 1) === '0') {
                                        $wa_number = '62' . substr($telepon, 1);
                                    } else {
                                        $wa_number = $telepon;
                                    }
                                @endphp
                                <a href="https://wa.me/{{ $wa_number }}" target="_blank" class="mt-2 inline-flex items-center gap-x-2 rounded-md bg-green-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600">
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" />
                                    </svg>
                                    Hubungi via WhatsApp
                                </a>
                            @else
                                <p class="mt-2 text-sm text-gray-500">Pelapor tidak mencantumkan nomor telepon.</p>
                            @endif
                        </div>
                        
                        @if(auth()->id() === $barangHilang->user_id && $barangHilang->status === 'diterima')
                        <div class="mt-6 pt-6 border-t dark:border-gray-600">
                            <h4 class="font-semibold text-gray-900 dark:text-gray-100">Kelola Laporan</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Apakah barang ini sudah kembali ke tangan Anda?</p>
                            <form method="POST" action="{{ route('lost-items.markAsDone', $barangHilang) }}" class="mt-4">
                                @csrf
                                @method('PATCH')
                                <x-primary-button class="bg-blue-600 hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:ring-blue-500">
                                    Tandai sebagai Selesai
                                </x-primary-button>
                            </form>
                        </div>
                        @endif

                        <div class="mt-6 flex justify-end">
                            <a href="{{ route('lost-items.index') }}" class="text-indigo-600 dark:text-indigo-400 hover:underline">
                                Kembali ke Daftar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

