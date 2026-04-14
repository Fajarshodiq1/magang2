<?php

namespace App\Services;

use App\Models\Document;
use App\Models\DocumentAccessLog;
use App\Models\DocumentHashHistory;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use TCPDF; // Gunakan TCPDF

class DocumentSecurity
{
    /**
     * Generate document hash = MD5 murni dari isi file.
     * Hash ini identik dengan output `md5sum file.pdf` di terminal.
     * Berlaku sebagai bukti integritas file yang bisa diverifikasi siapapun.
     */
    public function generateDocumentHash(Document $document): string
    {
        if (!$document->file_path) {
            throw new \Exception("File path tidak ada pada dokumen ID: {$document->id}");
        }

        $fullPath = storage_path('app/public/' . $document->file_path);

        if (!file_exists($fullPath)) {
            throw new \Exception("File tidak ditemukan: {$document->file_path}");
        }

        return md5_file($fullPath);
    }



    /**
     * Generate hash untuk file content (alias generateDocumentHash).
     * Dipertahankan untuk kompatibilitas pemanggil lama.
     */
    public function generateFileContentHash(Document $document): string
    {
        return $this->generateDocumentHash($document);
    }
    /**
     * Generate MD5 checksum untuk file (alias generateDocumentHash).
     * Dipertahankan untuk kompatibilitas pemanggil lama.
     */
    public function generateFileChecksum(string $filePath): string
    {
        $fullPath = storage_path('app/public/' . $filePath);

        if (!file_exists($fullPath)) {
            throw new \Exception("File tidak ditemukan: {$filePath}");
        }

        return md5_file($fullPath);
    }
    /**
     * Generate hash untuk metadata saja (title, user_id, dll).
     * Digunakan untuk mendeteksi perubahan metadata — TERPISAH dari hash file.
     */
    private function generateMetadataHash(Document $document): string
    {
        $metadata = [
            'title'                     => (string) $document->title,
            'description'               => (string) $document->description,
            'file_name'                 => (string) $document->file_name,
            'file_size'                 => (int) $document->file_size,
            'user_id'                   => (int) $document->user_id,
            'archive_classification_id' => (int) $document->archive_classification_id,
            'document_id'               => (int) $document->id,
        ];

        return hash('md5', json_encode($metadata));
    }


    /**
     * Generate multi-layer hash.
     *
     * Catatan perubahan skema:
     *   document_hash  = md5_file() — hash file murni, bisa diverifikasi eksternal
     *   file_hash      = md5_file() — sama dengan document_hash (alias)
     *   checksum       = md5_file() — sama dengan document_hash (alias)
     *   metadata_hash  = md5(json(metadata)) — hash metadata terpisah
     */
    public function generateMultiLayerHash(Document $document): array
    {
        $fileHash = $this->generateDocumentHash($document);

        return [
            'document_hash' => $fileHash,
            'file_hash'     => $fileHash,
            'checksum'      => $fileHash,
            'metadata_hash' => $this->generateMetadataHash($document),
            'timestamp'     => now()->timestamp,
        ];
    }
    /**
     * Embed QR Code ke dokumen
     */
    public function embedQRToDocument(Document $document): string
    {
        try {
            Log::info('Starting QR embed for document ID: ' . $document->id);

            if (!$document->document_hash) {
                throw new \Exception('Document hash belum di-generate. Generate hash terlebih dahulu.');
            }

            if (!$document->file_path) {
                throw new \Exception('File path tidak ditemukan pada dokumen.');
            }

            $fullPath = storage_path('app/public/' . $document->file_path);
            if (!file_exists($fullPath)) {
                throw new \Exception("File tidak ditemukan: {$fullPath}");
            }

            $qrCodePath = $document->qr_code_path
                ? $document->qr_code_path
                : $this->generateOwnershipQR($document);

            Log::info("QR Code path: {$qrCodePath}");

            $fileType = strtolower($document->file_type);

            if ($fileType === 'pdf') {
                $embeddedPath = $this->embedQRToPDF($document, $qrCodePath);
            } else {
                $embeddedPath = $this->createPDFWrapperWithQR($document, $qrCodePath);
            }

            // Hitung MD5 file embedded setelah berhasil dibuat
            $embeddedFullPath = storage_path('app/public/' . $embeddedPath);

            if (!file_exists($embeddedFullPath)) {
                throw new \Exception("File embedded tidak ditemukan setelah proses: {$embeddedFullPath}");
            }

            $embeddedHash = md5_file($embeddedFullPath);

            // Simpan path dan hash file embedded ke database
            $document->updateQuietly([
                'embedded_document_path' => $embeddedPath,
                'embedded_document_hash' => $embeddedHash,
            ]);

            Log::info("QR successfully embedded. Path: {$embeddedPath}, Hash: {$embeddedHash}");

            return $embeddedPath;
        } catch (\Exception $e) {
            Log::error('embedQRToDocument failed: ' . $e->getMessage());
            Log::error('Stack: ' . $e->getTraceAsString());
            throw $e;
        }
    }

