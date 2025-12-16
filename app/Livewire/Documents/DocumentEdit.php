<?php

namespace App\Livewire\Documents;

use App\Models\Document;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class DocumentEdit extends Component
{
    use WithFileUploads;

    public Document $document;
    public $title;
    public $description;
    public $file;
    public $existingFileName;
    public $showPreview = false;

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'nullable|string|max:1000',
        'file' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
    ];

    protected $messages = [
        'title.required' => 'Judul harus diisi.',
        'file.mimes' => 'File harus berformat PDF, DOC, atau DOCX.',
        'file.max' => 'Ukuran file maksimal 10MB.',
    ];

    public function mount(Document $document)
    {
        $this->document = $document;
        $this->title = $document->title;
        $this->description = $document->description;
        $this->existingFileName = $document->file_name;
    }

    public function update()
    {
        $this->validate();

        try {
            $data = [
                'title' => $this->title,
                'description' => $this->description,
            ];

            // Jika ada file baru, hapus file lama dan upload file baru
            if ($this->file) {
                // Hapus file lama
                $this->document->deleteFile();

                // Upload file baru
                $fileName = $this->file->getClientOriginalName();
                $filePath = $this->file->store('documents', 'public');
                $fileSize = $this->file->getSize();
                $fileType = $this->file->getClientOriginalExtension();

                $data['file_name'] = $fileName;
                $data['file_path'] = $filePath;
                $data['file_type'] = $fileType;
                $data['file_size'] = $fileSize;
            }

            $this->document->update($data);

            session()->flash('success', 'Document berhasil diupdate!');
            
            return $this->redirect('/documents', navigate: true);
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan saat update document.');
        }
    }

    public function render()
    {
        return view('livewire.documents.document-edit');
    }
}