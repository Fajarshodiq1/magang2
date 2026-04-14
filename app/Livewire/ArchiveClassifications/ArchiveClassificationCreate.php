<?php

namespace App\Livewire\ArchiveClassifications;

use App\Models\ArchiveClassification;
use Livewire\Component;

class ArchiveClassificationCreate extends Component
{
    public $code;
    public $name;
    public $category;
    public $description;
    public $is_active = true;

    // Daftar kategori berdasarkan KMA 44/2010
    public $categoryOptions = [
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

    protected $rules = [
        'code' => 'required|string|max:50|unique:archive_classifications,code',
        'name' => 'required|string|max:255',
        'category' => 'required|string|max:10',
        'description' => 'nullable|string|max:1000',
        'is_active' => 'boolean',
    ];

    protected $messages = [
        'code.required' => 'Kode klasifikasi harus diisi.',
        'code.unique' => 'Kode klasifikasi sudah digunakan.',
        'name.required' => 'Nama klasifikasi harus diisi.',
        'category.required' => 'Kategori harus dipilih.',
    ];

    public function save()
    {
        $this->validate();

        try {
            ArchiveClassification::create([
                'code' => $this->code,
                'name' => $this->name,
                'category' => $this->category,
                'description' => $this->description,
                'is_active' => $this->is_active,
            ]);

            session()->flash('success', 'Kode klasifikasi berhasil ditambahkan!');
            return $this->redirect('/archive-classifications', navigate: true);
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.archive-classifications.archive-classification-create');
    }
}
