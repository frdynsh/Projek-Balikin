<x-admin-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Arsip Laporan Barang Temuan') }}
                </h2>
                <a href="{{ route('admin.validasi.found-items.pending') }}" class="inline-flex items-center px-4 py-2 bg-purple-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-purple-500 active:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                    Lakukan Validasi
                </a>
            </div>
            
            @if (session('success'))
                <div class="p-4 mb-4 bg-green-100 text-green-700 rounded-lg dark:bg-green-900 dark:text-green-200 border border-green-300 dark:border-green-700">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-lg border border-gray-200 dark:border-gray-700">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-xl font-bold mb-4 border-b pb-2 border-gray-200 dark:border-gray-700">Arsip Laporan</h3>
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
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">{{ $barang->nama_barang }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">{{ $barang->user->name }}</td>
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
                                                data-id="{{ $barang->id }}"
                                                data-nama="{{ $barang->nama_barang }}"
                                                data-route="{{ route('found-items.destroy', $barang->id) }}"
                                                class="open-delete-modal text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300 font-semibold text-sm">
                                            Hapus Permanen
                                        </button>
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

    <div id="deleteModal" ...>
        </div>

    <script src="{{ asset('assets/js/delete-modal.js') }}"></script>
</x-admin-layout>