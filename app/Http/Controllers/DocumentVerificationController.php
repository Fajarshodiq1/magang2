<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Services\DocumentSecurity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentVerificationController extends Controller
{
    protected $security;

    public function __construct(DocumentSecurity $security)
    {
        $this->security = $security;
    }

    public function downloadEmbedded(Document $document)
    {
        if (!$document->hasEmbeddedQR()) {
            return back()->with('error', 'Dokumen dengan QR Code tidak tersedia');
        }

        $this->security->logAccess($document, 'download_embedded');

        $fileName = 'VERIFIED-' . $document->file_name;

        return Storage::disk('public')->download($document->embedded_document_path, $fileName);
    }

    public function publicVerify(int $id, string $token)
    {
        $document = Document::with(['user', 'archiveClassification', 'category'])
            ->findOrFail($id);

        // ✅ FIXED: Konsisten dengan DocumentSecurity::generateOwnershipQR()
        // MD5, substr 16 karakter
        $expectedToken = substr(
            hash('md5', $document->id . $document->document_hash . config('app.key')),
            0,
            16
        );

        if (!hash_equals($expectedToken, $token)) {
            return view('documents.verify-public', [
                'valid' => false,
                'message' => 'QR Code tidak valid atau dokumen telah dimodifikasi.',
                'document' => null,
                'scanned_at' => now(),
            ]);
        }

        // Verifikasi integritas file
        $verification = $this->security->verifyDocumentHash($document);

        // Log akses publik
        \App\Models\DocumentAccessLog::create([
            'document_id' => $document->id,
            'user_id'     => null,
            'action'      => 'qr_public_scan',
            'description' => 'Scanned via QR Code (public)',
            'ip_address'  => request()->ip(),
            'user_agent'  => request()->userAgent(),
        ]);

        return view('documents.verify-public', [
            'valid'        => $verification['valid'],
            'document'     => $document,
            'verification' => $verification,
            'scanned_at'   => now(),
        ]);
    }
    /**
     * Download publik — hanya untuk dokumen dengan security_level = normal
     * Token divalidasi ulang agar link tidak bisa dipalsukan
     */
    public function publicDownload(int $id, string $token)
    {
        $document = Document::with('user')->findOrFail($id);

        // Validasi token — sama persis dengan publicVerify()
        $expectedToken = substr(
            hash('md5', $document->id . $document->document_hash . config('app.key')),
            0,
            16
        );

        if (!hash_equals($expectedToken, $token)) {
            abort(403, 'Token tidak valid.');
        }

        // Hanya izinkan download jika dokumen tidak confidential ATAU security_level = normal
        $isPubliclyDownloadable = !$document->is_confidential
            || $document->security_level === 'normal';

        if (!$isPubliclyDownloadable) {
            abort(403, 'Dokumen ini bersifat rahasia dan tidak dapat diunduh secara publik.');
        }

        // Pastikan file ada
        if (!$document->file_path || !\Storage::disk('public')->exists($document->file_path)) {
            abort(404, 'File tidak ditemukan.');
        }

        // Log akses download publik
        \App\Models\DocumentAccessLog::create([
            'document_id' => $document->id,
            'user_id'     => null,
            'action'      => 'public_download',
            'description' => 'Downloaded via QR Code (public)',
            'ip_address'  => request()->ip(),
            'user_agent'  => request()->userAgent(),
        ]);

        return \Storage::disk('public')->download(
            $document->file_path,
            $document->file_name
        );
    }
    public function generateEmbeddedQR(Document $document)
    {
        try {
            // Hapus embedded lama jika ada
            if (
                $document->embedded_document_path
                && Storage::disk('public')->exists($document->embedded_document_path)
            ) {
                Storage::disk('public')->delete($document->embedded_document_path);
            }

            // Pastikan hash sudah ada, jika belum generate dulu
            if (!$document->document_hash) {
                $this->security->generateSecurityFeatures($document);
                $document->refresh();
            }

            // Embed QR langsung
            $embeddedPath     = $this->security->embedQRToDocument($document);
            $embeddedFullPath = storage_path('app/public/' . $embeddedPath);
            $embeddedHash     = md5_file($embeddedFullPath);

            $document->update([
                'embedded_document_path' => $embeddedPath,
                'embedded_document_hash' => $embeddedHash,
            ]);

            return back()->with('success', 'QR Code berhasil di-embed ke dokumen!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal embed QR Code: ' . $e->getMessage());
        }
    }

    /**
     * Tampilkan halaman verifikasi dokumen dengan detail hash
     */
    public function show($id)
    {
        $document = Document::with(['user', 'archiveClassification'])->findOrFail($id);

        $this->security->logAccess($document, 'verify');

        $verification = $this->security->verifyDocument($document);

        $hashHistory = $this->security->getHashHistory($document, 20);

        return view('documents.verify', compact('document', 'verification', 'hashHistory'));
    }

    /**
     * API endpoint untuk verifikasi hash secara real-time
     */
    public function verifyHash(Request $request, $id)
    {
        $document = Document::findOrFail($id);

        $verification = $this->security->verifyDocumentHash($document);

        $this->security->logAccess($document, 'api_verify_hash');

        return response()->json([
            'success'      => true,
            'verification' => $verification,
            'document'     => [
                'id'               => $document->id,
                'title'            => $document->title,
                'document_hash'    => $document->document_hash,
                'file_content_hash' => $document->file_content_hash,
                'file_checksum'    => $document->file_checksum,
                'last_verified_at' => $document->last_verified_at,
            ]
        ]);
    }

    /**
     * API endpoint untuk scan QR Code
     */
    public function verifyQR(Request $request, $id)
    {
        $document = Document::findOrFail($id);

        $scannedData = $request->input('qr_data');

        if (!$scannedData) {
            return response()->json([
                'success' => false,
                'message' => 'QR data tidak ditemukan'
            ], 400);
        }

        $result = $this->security->verifyQRCode($scannedData, $document);

        $this->security->logAccess(
            $document,
            'qr_verify',
            'QR verification: ' . ($result['valid'] ? 'valid' : 'invalid')
        );

        return response()->json([
            'success' => true,
            'result'  => $result
        ]);
    }

    /**
     * Download QR Code
     */
    public function downloadQR($id)
    {
        $document = Document::findOrFail($id);

        if (!$document->qr_code_path || !Storage::disk('public')->exists($document->qr_code_path)) {
            abort(404, 'QR Code tidak ditemukan');
        }

        $this->security->logAccess($document, 'download_qr');

        $fileName = "QR-{$document->title}-" . now()->format('Ymd') . ".png";

        return Storage::disk('public')->download($document->qr_code_path, $fileName);
    }

    /**
     * Tampilkan audit log dokumen
     */
    public function auditLogs($id)
    {
        $document = Document::with('user')->findOrFail($id);

        $logs = $document->accessLogs()
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(50);

        return view('documents.audit-log', [
            'document' => $document,
            'logs'     => $logs
        ]);
    }

    /**
     * Re-generate security features
     */
    public function regenerateSecurity($id)
    {
        $document = Document::findOrFail($id);

        try {
            $success = $this->security->regenerateSecurity($document);

            if ($success) {
                return back()->with('success', 'Security features berhasil di-generate ulang!');
            } else {
                return back()->with('error', 'Gagal generate ulang security features. Silakan coba lagi.');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    /**
     * Check integritas file via API
     */
    public function checkIntegrity($id)
    {
        $document = Document::findOrFail($id);

        $verification = $this->security->verifyDocumentHash($document);

        $this->security->logAccess($document, 'integrity_check');

        return response()->json([
            'success'       => true,
            'valid'         => $verification['valid'],
            'message'       => $verification['valid']
                ? 'File asli dan tidak ada perubahan'
                : 'PERINGATAN: File atau metadata telah dimodifikasi!',
            'details'       => $verification,
            'last_verified' => $document->last_verified_at
        ]);
    }

    /**
     * Get hash history untuk dokumen
     */
    public function hashHistory($id)
    {
        $document = Document::with('user')->findOrFail($id);

        $history = $this->security->getHashHistory($document, 100);

        return view('documents.hash-history', [
            'document' => $document,
            'history'  => $history
        ]);
    }

    /**
     * Compare hash antara dua dokumen
     */
    public function compareDocuments(Request $request)
    {
        $request->validate([
            'document1_id' => 'required|exists:documents,id',
            'document2_id' => 'required|exists:documents,id',
        ]);

        $doc1 = Document::findOrFail($request->document1_id);
        $doc2 = Document::findOrFail($request->document2_id);

        $comparison = $this->security->compareDocuments($doc1, $doc2);

        return response()->json([
            'success'    => true,
            'comparison' => $comparison,
            'documents'  => [
                'document1' => [
                    'id'    => $doc1->id,
                    'title' => $doc1->title,
                    'hash'  => $doc1->document_hash,
                ],
                'document2' => [
                    'id'    => $doc2->id,
                    'title' => $doc2->title,
                    'hash'  => $doc2->document_hash,
                ]
            ]
        ]);
    }
    /**
     * Download publik file DENGAN QR embed
     * Token sama dengan publicVerify() agar konsisten
     */
    public function publicDownloadEmbedded(int $id, string $token)
    {
        $document = Document::with('user')->findOrFail($id);

        // Validasi token — identik dengan publicVerify() dan publicDownload()
        $expectedToken = substr(
            hash('md5', $document->id . $document->document_hash . config('app.key')),
            0,
            16
        );

        if (!hash_equals($expectedToken, $token)) {
            abort(403, 'Token tidak valid.');
        }

        // Hanya izinkan jika dokumen bisa diunduh publik
        $isPubliclyDownloadable = !$document->is_confidential
            || $document->security_level === 'normal';

        if (!$isPubliclyDownloadable) {
            abort(403, 'Dokumen ini bersifat rahasia dan tidak dapat diunduh secara publik.');
        }

        // Pastikan file embedded ada
        if (
            !$document->embedded_document_path
            || !\Storage::disk('public')->exists($document->embedded_document_path)
        ) {
            // Fallback ke file original jika embedded tidak ada
            if (!$document->file_path || !\Storage::disk('public')->exists($document->file_path)) {
                abort(404, 'File tidak ditemukan.');
            }

            \App\Models\DocumentAccessLog::create([
                'document_id' => $document->id,
                'user_id'     => null,
                'action'      => 'public_download_fallback',
                'description' => 'Embedded file not found, served original (public)',
                'ip_address'  => request()->ip(),
                'user_agent'  => request()->userAgent(),
            ]);

            return \Storage::disk('public')->download(
                $document->file_path,
                'VERIFIED-' . $document->file_name
            );
        }

        // Log akses
        \App\Models\DocumentAccessLog::create([
            'document_id' => $document->id,
            'user_id'     => null,
            'action'      => 'public_download_embedded',
            'description' => 'Downloaded embedded QR file via QR Code (public)',
            'ip_address'  => request()->ip(),
            'user_agent'  => request()->userAgent(),
        ]);

        $downloadName = 'VERIFIED-QR-' . pathinfo($document->file_name, PATHINFO_FILENAME) . '.pdf';

        return \Storage::disk('public')->download(
            $document->embedded_document_path,
            $downloadName
        );
    }
    /**
     * Force generate security untuk dokumen yang belum punya
     */
    public function forceGenerateSecurity($id)
    {
        $document = Document::findOrFail($id);

        try {
            $success = $this->security->generateSecurityFeatures($document);

            if ($success) {
                return back()->with('success', 'Security features berhasil di-generate!');
            } else {
                return back()->with('error', 'Gagal generate security features. Silakan coba lagi.');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    /**
     * Bulk verify multiple documents
     */
    public function bulkVerify(Request $request)
    {
        $request->validate([
            'document_ids'   => 'required|array',
            'document_ids.*' => 'exists:documents,id'
        ]);

        $results = [];

        foreach ($request->document_ids as $docId) {
            $document = Document::find($docId);
            if ($document) {
                $verification = $this->security->verifyDocument($document);
                $results[] = [
                    'document_id' => $docId,
                    'title'       => $document->title,
                    'status'      => $verification['status'],
                    'valid'       => $verification['overall_valid'],
                ];
            }
        }

        return response()->json([
            'success' => true,
            'total'   => count($results),
            'results' => $results
        ]);
    }
}