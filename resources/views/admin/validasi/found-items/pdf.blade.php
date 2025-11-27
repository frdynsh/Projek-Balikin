<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arsip Barang Temuan</title>
    <link href="{{ public_path('css/app.css') }}" rel="stylesheet">
</head>
<body class="p-6">
    <h1 class="text-2xl font-bold mb-4">Arsip Barang Temuan</h1>
    <table class="min-w-full border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="border px-4 py-2">Nama Barang</th>
                <th class="border px-4 py-2">Pelapor</th>
                <th class="border px-4 py-2">Tanggal Penemuan</th>
                <th class="border px-4 py-2">Lokasi Penemuan</th>
                <th class="border px-4 py-2">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($barangTemuanSelesai as $item)
                <tr>
                    <td class="border px-4 py-2">{{ $item->nama_barang }}</td>
                    <td class="border px-4 py-2">{{ $item->user->name }}</td>
                    <td class="border px-4 py-2">{{ $item->tgl_penemuan }}</td>
                    <td class="border px-4 py-2">{{ $item->lokasi_penemuan }}</td>
                    <td class="border px-4 py-2">{{ ucfirst($item->status) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
