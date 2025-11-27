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
                    'Tanggal Kehilangan' => $item->tgl_kehilangan ? \Carbon\Carbon::parse($item->tgl_kehilangan)->format('d-m-Y') : '-',
                    'Lokasi Kehilangan' => $item->lokasi_kehilangan ?? '-',
                    'Status' => ucfirst($item->status),
                ];
            });
    }

    /**
     * Judul kolom Excel
     */
    public function headings(): array
    {
        return ['Nama Barang', 'Pelapor', 'Tanggal Kehilangan', 'Lokasi Kehilangan', 'Status'];
    }
}