    /**
     * Embed QR Code ke file PDF menggunakan TCPDF + FPDI
     */
    private function embedQRToPDF(Document $document, string $qrCodePath): string
    {
        try {
            Log::info("Starting embedQRToPDF for document ID: {$document->id}");

            $originalPath = storage_path('app/public/' . $document->file_path);
            $qrImagePath  = storage_path('app/public/' . $qrCodePath);

            Log::info("Original PDF path: {$originalPath}");
            Log::info("QR Image path: {$qrImagePath}");

            if (!file_exists($originalPath)) {
                throw new \Exception("Original PDF not found: {$originalPath}");
            }

            if (!file_exists($qrImagePath)) {
                throw new \Exception("QR Code image not found: {$qrImagePath}");
            }

            $finfo    = finfo_open(FILEINFO_MIME_TYPE);
            $mimeType = finfo_file($finfo, $originalPath);
            finfo_close($finfo);

            if ($mimeType !== 'application/pdf') {
                throw new \Exception("File is not a PDF. Detected type: {$mimeType}");
            }

            Log::info("File validation passed");

            $pdf = new \setasign\Fpdi\Tcpdf\Fpdi(
                PDF_PAGE_ORIENTATION,
                PDF_UNIT,
                PDF_PAGE_FORMAT,
                true,
                'UTF-8',
                false
            );

            $pdf->SetCreator('Document Management System');
            $pdf->SetAuthor($document->user->name ?? 'System');
            $pdf->SetTitle('Verified - ' . $document->title);
            $pdf->SetSubject('Verified Document with QR Code');
            $pdf->SetKeywords('verified, qr-code, secure, document');

            $pdf->setPrintHeader(false);
            $pdf->setPrintFooter(false);
            $pdf->SetMargins(0, 0, 0);
            $pdf->SetAutoPageBreak(false, 0);

            Log::info("FPDI initialized");

            try {
                $pageCount = $pdf->setSourceFile($originalPath);
                Log::info("PDF has {$pageCount} page(s)");

                if ($pageCount < 1) {
                    throw new \Exception("PDF has no pages");
                }
            } catch (\Exception $e) {
                Log::error("Failed to set source file: " . $e->getMessage());
                throw new \Exception(
                    "Gagal membaca PDF original: " . $e->getMessage() .
                        ". File mungkin corrupt atau terenkripsi."
                );
            }

            for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
                Log::info("Processing page {$pageNo}/{$pageCount}");

                try {
                    $templateId = $pdf->importPage($pageNo);
                    $size       = $pdf->getTemplateSize($templateId);

                    if (!$size || !isset($size['width']) || !isset($size['height'])) {
                        throw new \Exception("Failed to get page size for page {$pageNo}");
                    }

                    $pageWidth  = $size['width'];
                    $pageHeight = $size['height'];

                    Log::info("Page {$pageNo} size: {$pageWidth} x {$pageHeight}");

                    $orientation = ($pageWidth > $pageHeight) ? 'L' : 'P';

                    $pdf->AddPage($orientation, [$pageWidth, $pageHeight]);
                    $pdf->useTemplate($templateId, 0, 0, $pageWidth, $pageHeight, true);

                    Log::info("Page {$pageNo} template applied");

                    // Tambahkan QR Code di pojok kanan bawah setiap halaman
                    $qrSize = 20; // mm
                    $margin  = 5; // mm dari tepi

                    $qrX = $pageWidth  - $qrSize - $margin;
                    $qrY = $pageHeight - $qrSize - $margin;

                    Log::info("Adding QR Code to page {$pageNo} at X={$qrX}, Y={$qrY}");

                    try {
                        $pdf->Image(
                            $qrImagePath,
                            $qrX,
                            $qrY,
                            $qrSize,
                            $qrSize,
                            'PNG',
                            '',
                            '',
                            false,
                            300,
                            '',
                            false,
                            false,
                            0,
                            false,
                            false,
                            false
                        );
                        Log::info("QR Code added to page {$pageNo} successfully");
                    } catch (\Exception $e) {
                        Log::error("Failed to add QR image on page {$pageNo}: " . $e->getMessage());
                        throw new \Exception(
                            "Gagal menambahkan QR Code pada halaman {$pageNo}: " . $e->getMessage()
                        );
                    }
                } catch (\Exception $e) {
                    Log::error("Error processing page {$pageNo}: " . $e->getMessage());
                    throw new \Exception("Gagal memproses halaman {$pageNo}: " . $e->getMessage());
                }
            }

            $timestamp   = time();
            $baseName    = pathinfo($document->file_name, PATHINFO_FILENAME);
            $newFileName = 'documents/verified-' . $timestamp . '-' . $baseName . '.pdf';
            $newFilePath = storage_path('app/public/' . $newFileName);

            Log::info("Saving new PDF to: {$newFilePath}");

            $dir = dirname($newFilePath);
            if (!file_exists($dir)) {
                if (!mkdir($dir, 0755, true)) {
                    throw new \Exception("Failed to create directory: {$dir}");
                }
                Log::info("Created directory: {$dir}");
            }

            if (!is_writable($dir)) {
                throw new \Exception("Directory is not writable: {$dir}");
            }

            try {
                $pdf->Output($newFilePath, 'F');
                Log::info("PDF saved successfully");
            } catch (\Exception $e) {
                Log::error("Failed to output PDF: " . $e->getMessage());
                throw new \Exception("Gagal menyimpan PDF: " . $e->getMessage());
            }

            if (!file_exists($newFilePath)) {
                throw new \Exception("PDF file was not created at: {$newFilePath}");
            }

            $fileSize = filesize($newFilePath);
            Log::info("PDF file created successfully. Size: {$fileSize} bytes");

            if ($fileSize < 1000) {
                throw new \Exception(
                    "Generated PDF file is too small ({$fileSize} bytes). Probably corrupt."
                );
            }

            Log::info("QR Code embedded to all {$pageCount} page(s): {$newFileName}");

            return $newFileName;
        } catch (\Exception $e) {
            Log::error('embedQRToPDF failed: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());

            if (isset($newFilePath) && file_exists($newFilePath)) {
                @unlink($newFilePath);
                Log::info("Cleaned up corrupt PDF file");
            }

            throw $e;
        }
    }

