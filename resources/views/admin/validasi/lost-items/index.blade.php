<x-admin-layout>
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            {{-- HEADER --}}
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Barang Hilang') }}
                </h2>
                <div class="flex gap-3">
                    {{-- Export Excel --}}
                    <a href="{{ route('admin.validasi.lost-items.exportExcel') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 active:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                        Export Excel
                    </a>
                    
                    {{-- Export PDF --}}
                    <a href="{{ route('admin.validasi.lost-items.exportPdf') }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                        Export PDF
                    </a>

                    {{-- Validate Button --}}
                    <a href="{{ route('admin.validasi.lost-items.pending') }}" class="inline-flex items-center px-4 py-2 bg-purple-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-purple-500 active:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                        Lakukan Validasi
                    </a>
                </div>
            </div>

            {{-- ARSIP TABLE --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-lg border border-gray-200 dark:border-gray-700">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-xl font-bold mb-4 border-b pb-2 border-gray-200 dark:border-gray-700">Arsip Laporan</h3>
                    <div class="mt-4 overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Barang</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Pelapor</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Tanggal Lapor</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse ($barangHilangSelesai as $barang)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">{{ $barang->nama_barang }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">{{ $barang->user->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">
                                        {{ \Carbon\Carbon::parse($barang->created_at)->translatedFormat('d F Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $color = [
                                                'diterima' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300',
                                                'ditolak' => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300',
                                                'selesai' => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300',
                                            ][$barang->status] ?? 'bg-gray-100 text-gray-800 dark:bg-gray-600 dark:text-gray-300';
                                        @endphp
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $color }}">
                                            {{ ucfirst($barang->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <button type="button"
                                                data-name="{{ $barang->nama_barang }}"
                                                data-form="delete-form-{{ $barang->id }}"
                                                data-action="hapus"
                                                class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300 font-semibold text-sm">
                                            Hapus Permanen
                                        </button>
                                        <form id="delete-form-{{ $barang->id }}" action="{{ route('admin.validasi.lost-items.destroy', $barang->id) }}" method="POST" class="hidden">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="4" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">Tidak ada laporan barang hilang di arsip.</td></tr>
                                @endforelse
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-admin-layout>