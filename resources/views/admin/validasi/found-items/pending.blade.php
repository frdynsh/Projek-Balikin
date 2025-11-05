<x-admin-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Validasi Laporan Barang Temuan') }}
                </h2>
                <a href="{{ route('admin.validasi.found-items.index') }}" class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150">
                    Lihat Arsip
                </a>
            </div>

            @if (session('success'))
                <div class="p-4 mb-4 bg-green-100 text-green-700 rounded-lg dark:bg-green-900 dark:text-green-200 border border-green-300 dark:border-green-700">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-lg border border-gray-200 dark:border-gray-700">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-xl font-bold mb-4 border-b pb-2 border-gray-200 dark:border-gray-700">Menunggu Persetujuan</h3>
                    
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
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">{{ $barang->nama_barang }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">{{ $barang->user->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">{{ $barang->created_at->isoFormat('D MMM YYYY') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap flex items-center space-x-3">
                                        <form action="{{ route('admin.validasi.found-items.setujui', $barang->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="inline-flex items-center px-3 py-1 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                                Setujui
                                            </button>
                                        </form>
                                        
                                        <form action="{{ route('admin.validasi.found-items.tolak', $barang->id) }}" method="POST">
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
        </div>
    </div>
</x-admin-layout>