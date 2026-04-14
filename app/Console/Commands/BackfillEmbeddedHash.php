<?php

namespace App\Console\Commands;

use App\Models\Document;
use Illuminate\Console\Command;

class BackfillEmbeddedHash extends Command
{
    protected $signature = 'documents:backfill-embedded-hash';
    protected $description = 'Isi embedded_document_hash untuk dokumen yang sudah punya embedded_document_path tapi belum punya hash-nya';

    public function handle(): void
    {
        $documents = Document::whereNotNull('embedded_document_path')
            ->whereNull('embedded_document_hash')
            ->get();

        $this->info("Ditemukan {$documents->count()} dokumen yang perlu di-backfill.");

        $bar = $this->output->createProgressBar($documents->count());
        $bar->start();

        foreach ($documents as $doc) {
            $fullPath = storage_path('app/public/' . $doc->embedded_document_path);

            if (file_exists($fullPath)) {
                $hash = md5_file($fullPath);
                $doc->updateQuietly(['embedded_document_hash' => $hash]);
                $this->line(" ✓ Doc ID {$doc->id}: {$hash}");
            } else {
                $this->warn(" ✗ Doc ID {$doc->id}: file tidak ditemukan di {$fullPath}");
            }

            $bar->advance();
        }

        $bar->finish();
        $this->newLine();
        $this->info('Backfill selesai.');
    }
}