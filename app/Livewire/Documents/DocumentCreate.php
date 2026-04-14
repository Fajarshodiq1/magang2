<?php

namespace App\Livewire\Documents;

use App\Models\Document;
use App\Models\ArchiveClassification;
use App\Models\Category;
use App\Models\DocumentHashHistory;
use App\Services\DocumentSecurity;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class DocumentCreate extends Component
{
    use WithFileUploads;

    // Form fields
    public $title;
    public $description;
    public $file;
    public $archive_classification_id;
    public $jenis_arsip;
    public $tahun;
    public $tingkat_perkembangan;
    public $tingkat_perkembangan_lainnya;
    public $jumlah;
    public $keterangan;
    public $no_definitif;
    public $lokasi_simpan;
    public $retensi_aktif;
    public $retensi_inaktif;
    public $nasib_akhir;
    public $category_id;
    public $is_confidential = true; // Semua dokumen wajib dilindungi
    public $security_level = 'normal';
    public $selectedCategory = '';

    // Multi-step navigation
    public $currentStep = 1;
    public $totalSteps = 5;

    protected function rules()
    {
        $rules = [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'file' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png,gif,webp|max:10240',
            'archive_classification_id' => 'required|exists:archive_classifications,id',
            'jenis_arsip' => 'required|string|max:255',
            'tahun' => 'required|digits:4|integer|min:1900',
            'tingkat_perkembangan' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
            'keterangan' => 'required|string|max:255',
            'no_definitif' => 'required|string|max:255',
            'lokasi_simpan' => 'required|string|max:255',
            'retensi_aktif' => 'required|string|max:255',
            'retensi_inaktif' => 'required|string|max:255',
            'nasib_akhir' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'security_level' => 'required|in:normal,rahasia,sangat_rahasia',
        ];

        if ($this->tingkat_perkembangan === 'Lainnya') {
            $rules['tingkat_perkembangan_lainnya'] = 'required|string|max:255';
        }

        return $rules;
    }

    protected function getStepRules($step)
    {
        $stepRules = [
            1 => [
                'security_level' => 'required|in:normal,rahasia,sangat_rahasia',
            ],
            2 => [
                'title' => 'required|string|max:255',
                'description' => 'nullable|string|max:1000',
                'archive_classification_id' => 'required|exists:archive_classifications,id',
                'jenis_arsip' => 'required|string|max:255',
                'tahun' => 'required|digits:4|integer|min:1900',
                'category_id' => 'required|exists:categories,id',
            ],
            3 => [
                'tingkat_perkembangan' => 'required|string|max:255',
                'jumlah' => 'required|integer|min:1',
                'no_definitif' => 'required|string|max:255',
                'lokasi_simpan' => 'required|string|max:255',
            ],
            4 => [
                'retensi_aktif' => 'required|string|max:255',
                'retensi_inaktif' => 'required|string|max:255',
                'nasib_akhir' => 'required|string|max:255',
                'keterangan' => 'required|string|max:255',
            ],
            5 => [
                'file' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png,gif,webp|max:10240',
            ],
        ];

        if ($step == 3 && $this->tingkat_perkembangan === 'Lainnya') {
            $stepRules[3]['tingkat_perkembangan_lainnya'] = 'required|string|max:255';
        }

        return $stepRules[$step] ?? [];
    }

    protected $messages = [
        'title.required' => 'Judul harus diisi.',
        'title.max' => 'Judul maksimal 255 karakter.',
        'file.required' => 'File harus diupload.',
        'file.mimes' => 'File harus berformat PDF, DOC, DOCX, JPG, JPEG, PNG, GIF, atau WEBP.',
        'file.max' => 'Ukuran file maksimal 10MB.',
        'archive_classification_id.required' => 'Kode klasifikasi arsip harus dipilih.',
        'archive_classification_id.exists' => 'Kode klasifikasi arsip tidak valid.',
        'jenis_arsip.required' => 'Jenis arsip harus diisi.',
        'tahun.required' => 'Tahun harus diisi.',
        'tahun.digits' => 'Tahun harus 4 digit.',
        'tahun.integer' => 'Tahun harus berupa angka.',
        'tingkat_perkembangan.required' => 'Tingkat perkembangan harus diisi.',
        'jumlah.required' => 'Jumlah harus diisi.',
        'jumlah.integer' => 'Jumlah harus berupa angka.',
        'jumlah.min' => 'Jumlah minimal 1.',
        'keterangan.required' => 'Keterangan harus diisi.',
        'no_definitif.required' => 'Nomor definitif harus diisi.',
        'lokasi_simpan.required' => 'Lokasi simpan harus diisi.',
        'retensi_aktif.required' => 'Retensi aktif harus diisi.',
        'retensi_inaktif.required' => 'Retensi inaktif harus diisi.',
        'nasib_akhir.required' => 'Nasib akhir harus diisi.',
        'category_id.required' => 'Kategori harus dipilih.',
        'category_id.exists' => 'Kategori tidak valid.',
        'security_level.required' => 'Tingkat keamanan harus dipilih.',
        'security_level.in' => 'Tingkat keamanan tidak valid.',
    ];

    public function updatedSelectedCategory()
    {
        $this->archive_classification_id = '';
    }

    public function nextStep()
    {
        $this->validate($this->getStepRules($this->currentStep));

        if ($this->currentStep < $this->totalSteps) {
            $this->currentStep++;
            $this->dispatch('scroll-to-top');
        }
    }

    public function previousStep()
    {
        if ($this->currentStep > 1) {
            $this->currentStep--;
            $this->dispatch('scroll-to-top');
        }
    }

    public function goToStep($step)
    {
        if ($step >= 1 && $step <= $this->totalSteps) {
            for ($i = $this->currentStep; $i < $step; $i++) {
                $this->validate($this->getStepRules($i));
            }

            $this->currentStep = $step;
            $this->dispatch('scroll-to-top');
        }
    }

    public function save()
    {
        $this->validate();

        DB::beginTransaction();

        try {
            // Upload File
            $fileName = $this->file->getClientOriginalName();
            $filePath = $this->file->store('documents', 'public');

            Log::info("File uploaded: {$filePath}");

            $security = new DocumentSecurity();

            // Metadata Preparation
            $archiveClassification = ArchiveClassification::find($this->archive_classification_id);
            $kodeArsip = $archiveClassification?->code;

            $tingkatPerkembanganFinal = $this->tingkat_perkembangan === 'Lainnya'
                ? $this->tingkat_perkembangan_lainnya
                : $this->tingkat_perkembangan;

            // Semua dokumen wajib confidential
            $finalSecurityLevel = $this->security_level;

            // Create Document
            $document = Document::withoutEvents(fn() => Document::create([
                'title'                      => $this->title,
                'description'                => $this->description,
                'file_name'                  => $fileName,
                'file_path'                  => $filePath,
                'file_type'                  => $this->file->getClientOriginalExtension(),
                'file_size'                  => $this->file->getSize(),
                'user_id'                    => Auth::id(),
                'archive_classification_id'  => $this->archive_classification_id,
                'kode_arsip'                 => $kodeArsip,
                'jenis_arsip'                => $this->jenis_arsip,
                'tahun'                      => $this->tahun,
                'tingkat_perkembangan'       => $tingkatPerkembanganFinal,
                'jumlah'                     => $this->jumlah,
                'keterangan'                 => $this->keterangan,
                'no_definitif'               => $this->no_definitif,
                'lokasi_simpan'              => $this->lokasi_simpan,
                'retensi_aktif'              => $this->retensi_aktif,
                'retensi_inaktif'            => $this->retensi_inaktif,
                'nasib_akhir'                => $this->nasib_akhir,
                'category_id'                => $this->category_id,
                'is_confidential'            => true, // Selalu true — semua dokumen wajib dilindungi
                'security_level'             => $finalSecurityLevel,
            ]));

            Log::info("Document created with ID: {$document->id}");

            // Security Processing — selalu dijalankan untuk semua dokumen
            Log::info("Processing document security (Level: {$finalSecurityLevel})");

            try {
                // Step 1: Generate Multi-Layer Hash
                Log::info("Step 1: Generating multi-layer hash...");
                $hashes = $security->generateMultiLayerHash($document);

                // Step 2: Update document with hashes
                Log::info("Step 2: Updating document with hashes...");
                $document->updateQuietly([
                    'document_hash'      => $hashes['document_hash'],
                    'file_content_hash'  => $hashes['file_hash'],
                    'file_checksum'      => $hashes['checksum'],
                    'metadata_hash'      => $hashes['metadata_hash'],
                    'hash_algorithm'     => 'MD5',
                    'hash_generated_at'  => now(),
                ]);

                Log::info("Hashes updated successfully");

                // Step 3: Generate QR Code
                Log::info("Step 3: Generating QR Code...");
                $qrCodePath = $security->generateOwnershipQR($document);

                $document->updateQuietly([
                    'qr_code_path' => $qrCodePath,
                ]);

                Log::info("QR Code generated: {$qrCodePath}");

                Log::info("Step 4: Embedding QR Code to document...");

                try {
                    $embeddedPath = $security->embedQRToDocument($document);

                    // Refresh dulu agar data terbaru dari DB (karena embedQRToDocument juga updateQuietly)
                    $document->refresh();

                    // Kalau embedded_document_hash masih null setelah refresh, hitung manual
                    if (!$document->embedded_document_hash && $document->embedded_document_path) {
                        $embeddedFullPath = storage_path('app/public/' . $document->embedded_document_path);
                        if (file_exists($embeddedFullPath)) {
                            $embeddedHash = md5_file($embeddedFullPath);
                            $document->updateQuietly([
                                'embedded_document_hash' => $embeddedHash,
                                'last_verified_at'       => now(),
                            ]);
                            Log::info("Embedded hash saved manually: {$embeddedHash}");
                        }
                    }

                    Log::info("QR embedded. Path: {$document->embedded_document_path}, Hash: {$document->embedded_document_hash}");
                } catch (\Exception $embedError) {
                    Log::error("QR Embedding failed: " . $embedError->getMessage());

                    $document->updateQuietly([
                        'embedded_document_path' => null,
                        'embedded_document_hash' => null,
                        'last_verified_at'       => now(),
                    ]);

                    session()->flash(
                        'warning',
                        "Dokumen tersimpan, namun QR embedding gagal: " . $embedError->getMessage()
                    );
                }

                // Step 5: Save hash history
                Log::info("Step 5: Saving hash history...");
                DocumentHashHistory::create([
                    'document_id'         => $document->id,
                    'verification_type'   => 'initial_generation',
                    'document_hash'       => $hashes['document_hash'],
                    'file_content_hash'   => $hashes['file_hash'],
                    'file_checksum'       => $hashes['checksum'],
                    'metadata_hash'       => $hashes['metadata_hash'],
                    'is_valid'            => true,
                    'document_hash_valid' => true,
                    'file_hash_valid'     => true,
                    'checksum_valid'      => true,
                    'verified_by'         => auth()->id(),
                    'verified_at'         => now(),
                    'ip_address'          => request()->ip(),
                ]);

                Log::info("Hash history saved");

                // Log access
                $security->logAccess($document, 'create', 'Document created with security level: ' . $finalSecurityLevel);

                Log::info("Security processing completed for document ID: {$document->id}");
            } catch (\Exception $securityError) {
                Log::error("Security processing failed: " . $securityError->getMessage());
                Log::error("Stack trace: " . $securityError->getTraceAsString());

                DB::rollBack();

                if (Storage::disk('public')->exists($filePath)) {
                    Storage::disk('public')->delete($filePath);
                }

                throw new \Exception(
                    "Gagal memproses keamanan dokumen: " . $securityError->getMessage()
                );
            }

            DB::commit();

            // Success Response
            $successMessage = "Dokumen berhasil ditambahkan dengan perlindungan keamanan " . ucfirst(str_replace('_', ' ', $finalSecurityLevel)) . "!";

            if ($document->embedded_document_path) {
                $successMessage .= " QR Code telah disematkan ke dokumen.";
            }

            session()->flash('success', $successMessage);

            Log::info("Document save process completed successfully for ID: {$document->id}");

            return $this->redirect('/documents', navigate: true);
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            throw $e;
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Document creation failed: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());

            if (isset($filePath) && Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
                Log::info("Rolled back: Deleted uploaded file: {$filePath}");
            }

            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function render()
    {
        $categories = Category::all();

        $archiveCategories = [
            'OT' => 'OT - ORGANISASI DAN TATA LAKSANA',
            'HM' => 'HM - KEHUMASAN',
            'KP' => 'KP - KEPEGAWAIAN',
            'HK' => 'HK - HUKUM',
            'PW' => 'PW - PERWAKILAN',
            'KU' => 'KU - KEUANGAN',
            'BA' => 'BA - PEMBINAAN AGAMA',
            'PR' => 'PR - PENDIDIKAN DAN PENGAJARAN',
            'PS' => 'PS - PENSAKRAMAN',
            'TL' => 'TL - PENELITIAN',
            'HJ' => 'HJ - HAJI',
        ];

        $archiveClassifications = ArchiveClassification::query()
            ->active()
            ->when($this->selectedCategory, function ($query) {
                $query->where('category', $this->selectedCategory);
            })
            ->orderBy('code')
            ->get();

        return view('livewire.documents.document-create', [
            'categories'              => $categories,
            'archiveCategories'       => $archiveCategories,
            'archiveClassifications'  => $archiveClassifications,
        ]);
    }
}