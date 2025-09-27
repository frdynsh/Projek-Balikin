<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <h2 class="mb-8 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Validasi & Arsip Barang Temuan') }}
            </h2>
             @if (session('success'))
                <div class="p-4 mb-4 bg-green-200 text-green-800 rounded-lg dark:bg-green-800 dark:text-green-200">
                    {{ session('success') }}
                </div>
            @endif

            <!-- TABEL VALIDASI (PENDING) -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                     <h3 class="text-lg font-medium">Laporan Barang Temuan Menunggu Persetujuan</h3>
                     <div class="mt-4 overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-600">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Barang</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Pelapor</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Tanggal Lapor</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse ($barangTemuanPending as $barang)
                                <tr>
                                    <td class="px-6 py-4">{{ $barang->nama_barang }}</td>
                                    <td class="px-6 py-4">{{ $barang->user->name }}</td>
                                    <td class="px-6 py-4">{{ $barang->created_at->isoFormat('D MMM YYYY') }}</td>
                                    <td class="px-6 py-4 flex items-center space-x-4">
                                        <form action="{{ route('admin.validasi.temuan.setujui', $barang) }}" method="POST">@csrf @method('PATCH')<button type="submit" class="text-green-600 hover:text-green-900 font-semibold">Setujui</button></form>
                                        <form action="{{ route('admin.validasi.temuan.tolak', $barang) }}" method="POST">@csrf @method('PATCH')<button type="submit" class="text-red-600 hover:text-red-900 font-semibold">Tolak</button></form>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="4" class="px-6 py-4 text-center">Tidak ada laporan barang temuan yang menunggu persetujuan.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                     </div>
                </div>
            </div>

            <!-- TABEL ARSIP (SELESAI) -->
            <div class="bg-gray-200 dark:bg-gray-700 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                     <h3 class="text-lg font-medium">Arsip Laporan Barang Temuan (Selesai)</h3>
                     <div class="mt-4 overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-300 dark:divide-gray-600">
                            <thead class="bg-gray-100 dark:bg-gray-600">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Barang</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Pelapor</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse ($barangTemuanSelesai as $barang)
                                <tr>
                                    <td class="px-6 py-4">{{ $barang->nama_barang }}</td>
                                    <td class="px-6 py-4">{{ $barang->user->name }}</td>
                                    <td class="px-6 py-4">
                                        <form action="{{ route('found-items.destroy', $barang) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus permanen laporan ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 font-semibold">Hapus Permanen</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="3" class="px-6 py-4 text-center">Tidak ada laporan barang temuan yang sudah selesai.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                     </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
