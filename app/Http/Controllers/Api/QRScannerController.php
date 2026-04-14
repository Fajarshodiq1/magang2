<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Services\DocumentSecurity;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class QRScannerController extends Controller
{
    protected $security;

    public function __construct(DocumentSecurity $security)
    {
        $this->security = $security;
    }

    /**
     * Verify document dari QR Code scan
     */
    public function verify(Request $request): JsonResponse
    {
        // Log request untuk debugging
        Log::info('QR Verification Request', [
            'qr_data_length' => strlen($request->qr_data ?? ''),
            'qr_data_preview' => substr($request->qr_data ?? '', 0, 100),
        ]);

        $request->validate([
            'qr_data' => 'required|string',
        ]);

        try {
            // Decode QR data
            Log::info('Attempting to decode QR data');
            $qrResult = $this->security->verifyQRCode($request->qr_data);

            Log::info('QR Decode Result', ['result' => $qrResult]);

            if (!$qrResult['valid']) {
                Log::warning('Invalid QR Code', ['message' => $qrResult['message']]);
                return response()->json([
                    'success' => false,
                    'message' => $qrResult['message'],
                    'error_code' => 'INVALID_QR',
                    'debug' => config('app.debug') ? $qrResult : null,
                ], 400);
            }

            $qrData = $qrResult['data'];
            Log::info('QR Data Decoded Successfully', ['document_id' => $qrData['document_id'] ?? 'N/A']);

            // Find document
            $document = Document::with(['user', 'category', 'archiveClassification'])
                ->find($qrData['document_id']);

            if (!$document) {
                Log::warning('Document Not Found', ['document_id' => $qrData['document_id']]);
                return response()->json([
                    'success' => false,
                    'message' => 'Dokumen tidak ditemukan',
                    'error_code' => 'DOCUMENT_NOT_FOUND'
                ], 404);
            }

            Log::info('Document Found', ['document_id' => $document->id, 'title' => $document->title]);

            // Verify hash integrity
            if ($document->document_hash !== $qrData['hash']) {
                Log::warning('Hash Mismatch', [
                    'stored_hash' => $document->document_hash,
                    'qr_hash' => $qrData['hash']
                ]);
                return response()->json([
                    'success' => false,
                    'message' => 'Hash tidak cocok. Dokumen mungkin telah dimodifikasi.',
                    'error_code' => 'HASH_MISMATCH',
                    'document' => [
                        'id' => $document->id,
                        'title' => $document->title,
                    ]
                ], 400);
            }

            // Perform full verification
            Log::info('Performing full document verification');
            $verification = $this->security->verifyDocument($document);
            Log::info('Verification Complete', ['status' => $verification['status']]);

            // Log access
            $this->security->logAccess($document, 'qr_scan', 'Document verified via QR Code scan');

            return response()->json([
                'success' => true,
                'message' => 'Dokumen terverifikasi',
                'verification_status' => $verification['status'],
                'document' => [
                    'id' => $document->id,
                    'title' => $document->title,
                    'file_name' => $document->file_name,
                    'file_type' => $document->file_type,
                    'file_size' => $document->formatted_file_size,
                    'owner' => [
                        'id' => $document->user->id,
                        'name' => $document->user->name,
                        'email' => $document->user->email,
                    ],
                    'classification' => $document->archiveClassification ? [
                        'code' => $document->archiveClassification->code,
                        'name' => $document->archiveClassification->name,
                    ] : null,
                    'category' => $document->category ? [
                        'id' => $document->category->id,
                        'name' => $document->category->name,
                    ] : null,
                    'created_at' => $document->created_at->toIso8601String(),
                    'last_verified_at' => $document->last_verified_at?->toIso8601String(),
                ],
                'verification' => [
                    'status' => $verification['status'],
                    'file_integrity' => $verification['file_integrity'],
                    'hash_valid' => $verification['hash_valid'],
                    'qr_exists' => $verification['qr_exists'],
                    'messages' => $verification['messages'],
                ],
                'scanned_at' => now()->toIso8601String(),
            ]);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            Log::error('QR Decryption Failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'QR Code tidak dapat didekripsi. Pastikan QR Code valid dan berasal dari sistem ini.',
                'error_code' => 'DECRYPTION_ERROR',
                'debug' => config('app.debug') ? $e->getMessage() : null,
            ], 400);
        } catch (\Exception $e) {
            Logw::error('QR Verification Error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memverifikasi dokumen',
                'error_code' => 'VERIFICATION_ERROR',
                'error' => config('app.debug') ? $e->getMessage() : 'Internal server error',
                'debug' => config('app.debug') ? [
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                ] : null,
            ], 500);
        }
    }

    /**
     * Get document info by ID (for quick lookup)
     */
    public function getDocumentInfo(Request $request, $documentId): JsonResponse
    {
        try {
            $document = Document::with(['user', 'category', 'archiveClassification'])
                ->findOrFail($documentId);

            // Log access
            $this->security->logAccess($document, 'api_access', 'Document info accessed via API');

            return response()->json([
                'success' => true,
                'document' => [
                    'id' => $document->id,
                    'title' => $document->title,
                    'description' => $document->description,
                    'file_name' => $document->file_name,
                    'file_type' => $document->file_type,
                    'file_size' => $document->formatted_file_size,
                    'is_confidential' => $document->is_confidential,
                    'security_status' => $document->security_status,
                    'owner' => [
                        'id' => $document->user->id,
                        'name' => $document->user->name,
                    ],
                    'classification' => $document->archiveClassification ? [
                        'code' => $document->archiveClassification->code,
                        'name' => $document->archiveClassification->name,
                        'category' => $document->archiveClassification->category,
                    ] : null,
                    'created_at' => $document->created_at->toIso8601String(),
                    'last_verified_at' => $document->last_verified_at?->toIso8601String(),
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Dokumen tidak ditemukan',
                'error_code' => 'DOCUMENT_NOT_FOUND'
            ], 404);
        }
    }

    /**
     * Batch verify multiple documents
     */
    public function batchVerify(Request $request): JsonResponse
    {
        $request->validate([
            'document_ids' => 'required|array',
            'document_ids.*' => 'required|integer|exists:documents,id',
        ]);

        try {
            $results = [];

            foreach ($request->document_ids as $documentId) {
                $document = Document::find($documentId);

                if ($document) {
                    $verification = $this->security->verifyDocument($document);

                    $results[] = [
                        'document_id' => $document->id,
                        'title' => $document->title,
                        'status' => $verification['status'],
                        'verification' => $verification,
                    ];

                    $this->security->logAccess($document, 'batch_verify', 'Document verified in batch operation');
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Batch verification completed',
                'total_documents' => count($results),
                'results' => $results,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Batch verification failed',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
