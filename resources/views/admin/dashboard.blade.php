<x-admin-layout>
    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="text-center grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                
                <div class="bg-purple-800 shadow-lg rounded-lg p-6 text-white">
                    <div class="flex flex-col">
                        <span class="text-sm font-medium text-purple-200 mb-2">Total Laporan Hilang</span>
                        <span class="text-5xl font-bold">{{ $totalLaporanHilang }}</span>
                    </div>
                </div>

                <div class="bg-purple-800 shadow-lg rounded-lg p-6 text-white">
                    <div class="flex flex-col">
                        <span class="text-sm font-medium text-purple-200 mb-2">Total Laporan Temuan</span>
                        <span class="text-5xl font-bold">{{ $totalLaporanTemuan }}</span>
                    </div>
                </div>
                <div class="bg-purple-800 shadow-lg rounded-lg p-6 text-white">
                    <div class="flex flex-col">
                        <span class="text-sm font-medium text-purple-200 mb-2">Laporan Perlu Validasi</span>
                        <span class="text-5xl font-bold">{{ $laporanPerluValidasi }}</span>
                    </div>
                </div>

                <div class="bg-purple-800 shadow-lg rounded-lg p-6 text-white">
                    <div class="flex flex-col">
                        <span class="text-sm font-medium text-purple-200 mb-2">Total Pengguna</span>
                        <span class="text-5xl font-bold">{{ $totalPengguna }}</span>
                    </div>
                </div>
            </div>

            <h2 class="text-2xl font-semibold text-gray-700 dark:text-gray-200 mb-4">Akses Cepat</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                
                <a href="{{ route('admin.validasi.lost-items.pending') }}" class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg flex flex-col items-center justify-center hover:shadow-xl transition-shadow border border-gray-200 dark:border-gray-700">
                    <div class="w-16 h-16 rounded-full bg-yellow-100 flex items-center justify-center mb-4">
                        <span class="text-3xl">🔍</span> 
                    </div>
                    <span class="font-medium text-gray-700 dark:text-gray-200 text-center">Validasi Laporan Hilang</span>
                </a>
                
                <a href="{{ route('admin.validasi.found-items.pending') }}" class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg flex flex-col items-center justify-center hover:shadow-xl transition-shadow border border-gray-200 dark:border-gray-700">
                    <div class="w-16 h-16 rounded-full bg-blue-100 flex items-center justify-center mb-4">
                        <span class="text-3xl">📦</span> 
                    </div>
                    <span class="font-medium text-gray-700 dark:text-gray-200 text-center">Validasi Laporan Temuan</span>
                </a>
                
                <a href="{{ route('admin.users.create') }}" class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg flex flex-col items-center justify-center hover:shadow-xl transition-shadow border border-gray-200 dark:border-gray-700">
                    <div class="w-16 h-16 rounded-full bg-green-100 flex items-center justify-center mb-4">
                        <span class="text-3xl">👤</span> 
                    </div>
                    <span class="font-medium text-gray-700 dark:text-gray-200 text-center">Tambah Admin Baru</span>
                </a>
                
                <!-- <a href="{{ route('admin.users.index') }}" class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg flex flex-col items-center justify-center hover:shadow-xl transition-shadow border border-gray-200 dark:border-gray-700">
                    <div class="w-16 h-16 rounded-full bg-pink-100 flex items-center justify-center mb-4">
                        <span class="text-3xl">👥</span> 
                    </div>
                    <span class="font-medium text-gray-700 dark:text-gray-200 text-center">Manajemen User</span>
                </a> -->
            </div>

            <h2 class="text-2xl font-semibold text-gray-700 dark:text-gray-200 mb-4">Aktivitas Terbaru</h2>
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 border border-gray-200 dark:border-gray-700">
                <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                    
                    @forelse ($aktivitasTerbaru as $item)
                        <li class="py-4 flex justify-between items-center">
                            <div class="flex items-center gap-3">
                                @if($item instanceof \App\Models\BarangHilang)
                                    <span class="px-2 py-0.5 text-xs font-semibold rounded-full bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">Laporan Hilang</span>
                                    <span class="font-medium text-gray-800 dark:text-gray-100">{{ $item->nama_barang }}</span>
                                @elseif($item instanceof \App\Models\BarangTemuan)
                                    <span class="px-2 py-0.5 text-xs font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">Laporan Temuan</span>
                                    <span class="font-medium text-gray-800 dark:text-gray-100">{{ $item->nama_barang }}</span>
                                @endif
                            </div>
                            <span class="text-sm text-gray-500 dark:text-gray-400">{{ $item->created_at->diffForHumans() }}</span>
                        </li>
                    @empty
                        <li class="py-4 text-center text-gray-500 dark:text-gray-400">
                            Belum ada aktivitas terbaru.
                        </li>
                    @endforelse

                </ul>
            </div>

        </div>
    </div>
</x-admin-layout>