    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration
    {
        /**
         * Run the migrations.
         */
        public function up(): void
        {
            Schema::create('documents', function (Blueprint $table) {
                $table->id();
                $table->string('title');

                $table->unsignedBigInteger('user_id')->nullable();
                $table->unsignedBigInteger('category_id')->nullable();

                $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
                $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');

                $table->text('description')->nullable();
                $table->string('file_name');
                $table->string('file_path');
                $table->string('kode_arsip');
                $table->string('jenis_arsip');
                $table->date('tahun');
                $table->string('tingkat_perkembangan');
                $table->integer('jumlah');
                $table->string('keterangan');
                $table->string('no_definitif');
                $table->string('lokasi_simpan');
                $table->string('retensi_aktif');
                $table->string('retensi_inaktif');
                $table->string('nasib_akhir');

                $table->string('file_type');
                $table->unsignedBigInteger('file_size');

                // 🔐 HASH & SECURITY
                $table->string('document_hash', 64)->nullable();
                $table->string('file_content_hash', 64)->nullable();
                $table->string('metadata_hash', 64)->nullable();
                $table->string('file_checksum', 64)->nullable();
                $table->string('hash_algorithm', 20)->default('SHA-256');
                $table->timestamp('hash_generated_at')->nullable();

                $table->string('qr_code_path')->nullable();
                $table->text('encrypted_metadata')->nullable();
                $table->boolean('is_confidential')->default(false);
                $table->timestamp('last_verified_at')->nullable();
                $table->string('embedded_document_path')->nullable();

                $table->timestamps();
                $table->softDeletes();

                // ⚡ INDEX
                $table->index('title');
                $table->index('file_type');
                $table->index('created_at');
                $table->index('document_hash');
                $table->index('file_content_hash');
                $table->index('file_checksum');
            });
        }

        /**w
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('documents');
        }
    };
