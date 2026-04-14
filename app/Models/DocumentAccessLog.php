<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DocumentAccessLog extends Model
{
    protected $fillable = [
        'document_id',
        'user_id',
        'action',
        'description',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function document(): BelongsTo
    {
        return $this->belongsTo(Document::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope untuk filter berdasarkan action
     */
    public function scopeAction($query, string $action)
    {
        return $query->where('action', $action);
    }

    /**
     * Scope untuk filter berdasarkan rentang waktu
     */
    public function scopeDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('created_at', [$startDate, $endDate]);
    }

    /**
     * Get action label yang lebih readable
     */
    public function getActionLabelAttribute(): string
    {
        $labels = [
            'create' => 'Dibuat',
            'view' => 'Dilihat',
            'edit' => 'Diedit',
            'delete' => 'Dihapus',
            'download' => 'Diunduh',
            'verify' => 'Diverifikasi',
            'regenerate_security' => 'Security Regenerated',
            'regenerate_security_failed' => 'Security Regeneration Failed',
        ];

        return $labels[$this->action] ?? ucfirst($this->action);
    }
}
