<?php

namespace App\Observers;

use App\Models\Document;
use App\Services\DocumentSecurity;
use Illuminate\Support\Facades\Log;

class DocumentObserver
{
    protected $security;

    public function __construct(DocumentSecurity $security)
    {
        $this->security = $security;
    }

    public function created(Document $document): void
    {
        // Guard: skip jika sudah ada hash (di-handle manual di controller/livewire)
        if (!$document->file_path || $document->document_hash) {
            Log::info('DocumentObserver: Skipping - no file or hash already exists for ID: ' . $document->id);
            return;
        }

        try {
            $this->security->generateSecurityFeatures($document);
        } catch (\Exception $e) {
            Log::error('DocumentObserver: Failed for ID ' . $document->id . ': ' . $e->getMessage());
        }
    }

    public function updated(Document $document): void
    {
        // Guard: skip updateQuietly (tidak trigger observer) — ini hanya untuk perubahan file eksplisit
        if (!$document->isDirty('file_path') || !$document->file_path) {
            return;
        }

        try {
            $this->security->regenerateSecurity($document);
        } catch (\Exception $e) {
            Log::error('DocumentObserver: Regenerate failed for ID ' . $document->id . ': ' . $e->getMessage());
        }
    }

    /**
     * Handle the Document "deleting" event.
     * Hapus QR Code saat dokumen dihapus
     */
    public function deleting(Document $document): void
    {
        try {
            // Hapus QR Code
            if ($document->qr_code_path && \Storage::disk('public')->exists($document->qr_code_path)) {
                \Storage::disk('public')->delete($document->qr_code_path);
                Log::info('DocumentObserver: QR Code deleted for document ID: ' . $document->id);
            }

            // Hapus file dokumen
            if ($document->file_path && \Storage::disk('public')->exists($document->file_path)) {
                \Storage::disk('public')->delete($document->file_path);
                Log::info('DocumentObserver: Document file deleted for document ID: ' . $document->id);
            }
        } catch (\Exception $e) {
            Log::error('DocumentObserver: Failed to delete files for document ID ' . $document->id . ': ' . $e->getMessage());
        }
    }
}
