<?php

namespace App\Livewire\Documents;

use App\Models\Document;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class DocumentCreate extends Component
{
    use WithFileUploads;

    public $title;
    public $description;
    public $file;

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'nullable|string|max:1000',
        'file' => 'required|file|mimes:pdf,doc,docx|max:10240',
    ];

    protected $messages = [
        'title.required' => 'Judul harus diisi.',
        'file.required' => 'File harus diupload.',
        'file.mimes' => 'File harus berformat PDF, DOC, atau DOCX.',
        'file.max' => 'Ukuran file maksimal 10MB.',
    ];

    public function save()
    {
        $this->validate();

        try {
            $fileName = $this->file->getClientOriginalName();
            $filePath = $this->file->store('documents', 'public');

            Document::create([
                'title' => $this->title,
                'description' => $this->description,
                'file_name' => $fileName,
                'file_path' => $filePath,
                'file_type' => $this->file->getClientOriginalExtension(),
                'file_size' => $this->file->getSize(),
                'user_id' => Auth::id(), 
            ]);

            session()->flash('success', 'Document berhasil ditambahkan!');
            return $this->redirect('/documents', navigate: true);

        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan saat upload file.');
        }
    }

    public function render()
    {
        return view('livewire.documents.document-create');
    }
}