    /**
     * Buat PDF wrapper untuk file non-PDF dengan QR Code menggunakan TCPDF
     */
    private function createPDFWrapperWithQR(Document $document, string $qrCodePath): string
    {
        try {
            Log::info("Creating PDF wrapper for document ID: {$document->id}");

            $qrImagePath = storage_path('app/public/' . $qrCodePath);

            if (!file_exists($qrImagePath)) {
                throw new \Exception("QR Code image not found: {$qrImagePath}");
            }

            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

            $pdf->SetCreator('Document Management System');
            $pdf->SetAuthor($document->user->name ?? 'System');
            $pdf->SetTitle('Verified - ' . $document->title);
            $pdf->SetSubject('Document Verification Certificate');

            $pdf->setPrintHeader(false);
            $pdf->setPrintFooter(false);
            $pdf->SetMargins(15, 15, 15);
            $pdf->SetAutoPageBreak(true, 15);

            $pdf->AddPage();

            Log::info("PDF initialized");

            $pdf->SetFont('helvetica', 'B', 20);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(0, 12, 'DOKUMEN TERVERIFIKASI', 0, 1, 'C');
            $pdf->Ln(3);

            $pdf->SetDrawColor(66, 133, 244);
            $pdf->SetLineWidth(0.8);
            $pdf->Line(15, $pdf->GetY(), 195, $pdf->GetY());
            $pdf->Ln(8);

            $pdf->SetFillColor(245, 245, 245);
            $pdf->SetDrawColor(200, 200, 200);
            $pdf->SetLineWidth(0.3);

            $boxY = $pdf->GetY();
            $pdf->RoundedRect(15, $boxY, 180, 75, 3, '1111', 'DF');

            $pdf->SetXY(20, $boxY + 8);
            $pdf->SetFont('helvetica', '', 11);
            $pdf->SetTextColor(60, 60, 60);

            $pdf->Cell(45, 7, 'Judul Dokumen:', 0, 0);
            $pdf->SetFont('helvetica', 'B', 11);
            $pdf->MultiCell(0, 7, $document->title, 0, 'L');

            $pdf->SetX(20);
            $pdf->SetFont('helvetica', '', 11);
            $pdf->Cell(45, 7, 'Tipe File:', 0, 0);
            $pdf->SetFont('helvetica', 'B', 11);
            $pdf->Cell(0, 7, strtoupper($document->file_type), 0, 1);

            $pdf->SetX(20);
            $pdf->SetFont('helvetica', '', 11);
            $pdf->Cell(45, 7, 'Ukuran File:', 0, 0);
            $pdf->SetFont('helvetica', 'B', 11);
            $pdf->Cell(0, 7, $document->formatted_file_size, 0, 1);

            $pdf->SetX(20);
            $pdf->SetFont('helvetica', '', 11);
            $pdf->Cell(45, 7, 'Pemilik:', 0, 0);
            $pdf->SetFont('helvetica', 'B', 11);
            $pdf->Cell(0, 7, $document->user->name, 0, 1);

            $pdf->SetX(20);
            $pdf->SetFont('helvetica', '', 11);
            $pdf->Cell(45, 7, 'Tanggal Dibuat:', 0, 0);
            $pdf->SetFont('helvetica', 'B', 11);
            $pdf->Cell(0, 7, $document->created_at->format('d F Y H:i'), 0, 1);

            if ($document->archiveClassification) {
                $pdf->SetX(20);
                $pdf->SetFont('helvetica', '', 11);
                $pdf->Cell(45, 7, 'Klasifikasi:', 0, 0);
                $pdf->SetFont('helvetica', 'B', 11);
                $pdf->MultiCell(
                    0,
                    7,
                    $document->archiveClassification->code . ' - ' . $document->archiveClassification->name,
                    0,
                    'L'
                );
            }

            $pdf->Ln(12);

            $pdf->SetFont('helvetica', 'B', 16);
            $pdf->SetTextColor(66, 133, 244);
            $pdf->Cell(0, 8, 'QR Code Verifikasi', 0, 1, 'C');
            $pdf->Ln(5);

            $qrSize    = 70;
            $pageWidth = $pdf->getPageWidth();
            $qrX       = ($pageWidth - $qrSize) / 2;
            $qrY       = $pdf->GetY();

            $pdf->SetFillColor(255, 255, 255);
            $pdf->SetDrawColor(66, 133, 244);
            $pdf->SetLineWidth(1.5);
            $pdf->RoundedRect($qrX - 6, $qrY - 6, $qrSize + 12, $qrSize + 12, 4, '1111', 'DF');

            $pdf->Image(
                $qrImagePath,
                $qrX,
                $qrY,
                $qrSize,
                $qrSize,
                'PNG',
                '',
                '',
                false,
                300,
                '',
                false,
                false,
                0,
                false,
                false,
                false
            );

            $pdf->Ln($qrSize + 18);

            $pdf->SetFillColor(230, 240, 255);
            $pdf->SetDrawColor(66, 133, 244);
            $pdf->SetLineWidth(0.5);

            $securityY = $pdf->GetY();
            $pdf->RoundedRect(15, $securityY, 180, 45, 3, '1111', 'DF');

            $pdf->SetXY(20, $securityY + 8);
            $pdf->SetFont('helvetica', 'B', 12);
            $pdf->SetTextColor(66, 133, 244);
            $pdf->Cell(0, 6, 'Informasi Keamanan', 0, 1, 'C');

            $pdf->SetX(20);
            $pdf->SetFont('helvetica', '', 9);
            $pdf->SetTextColor(60, 60, 60);

            $infoText  = "Dokumen ini dilindungi dengan teknologi hash MD5 dan QR Code terenkripsi.\n";
            $infoText .= "Scan QR Code untuk verifikasi keaslian dan integritas dokumen.\n\n";

            if ($document->document_hash) {
                $infoText .= "Document Hash (MD5 Original): " . $document->document_hash . "\n";
            }

            $infoText .= "Generated: " . now()->format('d F Y H:i:s');

            $pdf->MultiCell(160, 5, $infoText, 0, 'C');

            $pdf->SetAlpha(0.08);
            $pdf->SetFont('helvetica', 'B', 70);
            $pdf->SetTextColor(66, 133, 244);
            $pdf->StartTransform();
            $pdf->Rotate(45, 105, 148);
            $pdf->Text(25, 148, 'VERIFIED');
            $pdf->StopTransform();
            $pdf->SetAlpha(1);

            $pdf->SetY(-25);
            $pdf->SetFont('helvetica', 'I', 8);
            $pdf->SetTextColor(150, 150, 150);
            $pdf->Cell(0, 5, 'Document Management System - Verification Certificate', 0, 1, 'C');
            $pdf->Cell(0, 5, 'Printed: ' . now()->format('d F Y H:i:s'), 0, 0, 'C');

            $timestamp   = time();
            $baseName    = pathinfo($document->file_name, PATHINFO_FILENAME);
            $newFileName = 'documents/wrapper-' . $timestamp . '-' . $baseName . '.pdf';
            $newFilePath = storage_path('app/public/' . $newFileName);

            $dir = dirname($newFilePath);
            if (!file_exists($dir)) {
                mkdir($dir, 0755, true);
            }

            $pdf->Output($newFilePath, 'F');

            if (!file_exists($newFilePath) || filesize($newFilePath) < 1000) {
                throw new \Exception("Failed to create PDF wrapper");
            }

            Log::info("PDF wrapper created successfully: {$newFileName}");

            return $newFileName;
        } catch (\Exception $e) {
            Log::error('createPDFWrapperWithQR failed: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());

            if (isset($newFilePath) && file_exists($newFilePath)) {
                @unlink($newFilePath);
            }

            throw $e;
        }
    }



    /**
     * Generate multi-layer hash dengan embedded QR path
     */
    public function generateMultiLayerHashWithEmbedding(Document $document): array
    {
        $hashes = $this->generateMultiLayerHash($document);

        try {
            if (!$document->qr_code_path) {
                $qrPath = $this->generateOwnershipQR($document);
                $document->updateQuietly(['qr_code_path' => $qrPath]);
            }

            $embeddedPath = $this->embedQRToDocument($document);
            $hashes['embedded_document_path'] = $embeddedPath;

            Log::info("Successfully embedded QR to document ID {$document->id}: {$embeddedPath}");
        } catch (\Exception $e) {
            Log::error("Failed to embed QR for document ID {$document->id}: " . $e->getMessage());
            Log::error("Stack trace: " . $e->getTraceAsString());

            throw new \Exception("Gagal menyematkan QR Code: " . $e->getMessage());
        }

        return $hashes;
    }

    /**
     * Generate hash untuk metadata saja
     */
    // Alias untuk kompatibilitas metode lama yang memanggil generateMetadataHashOnly
    private function generateMetadataHashOnly(Document $document): string
    {
        return $this->generateMetadataHash($document);
    }

    /**
     * Verifikasi hash dokumen.
     *
     * Logika verifikasi:
     *   1. Hitung md5_file() dari file saat ini
     *   2. Bandingkan dengan document_hash yang tersimpan
     *   3. Jika berbeda → file telah dimodifikasi
     *   4. Periksa metadata_hash secara terpisah → deteksi perubahan metadata
     */
    public function verifyDocumentHash(Document $document): array
    {
        $results = [
            'valid'               => false,
            'document_hash_valid' => false,
            'file_hash_valid'     => false,
            'checksum_valid'      => false,
            'embedded_document_hash' => null,
            'embedded_hash_valid' => null, // null = tidak ada file embedded
            'messages'            => [],
            'changes_detected'    => [],
        ];

        if (!$document->file_path || !$document->document_hash) {
            $results['messages'][] = 'Hash dokumen belum di-generate';
            return $results;
        }

        if (!Storage::disk('public')->exists($document->file_path)) {
            $results['messages'][] = 'File tidak ditemukan';
            return $results;
        }

        try {
            // Hitung MD5 file original saat ini
            $currentFileHash = $this->generateDocumentHash($document);

            // 1. Verifikasi document_hash terhadap file original
            $results['document_hash_valid'] = ($currentFileHash === $document->document_hash);
            $results['file_hash_valid']     = ($currentFileHash === ($document->file_content_hash ?? $document->document_hash));
            $results['checksum_valid']      = ($currentFileHash === ($document->file_checksum ?? $document->document_hash));

            if (!$results['document_hash_valid']) {
                $results['changes_detected'][] = 'Isi file original telah berubah';
                $results['messages'][] = 'CRITICAL: File original telah dimodifikasi!';
            }

            // 2. Verifikasi file embedded (jika ada) — informasi tambahan saja
            if ($document->embedded_document_path && $document->embedded_document_hash) {
                $embeddedFullPath = storage_path('app/public/' . $document->embedded_document_path);
                $results['embedded_document_hash'] = $document->embedded_document_hash; // ← tambahkan ini

                if (file_exists($embeddedFullPath)) {
                    $currentEmbeddedHash = md5_file($embeddedFullPath);
                    $results['embedded_hash_valid'] = ($currentEmbeddedHash === $document->embedded_document_hash);

                    if (!$results['embedded_hash_valid']) {
                        $results['changes_detected'][] = 'File embedded (dengan QR) telah berubah';
                        $results['messages'][] = 'PERINGATAN: File dengan QR Code telah dimodifikasi!';
                    }
                } else {
                    $results['embedded_hash_valid'] = false;
                    $results['messages'][] = 'File embedded tidak ditemukan di storage.';
                }
            }

            // Keabsahan utama hanya berdasarkan file original
            $results['valid'] = $results['document_hash_valid']
                && $results['file_hash_valid']
                && $results['checksum_valid'];

            if ($results['valid']) {
                $results['messages'][] = 'File original asli dan tidak ada perubahan.';
            }

            $this->logHashVerification($document, $results);
        } catch (\Exception $e) {
            Log::error('Verify document hash failed: ' . $e->getMessage());
            $results['messages'][] = 'Error saat verifikasi: ' . $e->getMessage();
        }

        return $results;
    }


    /**
     * Log hasil verifikasi hash ke database
     */
    private function logHashVerification(Document $document, array $results): void
    {
        try {
            DocumentHashHistory::create([
                'document_id' => $document->id,
                'verification_type' => 'full_verification',
                'is_valid' => $results['valid'],
                'document_hash_valid' => $results['document_hash_valid'],
                'file_hash_valid' => $results['file_hash_valid'],
                'checksum_valid' => $results['checksum_valid'],
                'changes_detected' => json_encode($results['changes_detected']),
                'verified_by' => auth()->id(),
                'verified_at' => now(),
                'ip_address' => request()->ip(),
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to log hash verification: ' . $e->getMessage());
        }
    }

    /**
     * Generate QR Code dengan hash verification data
     */
    public function generateOwnershipQR(Document $document): string
    {
        try {
            Log::info('Generating QR Code for document ID: ' . $document->id);

            if (!$document->document_hash) {
                throw new \Exception('Document hash belum di-generate');
            }

            $token = substr(hash('md5', $document->id . $document->document_hash . config('app.key')), 0, 16);

            $verificationUrl = route('documents.public.verify', [
                'id' => $document->id,
                'token' => $token,
            ]);

            $qrCode = new \Endroid\QrCode\QrCode(
                data: $verificationUrl,
                size: 400,
                margin: 20
            );

            $writer = new PngWriter();
            $result = $writer->write($qrCode);

            $fileName = 'qr-codes/document-' . $document->id . '-' . time() . '.png';
            Storage::disk('public')->makeDirectory('qr-codes');
            Storage::disk('public')->put($fileName, $result->getString());

            Log::info('QR Code successfully generated: ' . $fileName);
            return $fileName;
        } catch (\Exception $e) {
            Log::error('Failed to generate QR Code: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Verifikasi QR Code dan compare dengan data dokumen
     */
    public function verifyQRCode(string $encryptedData, ?Document $document = null): array
    {
        try {
            $decryptedData = Crypt::decryptString($encryptedData);
            $qrData = json_decode($decryptedData, true);

            if (!$qrData) {
                return [
                    'valid' => false,
                    'message' => 'QR Code tidak valid atau rusak'
                ];
            }

            if ($document) {
                $verification = [
                    'qr_valid' => true,
                    'document_id_match' => $qrData['document_id'] == $document->id,
                    'hash_match' => $qrData['document_hash'] === $document->document_hash,
                    'owner_match' => $qrData['owner_id'] == $document->user_id,
                    'data' => $qrData,
                ];

                $verification['valid'] = $verification['document_id_match'] &&
                    $verification['hash_match'] &&
                    $verification['owner_match'];

                if (!$verification['valid']) {
                    $issues = [];
                    if (!$verification['document_id_match']) $issues[] = 'ID dokumen tidak cocok';
                    if (!$verification['hash_match']) $issues[] = 'Hash dokumen tidak cocok (file mungkin telah diubah)';
                    if (!$verification['owner_match']) $issues[] = 'Pemilik dokumen tidak cocok';

                    $verification['message'] = 'QR Code tidak valid: ' . implode(', ', $issues);
                } else {
                    $verification['message'] = 'QR Code valid dan dokumen asli';
                }

                $this->logAccess($document, 'qr_verify', json_encode($verification));

                return $verification;
            }

            return [
                'valid' => true,
                'message' => 'QR Code berhasil didekripsi',
                'data' => $qrData
            ];
        } catch (\Exception $e) {
            Log::error('QR Code verification failed: ' . $e->getMessage());
            return [
                'valid' => false,
                'message' => 'Gagal memverifikasi QR Code: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Generate semua security features untuk dokumen baru.
     * document_hash = md5_file() — MD5 murni dari isi file.
     */
    public function generateSecurityFeatures(Document $document): bool
    {
        DB::beginTransaction();
        try {
            if (!$document->file_path) {
                throw new \Exception('File path tidak ada');
            }

            $hashes = $this->generateMultiLayerHash($document);

            $document->updateQuietly([
                'document_hash'     => $hashes['document_hash'],
                'file_content_hash' => $hashes['file_hash'],
                'file_checksum'     => $hashes['checksum'],
                'metadata_hash'     => $hashes['metadata_hash'],
                'hash_algorithm'    => 'MD5',
                'hash_generated_at' => now(),
            ]);

            DocumentHashHistory::create([
                'document_id'         => $document->id,
                'verification_type'   => 'initial_generation',
                'document_hash'       => $hashes['document_hash'],
                'file_content_hash'   => $hashes['file_hash'],
                'file_checksum'       => $hashes['checksum'],
                'metadata_hash'       => $hashes['metadata_hash'],
                'is_valid'            => true,
                'document_hash_valid' => true,
                'file_hash_valid'     => true,
                'checksum_valid'      => true,
                'verified_by'         => auth()->id(),
                'verified_at'         => now(),
                'ip_address'          => request()->ip(),
            ]);

            // Generate QR Code
            $qrCodePath = $this->generateOwnershipQR($document);
            $document->updateQuietly([
                'qr_code_path'     => $qrCodePath,
                'last_verified_at' => now(),
            ]);

            // ✅ AUTO-EMBED QR ke dokumen langsung setelah upload
            try {
                $embeddedPath     = $this->embedQRToDocument($document);
                $embeddedFullPath = storage_path('app/public/' . $embeddedPath);
                $embeddedHash     = md5_file($embeddedFullPath);

                $document->updateQuietly([
                    'embedded_document_path' => $embeddedPath,
                    'embedded_document_hash' => $embeddedHash,
                ]);

                Log::info("QR auto-embedded on upload for document ID {$document->id}: {$embeddedPath}");
            } catch (\Exception $e) {
                // Jangan gagalkan seluruh proses jika embed gagal
                // Hash dan QR tetap tersimpan, embed bisa dicoba ulang
                Log::warning("Auto-embed QR failed for document ID {$document->id}: " . $e->getMessage());
            }

            $this->logAccess($document, 'security_generated', 'Initial security features generated');

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to generate security features for document ID ' . $document->id . ': ' . $e->getMessage());
            return false;
        }
    }


    /**
     * Regenerate security features.
     * document_hash di-reset ke md5_file() dari file saat ini.
     */
    public function regenerateSecurity(Document $document): bool
    {
        DB::beginTransaction();
        try {
            $oldHashes = [
                'document_hash'     => $document->document_hash,
                'file_content_hash' => $document->file_content_hash,
                'file_checksum'     => $document->file_checksum,
            ];

            $newHashes = $this->generateMultiLayerHash($document);

            $fileChanged = ($oldHashes['document_hash'] !== $newHashes['document_hash']);

            if ($fileChanged) {
                DocumentHashHistory::create([
                    'document_id'           => $document->id,
                    'verification_type'     => 'regeneration_with_changes',
                    'old_document_hash'     => $oldHashes['document_hash'],
                    'document_hash'         => $newHashes['document_hash'],
                    'old_file_content_hash' => $oldHashes['file_content_hash'],
                    'file_content_hash'     => $newHashes['file_hash'],
                    'old_file_checksum'     => $oldHashes['file_checksum'],
                    'file_checksum'         => $newHashes['checksum'],
                    'metadata_hash'         => $newHashes['metadata_hash'],
                    'is_valid'              => false,
                    'changes_detected'      => json_encode(['Isi file berubah saat regenerasi']),
                    'verified_by'           => auth()->id(),
                    'verified_at'           => now(),
                    'ip_address'            => request()->ip(),
                ]);

                Log::warning('Document ID ' . $document->id . ': file berubah saat regenerasi');
            }

            // Hapus QR Code lama
            if ($document->qr_code_path && Storage::disk('public')->exists($document->qr_code_path)) {
                Storage::disk('public')->delete($document->qr_code_path);
            }

            // Update hash baru ke database
            $document->updateQuietly([
                'document_hash'     => $newHashes['document_hash'],
                'file_content_hash' => $newHashes['file_hash'],
                'file_checksum'     => $newHashes['checksum'],
                'metadata_hash'     => $newHashes['metadata_hash'],
                'hash_generated_at' => now(),
            ]);

            // Generate QR Code baru
            $qrCodePath = $this->generateOwnershipQR($document);
            $document->updateQuietly([
                'qr_code_path'     => $qrCodePath,
                'last_verified_at' => now(),
            ]);

            // ✅ Hapus file embedded lama jika ada
            if (
                $document->embedded_document_path
                && Storage::disk('public')->exists($document->embedded_document_path)
            ) {
                Storage::disk('public')->delete($document->embedded_document_path);
                $document->updateQuietly([
                    'embedded_document_path' => null,
                    'embedded_document_hash' => null,
                ]);
            }

            // ✅ Re-embed QR ke dokumen dengan hash & QR yang sudah diperbarui
            try {
                $embeddedPath     = $this->embedQRToDocument($document);
                $embeddedFullPath = storage_path('app/public/' . $embeddedPath);
                $embeddedHash     = md5_file($embeddedFullPath);

                $document->updateQuietly([
                    'embedded_document_path' => $embeddedPath,
                    'embedded_document_hash' => $embeddedHash,
                ]);

                Log::info("QR re-embedded successfully for document ID {$document->id}: {$embeddedPath}");
            } catch (\Exception $e) {
                Log::warning("Re-embed QR failed on regenerate for document ID {$document->id}: " . $e->getMessage());
            }

            $this->logAccess(
                $document,
                'regenerate_security',
                $fileChanged
                    ? 'Security regenerated — file change detected'
                    : 'Security regenerated successfully'
            );

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Regenerate security failed for document ID ' . $document->id . ': ' . $e->getMessage());
            return false;
        }
    }
    /**
     * Verifikasi dokumen secara menyeluruh
     */
    public function verifyDocument(Document $document): array
    {
        $hashVerification = $this->verifyDocumentHash($document);

        $results = [
            'status'              => 'invalid',
            'file_integrity'      => $hashVerification['checksum_valid'],
            'hash_valid'          => $hashVerification['document_hash_valid'],
            'file_content_valid'  => $hashVerification['file_hash_valid'],
            'embedded_hash_valid' => $hashVerification['embedded_hash_valid'], // ✅ tambahkan
            'qr_exists'           => false,
            'messages'            => $hashVerification['messages'],
            'changes_detected'    => $hashVerification['changes_detected'],
            'overall_valid'       => $hashVerification['valid'],
        ];

        if ($document->qr_code_path && Storage::disk('public')->exists($document->qr_code_path)) {
            $results['qr_exists'] = true;
        }

        if ($results['overall_valid'] && $results['qr_exists']) {
            $results['status'] = 'verified';
        } elseif ($results['file_integrity'] || $results['hash_valid']) {
            $results['status'] = 'partial';
        } else {
            $results['status'] = 'failed';
        }

        if ($results['status'] === 'verified') {
            $document->updateQuietly(['last_verified_at' => now()]);
        }

        $this->logAccess($document, 'full_verify', "Status: {$results['status']}");

        return $results;
    }

    /**
     * Log akses dokumen
     */
    public function logAccess(Document $document, string $action, ?string $description = null): void
    {
        try {
            DocumentAccessLog::create([
                'document_id' => $document->id,
                'user_id' => auth()->id(),
                'action' => $action,
                'description' => $description,
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to log document access: ' . $e->getMessage());
        }
    }

    /**
     * Get hash verification history
     */
    public function getHashHistory(Document $document, int $limit = 50)
    {
        return DocumentHashHistory::where('document_id', $document->id)
            ->with('verifiedBy')
            ->orderBy('verified_at', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Check if document needs reverification
     */
    public function needsReverification(Document $document): bool
    {
        if (!$document->is_confidential) {
            return false;
        }

        if (!$document->last_verified_at) {
            return true;
        }

        return $document->last_verified_at->diffInDays(now()) > 30;
    }

    /**
     * Compare two documents' hashes
     */
    public function compareDocuments(Document $doc1, Document $doc2): array
    {
        return [
            'same_file' => $doc1->file_content_hash === $doc2->file_content_hash,
            'same_checksum' => $doc1->file_checksum === $doc2->file_checksum,
            'same_signature' => $doc1->document_hash === $doc2->document_hash,
            'comparison_date' => now()->format('Y-m-d H:i:s'),
        ];
    }
}