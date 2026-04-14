<?php

namespace App\Livewire\Documents;

use App\Models\Document;
use App\Models\ArchiveClassification;
use App\Models\Category;
use App\Services\DocumentSecurity;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class DocumentEdit extends Component
{
    use WithFileUploads;

    public Document $document;

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
    public $is_confidential = false;
    public $security_level = 'normal';
    public $existingFileName;

    // Multi-step navigation
    public $currentStep = 1;
    public $totalSteps = 5;

    // Property untuk filter kategori
    public $selectedCategory = '';

    protected function rules()
    {
        $rules = [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'file' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png,gif,webp|max:10240',
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
            'is_confidential' => 'boolean',
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
                'is_confidential' => 'boolean',
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
                'file' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png,gif,webp|max:10240',
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

    public function mount(Document $document)
    {
        $this->document = $document;
        $this->title = $document->title;
        $this->description = $document->description;
        $this->archive_classification_id = $document->archive_classification_id;
        $this->jenis_arsip = $document->jenis_arsip;
        $this->tahun = $document->tahun ? date('Y', strtotime($document->tahun)) : date('Y');
        $this->tingkat_perkembangan = $document->tingkat_perkembangan;
        $this->jumlah = $document->jumlah;
        $this->keterangan = $document->keterangan;
        $this->no_definitif = $document->no_definitif;
        $this->lokasi_simpan = $document->lokasi_simpan;
        $this->retensi_aktif = $document->retensi_aktif ?? $document->jangka_simpan;
        $this->retensi_inaktif = $document->retensi_inaktif;
        $this->nasib_akhir = $document->nasib_akhir;
        $this->category_id = $document->category_id;
        $this->is_confidential = (bool) $document->is_confidential;
        $this->security_level = $document->security_level ?? 'normal';
        $this->existingFileName = $document->file_name;

        // Set selected category berdasarkan archive classification yang sudah dipilih
        if ($document->archiveClassification) {
            $this->selectedCategory = $document->archiveClassification->category;
        }
    }

    public function updatedSelectedCategory()
    {
        if (
            $this->document->archiveClassification &&
            $this->selectedCategory !== $this->document->archiveClassification->category
        ) {
            $this->archive_classification_id = '';
        }
    }

    public function updatedIsConfidential($value)
    {
        if (!$value) {
            $this->security_level = 'normal';
        }
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

    public function update()
    {
        $this->validate();

        try {
            $archiveClassification = ArchiveClassification::find($this->archive_classification_id);

            if (!$archiveClassification) {
                session()->flash('error', 'Kode klasifikasi arsip tidak ditemukan.');
                return;
            }

            $kodeArsip = $archiveClassification->code;

            $tingkatPerkembanganFinal = $this->tingkat_perkembangan === 'Lainnya'
                ? $this->tingkat_perkembangan_lainnya
                : $this->tingkat_perkembangan;

            $finalSecurityLevel = $this->is_confidential
                ? $this->security_level
                : 'normal';

            $data = [
                'title' => $this->title,
                'description' => $this->description,
                'archive_classification_id' => $this->archive_classification_id,
                'kode_arsip' => $kodeArsip,
                'jenis_arsip' => $this->jenis_arsip,
                'tahun' => $this->tahun,
                'tingkat_perkembangan' => $tingkatPerkembanganFinal,
                'jumlah' => $this->jumlah,
                'keterangan' => $this->keterangan,
                'no_definitif' => $this->no_definitif,
                'lokasi_simpan' => $this->lokasi_simpan,
                'retensi_aktif' => $this->retensi_aktif,
                'retensi_inaktif' => $this->retensi_inaktif,
                'nasib_akhir' => $this->nasib_akhir,
                'category_id' => $this->category_id,
                'is_confidential' => $this->is_confidential,
                'security_level' => $finalSecurityLevel,
            ];

            $security = null;
            if (class_exists('App\Services\DocumentSecurity')) {
                $security = new DocumentSecurity();
            }

            $fileChanged = false;

            if ($this->file) {
                if ($this->document->file_path && Storage::disk('public')->exists($this->document->file_path)) {
                    Storage::disk('public')->delete($this->document->file_path);
                }

                $fileName = $this->file->getClientOriginalName();
                $filePath = $this->file->store('documents', 'public');

                $data['file_name'] = $fileName;
                $data['file_path'] = $filePath;
                $data['file_type'] = $this->file->getClientOriginalExtension();
                $data['file_size'] = $this->file->getSize();

                if ($security) {
                    $data['file_checksum'] = $security->generateFileChecksum($filePath);
                }

                $fileChanged = true;
            }

            $this->document->update($data);

            if ($security && ($fileChanged || $this->document->wasChanged('is_confidential'))) {
                $this->document->refresh();

                $documentHash = $security->generateDocumentHash($this->document);
                $qrCodePath = $security->generateOwnershipQR($this->document);

                $this->document->update([
                    'document_hash' => $documentHash,
                    'qr_code_path' => $qrCodePath,
                    'last_verified_at' => now()
                ]);

                $security->logAccess($this->document, 'update');
            }

            session()->flash('success', 'Dokumen berhasil diupdate!');
            return $this->redirect('/documents', navigate: true);
        } catch (\Exception $e) {
            Log::error('Error updating document: ' . $e->getMessage(), [
                'document_id' => $this->document->id,
                'trace' => $e->getTraceAsString()
            ]);

            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function render()
    {
        $categories = Category::orderBy('name')->get();

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

        return view('livewire.documents.document-edit', [
            'categories' => $categories,
            'archiveCategories' => $archiveCategories,
            'archiveClassifications' => $archiveClassifications,
        ]);
    }
}
