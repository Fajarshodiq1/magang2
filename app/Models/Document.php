<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Document extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'file_name',
        'file_path',
        'file_type',
        'file_size',
        'user_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Accessor untuk format file size
    public function getFormattedFileSizeAttribute(): string
    {
        $bytes = $this->file_size;
        $units = ['B', 'KB', 'MB', 'GB'];
        
        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, 2) . ' ' . $units[$i];
    }

    // Accessor untuk full file URL
    public function getFileUrlAttribute(): string
    {
        return Storage::url($this->file_path);
    }

    // Scope untuk searching
    public function scopeSearch($query, $search)
    {
        return $query->when($search, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%")
                      ->orWhere('file_name', 'like', "%{$search}%");
            });
        });
    }

    // Scope untuk filter by file type
    public function scopeFileType($query, $type)
    {
        return $query->when($type, function ($query, $type) {
            $query->where('file_type', $type);
        });
    }

    // Method untuk delete file dari storage
    public function deleteFile(): void
    {
        if (Storage::exists($this->file_path)) {
            Storage::delete($this->file_path);
        }
    }

    // Relation to user who created the document
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}