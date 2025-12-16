<?php

namespace App\Livewire\Documents;

use App\Models\Document;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

class DocumentIndex extends Component
{
    use WithPagination;

    #[Url(as: 'q')]
    public $search = '';
    
    #[Url(as: 'type')]
    public $fileType = '';
    
    public $perPage = 10;
    
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    protected $queryString = [
        'search' => ['except' => ''],
        'fileType' => ['except' => ''],
    ];

    // Reset pagination ketika search berubah
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFileType()
    {
        $this->resetPage();
    }

    // Method untuk sorting
    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    // Method untuk delete document
    #[On('delete-document')]
    public function delete($id)
    {
        $document = Document::findOrFail($id);
        $document->deleteFile();
        $document->delete();
        
        session()->flash('success', 'Document berhasil dihapus!');
    }

    // Method untuk download
    public function download($id)
    {
        $document = Document::findOrFail($id);
        return response()->download(storage_path('app/public/' . $document->file_path), $document->file_name);
    }
    
    // State untuk modal preview
    public $showPreview = false;
    public $previewDocument = null;
    
    // Method untuk preview
    public function preview($id)
    {
        $this->previewDocument = Document::findOrFail($id);
        $this->showPreview = true;
    }
    
    public function closePreview()
    {
        $this->showPreview = false;
        $this->previewDocument = null;
    }

    public function render()
    {
        $documents = Document::query()
            ->search($this->search)
            ->fileType($this->fileType)
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.documents.document-index', [
            'documents' => $documents,
        ]);
    }
}