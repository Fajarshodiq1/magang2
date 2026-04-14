<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('document_hash_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('document_id')->constrained()->onDelete('cascade');
            $table->string('verification_type', 50); // initial_generation, full_verification, regeneration_with_changes

            // Old hashes (untuk tracking perubahan)
            $table->string('old_document_hash', 64)->nullable();
            $table->string('old_file_content_hash', 64)->nullable();
            $table->string('old_file_checksum', 32)->nullable();

            // Current hashes
            $table->string('document_hash', 64)->nullable();
            $table->string('file_content_hash', 64)->nullable();
            $table->string('file_checksum', 32)->nullable();
            $table->string('metadata_hash', 64)->nullable();

            // Validation results
            $table->boolean('is_valid')->default(true);
            $table->boolean('document_hash_valid')->default(true);
            $table->boolean('file_hash_valid')->default(true);
            $table->boolean('checksum_valid')->default(true);

            // Change tracking
            $table->json('changes_detected')->nullable();

            // Verification info
            $table->foreignId('verified_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('verified_at');
            $table->ipAddress('ip_address')->nullable();

            $table->timestamps();

            // Indexes
            $table->index('document_id');
            $table->index('verified_at');
            $table->index('is_valid');
            $table->index(['document_id', 'verified_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('document_hash_histories');
    }
};
