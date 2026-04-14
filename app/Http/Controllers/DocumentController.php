<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Services\DocumentSecurity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class DocumentController extends Controller
{
    protected $security;

    public function __construct(DocumentSecurity $security)
    {
        $this->security = $security;
    }

    /**
     * Download dokumen original
     */
    public function download(Document $document)
    {
        if (!Storage::disk('public')->exists($document->file_path)) {
            abort(404, 'File tidak ditemukan');
        }

        // Log access
        $this->security->logAccess($document, 'download');

        return Storage::disk('public')->download($document->file_path, $document->file_name);
    }

    /**
     * Download dokumen dengan QR Code embedded
     */
    public function downloadEmbedded(Document $document)
    {
        // Check if embedded version exists
        if (!$document->hasEmbeddedQR()) {
            return back()->with('error', 'Dokumen dengan QR Code tidak tersedia. Silakan generate terlebih dahulu.');
        }

        // Check if file exists
        if (!Storage::disk('public')->exists($document->embedded_document_path)) {
            return back()->with('error', 'File dengan QR Code tidak ditemukan di server.');
        }

        // Log access
        $this->security->logAccess($document, 'download_embedded', 'Downloaded document with embedded QR code');

        // Generate filename
        $fileName = 'VERIFIED-' . pathinfo($document->file_name, PATHINFO_FILENAME) . '.pdf';

        return Storage::disk('public')->download($document->embedded_document_path, $fileName);
    }

    /**
     * Generate QR Code embedded secara manual
     */
    public function generateEmbeddedQR(Document $document)
    {
        try {
            // Check if already exists
            if ($document->hasEmbeddedQR()) {
                return back()->with('info', 'QR Code sudah tertanam di dokumen ini.');
            }

            // Check if document is confidential
            if (!$document->is_confidential) {
                return back()->with('error', 'Hanya dokumen rahasia yang bisa mendapatkan QR Code embedded.');
            }

            // Check if original file exists
            if (!Storage::disk('public')->exists($document->file_path)) {
                return back()->with('error', 'File asli tidak ditemukan.');
            }

            Log::info('Manually generating embedded QR for document ID: ' . $document->id);

            // Generate multi-layer hash with embedding
            $hashes = $this->security->generateMultiLayerHashWithEmbedding($document);

            // Update document
            $document->update([
                'embedded_document_path' => $hashes['embedded_document_path']
            ]);

            // Log action
            $this->security->logAccess($document, 'generate_embedded_qr', 'Manually generated embedded QR code');

            return back()->with('success', 'QR Code berhasil di-generate dan ditempelkan ke dokumen!');
        } catch (\Exception $e) {
            Log::error('Failed to generate embedded QR: ' . $e->getMessage());
            return back()->with('error', 'Gagal generate QR Code: ' . $e->getMessage());
        }
    }

    /**
     * API: Check if document has embedded QR
     */
    public function hasEmbeddedQR($id)
    {
        try {
            $document = Document::findOrFail($id);

            return response()->json([
                'success' => true,
                'has_embedded_qr' => $document->hasEmbeddedQR(),
                'embedded_path' => $document->embedded_document_path,
                'is_confidential' => $document->is_confidential,
                'document_info' => [
                    'id' => $document->id,
                    'title' => $document->title,
                    'file_type' => $document->file_type,
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 404);
        }
    }
}
