<?php

namespace App\Exports;

use App\Models\BarangTemuan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Carbon\Carbon;

class BarangTemuanExport implements FromCollection, WithHeadings
{
    /**
     * Ambil semua data barang temuan (arsip)
     */
    public function collection()
    {
        return BarangTemuan::with('user')
            ->where('status', '!=', 'pending')
            ->latest()
            ->get()
            ->map(function($item) {
                return [
                    'Nama Barang' => $item->nama_barang,
                    'Pelapor' => $item->user->name ?? '-',
                    'Tanggal Temuan' => $item->tg_penemuan ? \Carbon\Carbon::parse($item->tg_penemuan)->format('d-m-Y') : '-',
                    'Lokasi Temuan' => $item->lokasi_temuan ?? '-',
                    'Status' => ucfirst($item->status),
                ];
            });
    }

    /**
     * Judul kolom Excel
     */
    public function headings(): array
    {
        return ['Nama Barang', 'Pelapor', 'Tanggal Temuan', 'Lokasi Temuan', 'Status'];
    }
}
