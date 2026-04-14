<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DocumentTemplateExport implements FromArray, WithHeadings, WithStyles, WithColumnWidths, WithTitle
{
    public function array(): array
    {
        return [
            [
                'Dokumen Contoh 1',
                'Ini adalah deskripsi contoh dokumen',
                'KD-001',
                'Surat Masuk',
                '2024',
                'Asli',
                '1',
                'Lengkap dan baik',
                'DEF-001',
                'Rak A1',
                '5 Tahun',
                'Musnah',
                'Administrasi',
            ],
            [
                'Dokumen Contoh 2',
                'Deskripsi dokumen kedua',
                'KD-002',
                'Surat Keluar',
                '2024',
                'Asli',
                '1',
                'Lengkap dan baik',
                'DEF-002',
                'Rak A2',
                'Permanen',
                'Simpan Permanen',
                'Keuangan',
            ],
        ];
    }

    public function headings(): array
    {
        return [
            'Judul',
            'Deskripsi',
            'Kode Arsip',
            'Jenis Arsip',
            'Tahun',
            'Tingkat Perkembangan',
            'Jumlah',
            'Keterangan',
            'No. Definitif',
            'Lokasi Simpan',
            'Jangka Simpan',
            'Nasib Akhir',
            'Kategori',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Style untuk header
        $sheet->getStyle('A1:M1')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 12,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => '16A34A'],
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ]);

        // Style untuk data contoh
        $sheet->getStyle('A2:M3')->applyFromArray([
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'F0FDF4'],
            ],
        ]);

        // Border untuk semua cell
        $sheet->getStyle('A1:M3')->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => 'D1D5DB'],
                ],
            ],
        ]);

        // Auto-height untuk baris
        $sheet->getDefaultRowDimension()->setRowHeight(-1);

        // Freeze pane header
        $sheet->freezePane('A2');

        return [];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 30,  // Judul
            'B' => 40,  // Deskripsi
            'C' => 15,  // Kode Arsip
            'D' => 20,  // Jenis Arsip
            'E' => 10,  // Tahun
            'F' => 20,  // Tingkat Perkembangan
            'G' => 10,  // Jumlah
            'H' => 25,  // Keterangan
            'I' => 15,  // No. Definitif
            'J' => 20,  // Lokasi Simpan
            'K' => 15,  // Jangka Simpan
            'L' => 20,  // Nasib Akhir
            'M' => 20,  // Kategori
        ];
    }

    public function title(): string
    {
        return 'Template Import Dokumen';
    }
}
