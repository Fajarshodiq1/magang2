<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('archive_classifications', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // Kode klasifikasi (misal: OT.00, HM.00, dll)
            $table->string('name'); // Nama klasifikasi
            $table->string('category'); // Kategori utama (OT, HM, KP, HK, dll)
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Update documents table
        Schema::table('documents', function (Blueprint $table) {
            $table->foreignId('archive_classification_id')->nullable()->after('category_id')->constrained('archive_classifications')->onDelete('set null');
            // Kita biarkan kode_arsip untuk backward compatibility sementara
        });
    }

    public function down(): void
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->dropForeign(['archive_classification_id']);
            $table->dropColumn('archive_classification_id');
        });

        Schema::dropIfExists('archive_classifications');
    }
};
