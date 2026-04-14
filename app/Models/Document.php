<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Document extends Model
{
    protected $fillable = [
        'title',
        'description',
        'file_name',
        'file_path',
        'file_type',
        'file_size',
        'user_id',
        'archive_classification_id',
        'kode_arsip',
        'jenis_arsip',
        'tahun',
        'tingkat_perkembangan',
        'jumlah',
        'keterangan',
        'no_definitif',
        'lokasi_simpan',
        'retensi_aktif',
        'retensi_inaktif',
        'nasib_akhir',
        'category_id',
        'is_confidential',
        'security_level', // BARU: Tingkat keamanan


        // Hash fields
        'document_hash',
        'file_content_hash',
        'file_checksum',
        'metadata_hash',
        'hash_algorithm',
        'hash_generated_at',
        'embedded_document_path',
        'embedded_document_hash',
        // QR & Verification
        'qr_code_path',
        'last_verified_at',
    ];

    protected $casts = [
        'tahun' => 'date',
        'is_confidential' => 'boolean',
        'hash_generated_at' => 'datetime',
        'last_verified_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    /**
     * Get download URL untuk dokumen dengan QR embedded
     */
    public function getEmbeddedDocumentUrlAttribute(): ?string
    {
        if ($this->embedded_document_path && Storage::disk('public')->exists($this->embedded_document_path)) {
            return Storage::url($this->embedded_document_path);
        }
        return null;
    }

    /**
     * Check if document has embedded QR
     */
    public function hasEmbeddedQR(): bool
    {
        return !empty($this->embedded_document_path) &&
            Storage::disk('public')->exists($this->embedded_document_path);
    }
    /**
     * Relationships
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function archiveClassification(): BelongsTo
    {
        return $this->belongsTo(ArchiveClassification::class);
    }

    public function accessLogs(): HasMany
    {
        return $this->hasMany(DocumentAccessLog::class);
    }

    public function hashHistories(): HasMany
    {
        return $this->hasMany(DocumentHashHistory::class);
    }

    /**
     * Scopes
     */
    public function scopeConfidential($query)
    {
        return $query->where('is_confidential', true);
    }

    public function scopeSearch($query, $search)
    {
        return $query->when($search, function ($q) use ($search) {
            $q->where('title', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%")
                ->orWhere('kode_arsip', 'like', "%{$search}%")
                ->orWhere('no_definitif', 'like', "%{$search}%");
        });
    }

    public function scopeFileType($query, $type)
    {
        return $query->when($type, fn($q) => $q->where('file_type', $type));
    }

    /**
     * Accessors
     */
    public function getFormattedFileSizeAttribute(): string
    {
        $bytes = $this->file_size;
        $units = ['B', 'KB', 'MB', 'GB'];

        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }

    public function getSecurityStatusAttribute(): string
    {
        if (!$this->is_confidential) {
            return 'normal';
        }

        $hasHash = !empty($this->document_hash);
        $hasFileHash = !empty($this->file_content_hash);
        $hasChecksum = !empty($this->file_checksum);
        $hasQR = !empty($this->qr_code_path);

        if ($hasHash && $hasFileHash && $hasChecksum && $hasQR) {
            return 'secured';
        } elseif ($hasHash || $hasFileHash || $hasChecksum) {
            return 'partial';
        }

        return 'basic';
    }

    /**
     * BARU: Get security level badge
     */
    public function getSecurityLevelBadgeAttribute(): string
    {
        $badges = [
            'normal' => '<span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-gray-100 dark:bg-gray-900/30 text-gray-700 dark:text-gray-400 rounded-lg text-xs font-semibold">
                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"/>
                </svg>
                Normal
            </span>',

            'rahasia' => '<span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-orange-100 dark:bg-orange-900/30 text-orange-700 dark:text-orange-400 rounded-lg text-xs font-bold uppercase">
                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                </svg>
                Rahasia
            </span>',

            'sangat_rahasia' => '<span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400 rounded-lg text-xs font-bold uppercase animate-pulse">
                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 1.944A11.954 11.954 0 012.166 5C2.056 5.649 2 6.319 2 7c0 5.225 3.34 9.67 8 11.317C14.66 16.67 18 12.225 18 7c0-.682-.057-1.35-.166-2.001A11.954 11.954 0 0110 1.944zM11 14a1 1 0 11-2 0 1 1 0 012 0zm0-7a1 1 0 10-2 0v3a1 1 0 102 0V7z" clip-rule="evenodd"/>
                </svg>
                Sangat Rahasia
            </span>',
        ];

        return $badges[$this->security_level] ?? $badges['normal'];
    }

    /**
     * BARU: Get security level text
     */
    public function getSecurityLevelTextAttribute(): string
    {
        $texts = [
            'normal' => 'Normal',
            'rahasia' => 'Rahasia',
            'sangat_rahasia' => 'Sangat Rahasia',
        ];

        return $texts[$this->security_level] ?? 'Normal';
    }

    /**
     * Check if document needs reverification
     */
    public function needsReverification(): bool
    {
        if (!$this->is_confidential) {
            return false;
        }

        if (!$this->last_verified_at) {
            return true;
        }

        return $this->last_verified_at->diffInDays(now()) > 30;
    }

    /**
     * Get latest hash verification
     */
    public function getLatestHashVerification()
    {
        return $this->hashHistories()
            ->where('verification_type', 'full_verification')
            ->latest('verified_at')
            ->first();
    }

    /**
     * Check if hash has been compromised
     */
    public function isHashCompromised(): bool
    {
        $latestVerification = $this->getLatestHashVerification();

        if (!$latestVerification) {
            return false;
        }

        return !$latestVerification->is_valid;
    }

    /**
     * Get hash status badge HTML
     */
    public function getHashStatusBadge(): string
    {
        if (!$this->document_hash) {
            return '<span class="px-2 py-1 bg-gray-100 text-gray-600 rounded-full text-xs font-bold">NO HASH</span>';
        }

        if ($this->isHashCompromised()) {
            return '<span class="px-2 py-1 bg-red-100 text-red-700 rounded-full text-xs font-bold">COMPROMISED</span>';
        }

        if ($this->needsReverification()) {
            return '<span class="px-2 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-bold">NEED REVERIFY</span>';
        }

        return '<span class="px-2 py-1 bg-green-100 text-green-700 rounded-full text-xs font-bold">VALID</span>';
    }
}