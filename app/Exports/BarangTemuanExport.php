<?php

namespace App\Exports;

use App\Models\BarangTemuan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;

class BarangTemuanExport implements 
    FromCollection, 
    WithHeadings, 
    WithTitle, 
    WithEvents,
    WithDrawings
{
    private $rows;

    public function collection()
    {
        $this->rows = BarangTemuan::with('user')
            ->where('status', '!=', 'pending')
            ->latest()
            ->get()
            ->map(function ($item) {

                return [
                    'Nama Barang'   => $item->nama_barang,
                    'Pelapor'       => $item->user->name ?? '-',
                    'Tanggal Lapor' => $item->created_at 
                        ? $item->created_at->format('d-m-Y') 
                        : '-',
                    'Status'        => ucfirst($item->status),
                    'Gambar'        => '', // gambar diletakkan via Drawing()
                ];
            });

        return $this->rows;
    }

    public function headings(): array
    {
        return ['Nama Barang', 'Pelapor', 'Tanggal Lapor', 'Status', 'Gambar'];
    }

    public function title(): string
    {
        return 'Data Barang Temuan';
    }

    /**
     * Menambahkan gambar
     */
    public function drawings()
    {
        $drawings = [];

        // Ambil ulang data agar urutan sama dengan collection()
        $data = BarangTemuan::with('user')
            ->where('status', '!=', 'pending')
            ->latest()
            ->get();

        foreach ($data as $index => $barang) {

            if (!$barang->gambar) continue;

            $path = storage_path('app/public/' . $barang->gambar);
            if (!file_exists($path)) continue;

            $excelRow = $index + 2;

            $drawing = new Drawing();
            $drawing->setName('Foto');
            $drawing->setDescription('Foto Barang');
            $drawing->setPath($path);

            // ukuran & posisi agar rapi
            $drawing->setWidth(70);
            $drawing->setHeight(70);
            $drawing->setOffsetX(10);
            $drawing->setOffsetY(5);

            // letakkan di kolom E
            $drawing->setCoordinates('E' . $excelRow);

            $drawings[] = $drawing;
        }

        return $drawings;
    }

    /**
     * Styling sheet
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {

                $sheet = $event->sheet->getDelegate();

                // Tambah 3 baris judul
                $sheet->insertNewRowBefore(1, 3);

                $lastColumn = Coordinate::stringFromColumnIndex(count($this->headings()));

                // === Judul ===
                $sheet->setCellValue('A1', 'Laporan Barang Temuan');
                $sheet->setCellValue('A2', 'Rekap Data Sistem Lost & Found');
                $sheet->setCellValue('A3', 'Tanggal: ' . now()->format('d M Y'));

                $sheet->mergeCells("A1:{$lastColumn}1");
                $sheet->mergeCells("A2:{$lastColumn}2");
                $sheet->mergeCells("A3:{$lastColumn}3");

                $sheet->getStyle('A1:A3')->getFont()->setBold(true);
                $sheet->getStyle('A1')->getFont()->setSize(16);
                $sheet->getStyle('A2')->getFont()->setSize(14);

                $sheet->getStyle('A1:A3')->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);

                // === Header ===
                $sheet->getStyle("A4:{$lastColumn}4")->getFont()->setBold(true);
                $sheet->getStyle("A4:{$lastColumn}4")->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle("A4:{$lastColumn}4")->getFill()
                    ->setFillType(Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('FFA356F7');

                // === Border seluruh tabel ===
                $totalRows = count($this->rows) + 4;
                $range = "A4:{$lastColumn}{$totalRows}";

                $sheet->getStyle($range)->getBorders()->getAllBorders()
                    ->setBorderStyle(Border::BORDER_THIN);

                // === Kolom tetap stabil ===
                $sheet->getColumnDimension('A')->setWidth(25);
                $sheet->getColumnDimension('B')->setWidth(20);
                $sheet->getColumnDimension('C')->setWidth(18);
                $sheet->getColumnDimension('D')->setWidth(15);
                $sheet->getColumnDimension('E')->setWidth(20);

                // === Tinggi baris untuk gambar rapih ===
                for ($row = 5; $row <= $totalRows; $row++) {
                    $sheet->getRowDimension($row)->setRowHeight(75);
                }

                // === Tengah untuk kolom gambar ===
                $sheet->getStyle("E5:E{$totalRows}")->getAlignment()->setHorizontal('center');
                $sheet->getStyle("E5:E{$totalRows}")->getAlignment()->setVertical('center');
            },
        ];
    }
}
