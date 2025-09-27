<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <h2 class="mb-8 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Validasi & Arsip Barang Temuan') }}
            </h2>
            @if (session('success'))
                <div class="p-4 mb-4 bg-green-100 text-green-700 rounded-lg dark:bg-green-800 dark:text-green-200 border border-green-300">
                    {{ session('success') }}
                </div>
            @endif

            <!-- TABEL VALIDASI (PENDING) -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg border border-gray-100 dark:border-gray-700">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-xl font-bold mb-4 border-b pb-2 dark:border-gray-700">Laporan Barang Temuan Menunggu Persetujuan</h3>
                    
                    <div class="mt-4 overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Barang</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Pelapor</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Tanggal Lapor</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse ($barangTemuanPending as $barang)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $barang->nama_barang }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $barang->user->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $barang->created_at->isoFormat('D MMM YYYY') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap flex items-center space-x-3">
                                        <!-- Form Setujui -->
                                        <form action="{{ route('admin.validasi.temuan.setujui', $barang->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="inline-flex items-center px-3 py-1 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                                Setujui
                                            </button>
                                        </form>
                                        
                                        <!-- Form Tolak -->
                                        <form action="{{ route('admin.validasi.temuan.tolak', $barang->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="inline-flex items-center px-3 py-1 bg-red-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                                Tolak
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="4" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">Tidak ada laporan barang temuan yang menunggu persetujuan.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- TABEL ARSIP (SELESAI, DITERIMA, DITOLAK) -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg border border-gray-100 dark:border-gray-700">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-xl font-bold mb-4 border-b pb-2 dark:border-gray-700">Arsip Laporan Barang Temuan (Telah Diproses)</h3>
                    <div class="mt-4 overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Barang</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Pelapor</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse ($barangTemuanSelesai as $barang)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $barang->nama_barang }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $barang->user->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <!-- Menampilkan status dengan badge warna yang sesuai -->
                                        @php
                                            $color = [
                                                'diterima' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300',
                                                'ditolak' => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300',
                                                'selesai' => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300',
                                                'menunggu' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300',
                                            ][$barang->status] ?? 'bg-gray-100 text-gray-800 dark:bg-gray-600 dark:text-gray-300';
                                        @endphp
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $color }}">
                                            {{ ucfirst($barang->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <!-- Tombol yang memicu Modal Kustom -->
                                        <button type="button" 
                                                data-id="{{ $barang->id }}"
                                                data-nama="{{ $barang->nama_barang }}"
                                                data-route="{{ route('found-items.destroy', $barang->id) }}"
                                                class="open-delete-modal text-red-600 hover:text-red-900 font-semibold text-sm">
                                            Hapus Permanen
                                        </button>
                                        {{-- Form asli (disembunyikan) yang akan disubmit oleh JS --}}
                                        <form id="delete-form-{{ $barang->id }}" action="{{ route('found-items.destroy', $barang->id) }}" method="POST" class="hidden">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="4" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">Tidak ada laporan barang temuan di arsip.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    <!-- MODAL KONFIRMASI HAPUS PERMANEN KUSTOM -->
    <div id="deleteModal" class="fixed inset-0 z-50 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Overlay -->
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

            <!-- Konten Modal -->
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <!-- Icon Merah (Konsisten untuk Aksi Hapus) -->
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.398 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100" id="modal-title">
                                Konfirmasi Hapus Permanen
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    Anda yakin ingin menghapus laporan <strong class="text-purple-600 dark:text-purple-400" id="item-name-placeholder"></strong> ini secara permanen?
                                    Aksi ini tidak dapat dibatalkan.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="bg-gray-50 dark:bg-gray-900 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <!-- Tombol Konfirmasi Hapus (Merah) -->
                    <button type="button" id="confirmDeleteButton" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm transition ease-in-out duration-150">
                        Hapus Sekarang
                    </button>
                    
                    <!-- Tombol Batal (Warna Tema Ungu/Purple) -->
                    <button type="button" id="cancelDeleteButton" class="mt-3 w-full inline-flex justify-center rounded-md border border-purple-500 shadow-sm px-4 py-2 bg-purple-500 text-base font-medium text-white hover:bg-purple-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 sm:mt-0 sm:w-auto sm:text-sm transition ease-in-out duration-150">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- TAUTAN KE FILE JAVASCRIPT EKSTERNAL -->
    <script src="{{ asset('assets/js/delete-modal.js') }}"></script>
</x-app-layout>
