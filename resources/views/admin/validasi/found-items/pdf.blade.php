<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Arsip Barang Temuan</title>

    <!-- Tailwind hasil compile Laravel -->
    <link href="{{ public_path('css/app.css') }}" rel="stylesheet">

    <style>
        body { font-family: sans-serif; font-size: 12px; }
        .table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .table th, .table td { border: 1px solid #000; padding: 6px; }
        .text-center { text-align: center; }
        .logo { position: absolute; top: 20px; left: 20px; width: 55px; border-radius: 50%; }
        .img-thumb { width: 45px; height: 45px; object-fit: cover; border-radius: 4px; }
    </style>
</head>

<body class="m-8">

    {{-- LOGO --}}
    <img src="{{ public_path('images/icon/logo.png') }}" class="logo" alt="Logo Balikin">

    {{-- HEADER --}}
    <div class="text-center" style="margin-bottom: 25px;">
        <h2 style="font-size: 18px; font-weight: bold;">SISTEM LOST & FOUND</h2>
        <h3 style="font-size: 14px; font-weight: bold; color:#b91c1c;">Rekap Arsip Barang Temuan</h3>
        <p>Dicetak pada: {{ now()->format('d/m/Y') }}</p>
    </div>

    {{-- TABLE --}}
    <table class="table">
        <thead class="text-white" style="background-color: #a356f7;">
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Gambar</th>
                <th>Pelapor</th>
                <th>Tanggal Lapor</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            @foreach($barangTemuanSelesai as $index => $item)
                <tr class="text-center">
                    <td>{{ $index + 1 }}</td>

                    <td>{{ $item->nama_barang }}</td>

                    {{-- Gambar Barang --}}
                    <td>
                        @if($item->gambar && file_exists(public_path('storage/' . $item->gambar)))
                            <img src="{{ public_path('storage/' . $item->gambar) }}" class="img-thumb">
                        @else
                            -
                        @endif
                    </td>

                    <td>{{ $item->user->name ?? '-' }}</td>
                    <td>{{ $item->created_at->format('d/m/Y') }}</td>
                    <td>{{ ucfirst($item->status) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- FOOTER --}}
    <div style="margin-top: 50px; text-align:center; font-size: 11px;">
        <table style="width:100%;">
            <tr>
                <td>Dicetak Oleh</td>
                <td>Disetujui Oleh</td>
            </tr>
            <tr>
                <td style="padding-top: 40px;">
                    ___________________<br>
                    Admin Lost & Found
                </td>
                <td style="padding-top: 40px;">
                    ___________________<br>
                    Supervisor
                </td>
            </tr>
        </table>
    </div>

</body>
</html>
