<?php

namespace App\Exports;

use App\Models\Document;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithTitle;

class DocumentsExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnWidths, WithTitle
{
    protected $documents;

    public function __construct($documents = null)
    {
        $this->documents = $documents;
    }

    public function collection()
    {
        if ($this->documents) {
            return $this->documents;
        }

        return Document::with(['user', 'category'])->get();
    }

    public function headings(): array
    {
        return [
            'ID',
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
            'Nama File',
            'Tipe File',
            'Ukuran File',
            'User',
            'Email User',
            'Tanggal Upload',
            // ── Hash & Security ──
            'Document Hash (MD5)',
            'File Checksum (MD5)',
            'Hash Embedded+QR (MD5)',
            'Hash Algorithm',
            'Hash Generated At',
            'Security Level',
            'QR Code',
            'Embedded QR',
        ];
    }

    public function map($document): array
    {
        return [
            $document->id,
            $document->title,
            $document->description,
            $document->kode_arsip,
            $document->jenis_arsip,
            $document->tahun ? date('Y', strtotime($document->tahun)) : '',
            $document->tingkat_perkembangan,
            $document->jumlah,
            $document->keterangan,
            $document->no_definitif,
            $document->lokasi_simpan,
            $document->jangka_simpan,
            $document->nasib_akhir,
            $document->category ? $document->category->name : '',
            $document->file_name,
            strtoupper($document->file_type),
            $document->formatted_file_size,
            $document->user->name,
            $document->user->email,
            $document->created_at->format('d/m/Y H:i'),
            // ── Hash & Security ──
            $document->document_hash      ?? '-',
            $document->file_checksum      ?? '-',
            $document->embedded_document_hash ?? '-',
            $document->hash_algorithm     ?? '-',
            $document->hash_generated_at  ? $document->hash_generated_at->format('d/m/Y H:i') : '-',
            $this->formatSecurityLevel($document->security_level),
            $document->qr_code_path       ? 'Ada' : 'Tidak Ada',
            $document->embedded_document_path ? 'Ada' : 'Tidak Ada',
        ];
    }

    private function formatSecurityLevel(?string $level): string
    {
        return match ($level) {
            'rahasia'        => 'Rahasia',
            'sangat_rahasia' => 'Sangat Rahasia',
            default          => 'Normal',
        };
    }

    public function styles(Worksheet $sheet)
    {
        $lastRow = $sheet->getHighestRow();
        $lastCol = 'AB'; // kolom terakhir (28 kolom)

        $styles = [
            // ── Header row ──
            1 => [
                'font' => [
                    'bold'  => true,
                    'size'  => 11,
                    'color' => ['rgb' => 'FFFFFF'],
                ],
                'fill' => [
                    'fillType'   => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '16A34A'],
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ],
        ];

        // ── Warna header khusus kolom hash (U–AB) ──
        foreach (['U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB'] as $col) {
            $styles[$col . '1'] = [
                'font' => [
                    'bold'  => true,
                    'size'  => 11,
                    'color' => ['rgb' => 'FFFFFF'],
                ],
                'fill' => [
                    'fillType'   => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '5B21B6'], // ungu untuk kolom hash
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ];
        }

        // ── Wrap text + vertical align untuk kolom hash (data rows) ──
        if ($lastRow > 1) {
            foreach (['U', 'V', 'W'] as $col) {
                $sheet->getStyle($col . '2:' . $col . $lastRow)
                    ->getFont()
                    ->setName('Courier New')
                    ->setSize(9);

                $sheet->getStyle($col . '2:' . $col . $lastRow)
                    ->getAlignment()
                    ->setWrapText(true)
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
            }

            // ── Zebra striping pada seluruh data rows ──
            for ($row = 2; $row <= $lastRow; $row++) {
                if ($row % 2 === 0) {
                    $sheet->getStyle('A' . $row . ':' . $lastCol . $row)
                        ->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()->setRGB('F9FAFB');
                }
            }
        }

        // ── Border tipis seluruh tabel ──
        if ($lastRow > 1) {
            $sheet->getStyle('A1:' . $lastCol . $lastRow)
                ->getBorders()
                ->getAllBorders()
                ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
                ->getColor()->setRGB('E5E7EB');
        }

        // ── Tinggi header row ──
        $sheet->getRowDimension(1)->setRowHeight(22);

        return $styles;
    }

    public function columnWidths(): array
    {
        return [
            'A'  => 8,   // ID
            'B'  => 30,  // Judul
            'C'  => 40,  // Deskripsi
            'D'  => 15,  // Kode Arsip
            'E'  => 20,  // Jenis Arsip
            'F'  => 10,  // Tahun
            'G'  => 22,  // Tingkat Perkembangan
            'H'  => 10,  // Jumlah
            'I'  => 25,  // Keterangan
            'J'  => 15,  // No. Definitif
            'K'  => 20,  // Lokasi Simpan
            'L'  => 15,  // Jangka Simpan
            'M'  => 15,  // Nasib Akhir
            'N'  => 15,  // Kategori
            'O'  => 25,  // Nama File
            'P'  => 10,  // Tipe File
            'Q'  => 12,  // Ukuran File
            'R'  => 22,  // User
            'S'  => 28,  // Email User
            'T'  => 18,  // Tanggal Upload
            // ── Hash columns ──
            'U'  => 36,  // Document Hash (MD5) — 32 char hex
            'V'  => 36,  // File Checksum (MD5)
            'W'  => 36,  // Embedded Hash (MD5)
            'X'  => 14,  // Hash Algorithm
            'Y'  => 18,  // Hash Generated At
            'Z'  => 16,  // Security Level
            'AA' => 12,  // QR Code
            'AB' => 14,  // Embedded QR
        ];
    }

    public function title(): string
    {
        return 'Data Dokumen';
    }
}