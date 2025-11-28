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
                    'Tanggal Lapor' => $item->created_at ? \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') : '-',
                    'Status' => ucfirst($item->status),
                ];
            });
    }

    /**
     * Judul kolom Excel
     */
    public function headings(): array
    {
        return ['Nama Barang', 'Pelapor', 'Tanggal Lapor', 'Status'];
    }
}
