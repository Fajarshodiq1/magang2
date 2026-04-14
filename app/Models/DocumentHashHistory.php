<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DocumentHashHistory extends Model
{
    protected $fillable = [
        'document_id',
        'verification_type',
        'old_document_hash',
        'old_file_content_hash',
        'old_file_checksum',
        'document_hash',
        'file_content_hash',
        'file_checksum',
        'metadata_hash',
        'is_valid',
        'document_hash_valid',
        'file_hash_valid',
        'checksum_valid',
        'changes_detected',
        'verified_by',
        'verified_at',
        'ip_address',
    ];

    protected $casts = [
        'is_valid' => 'boolean',
        'document_hash_valid' => 'boolean',
        'file_hash_valid' => 'boolean',
        'checksum_valid' => 'boolean',
        'changes_detected' => 'array',
        'verified_at' => 'datetime',
    ];

    /**
     * Get the document that this history belongs to
     */
    public function document(): BelongsTo
    {
        return $this->belongsTo(Document::class);
    }

    /**
     * Get the user who verified
     */
    public function verifiedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    /**
     * Check if there were any changes detected in this document history
     */
    public function hasDetectedChanges(): bool
    {
        return !empty($this->changes_detected);
    }


    /**
     * Get formatted verification status
     */
    public function getStatusBadgeAttribute(): string
    {
        if ($this->is_valid) {
            return '<span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs font-bold">VALID</span>';
        }

        return '<span class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs font-bold">INVALID</span>';
    }

    /**
     * Scope untuk filter by document
     */
    public function scopeForDocument($query, $documentId)
    {
        return $query->where('document_id', $documentId);
    }

    /**
     * Scope untuk filter by validity
     */
    public function scopeValid($query)
    {
        return $query->where('is_valid', true);
    }

    /**
     * Scope untuk filter invalid
     */
    public function scopeInvalid($query)
    {
        return $query->where('is_valid', false);
    }

    /**
     * Scope untuk filter dengan perubahan
     */
    public function scopeWithChanges($query)
    {
        return $query->whereNotNull('changes_detected')
            ->where('changes_detected', '!=', '[]');
    }
}
