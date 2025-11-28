<?php

namespace App\Exports;

use App\Models\BarangHilang;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BarangHilangExport implements FromCollection, WithHeadings
{
    /**
     * Ambil semua data barang hilang (arsip)
     */
    public function collection()
    {
        return BarangHilang::with('user')
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
