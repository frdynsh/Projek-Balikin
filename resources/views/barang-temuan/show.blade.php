@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto mt-10 p-4 sm:p-6 lg:p-8">
    
    {{-- Header --}}
    <div class="mb-6 flex justify-between items-center">
        <h3 class="text-xl font-semibold text-gray-800">Daftar Barang Temuan</h3>
        <a href="{{ route('barang-temuan.create') }}" class="px-4 py-2 bg-red-600 text-white rounded-md shadow hover:bg-red-700">Tambah Barang</a>
    </div>

    {{-- Tabel --}}
    <div class="overflow-x-auto bg-white dark:bg-gray-800 rounded-lg shadow">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">No</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Nama Barang</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Deskripsi</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Tanggal Penemuan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Lokasi Penemuan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Gambar</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                @foreach ($items as $index => $item)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-200">{{ $index + 1 }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-200">{{ $item->nama_barang }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-200">{{ $item->deskripsi_barang }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-200">{{ $item->tgl_penemuan->format('d-m-Y') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-200">{{ $item->lokasi_penemuan }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($item->gambar)
                        <img src="{{ asset($item->gambar) }}" alt="Gambar" class="w-20 h-20 object-cover rounded">
                        @else
                        <span class="text-gray-400">Tidak ada</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('barang-temuan.edit', $item->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-2">Edit</a>
                        <form action="{{ route('barang-temuan.destroy', $item->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Jika tidak ada data --}}
    @if($items->isEmpty())
    <p class="mt-4 text-center text-gray-500 dark:text-gray-400">Belum ada barang temuan yang dilaporkan.</p>
    @endif

    
</div>
@endsection
