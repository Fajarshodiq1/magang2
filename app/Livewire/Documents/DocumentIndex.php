<?php

namespace App\Livewire\Documents;

use App\Models\Document;
use App\Models\Category;
use App\Models\ArchiveClassification;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DocumentsExport;
use App\Imports\DocumentsImport;

class DocumentIndex extends Component
{
    use WithPagination, WithFileUploads;

    #[Url(as: 'q')]
    public $search = '';

    #[Url(as: 'type')]
    public $fileType = '';

    #[Url(as: 'category')]
    public $categoryFilter = '';

    #[Url(as: 'year')]
    public $yearFilter = '';

    // BARU: Filter untuk kategori klasifikasi arsip
    #[Url(as: 'archive_category')]
    public $archiveCategoryFilter = '';

    public $perPage = 10;
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    // Bulk Actions
    public $selectAll = false;
    public $selectedDocuments = [];
    public $bulkAction = '';

    // Import/Export
    public $importFile;
    public $showImportModal = false;

    // Preview
    public $showPreview = false;
    public $previewDocument = null;

    protected $queryString = [
        'search' => ['except' => ''],
        'fileType' => ['except' => ''],
        'categoryFilter' => ['except' => ''],
        'yearFilter' => ['except' => ''],
        'archiveCategoryFilter' => ['except' => ''],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFileType()
    {
        $this->resetPage();
    }

    public function updatingCategoryFilter()
    {
        $this->resetPage();
    }

    public function updatingYearFilter()
    {
        $this->resetPage();
    }

    public function updatingArchiveCategoryFilter()
    {
        $this->resetPage();
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedDocuments = $this->getFilteredQuery()->pluck('id')->toArray();
        } else {
            $this->selectedDocuments = [];
        }
    }

    private function getFilteredQuery()
    {
        return Document::query()
            ->search($this->search)
            ->fileType($this->fileType)
            ->when($this->categoryFilter, fn($q) => $q->where('category_id', $this->categoryFilter))
            ->when($this->yearFilter, fn($q) => $q->whereYear('tahun', $this->yearFilter))
            ->when(
                $this->archiveCategoryFilter,
                fn($q) =>
                $q->whereHas(
                    'archiveClassification',
                    fn($query) =>
                    $query->where('category', $this->archiveCategoryFilter)
                )
            );
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    #[On('delete-document')]
    public function delete($id)
    {
        $document = Document::findOrFail($id);

        // Check permission
        if (auth()->user()->can('documents.delete')) {
            // Super admin can delete any
        } elseif (auth()->user()->can('documents.delete-own') && $document->user_id === auth()->id()) {
            // User can delete own
        } else {
            abort(403, 'Unauthorized');
        }

        if ($document->file_path && Storage::disk('public')->exists($document->file_path)) {
            Storage::disk('public')->delete($document->file_path);
        }

        $document->delete();
        session()->flash('success', 'Dokumen berhasil dihapus!');
    }

    public function executeBulkAction()
    {
        if (empty($this->selectedDocuments) || empty($this->bulkAction)) {
            session()->flash('error', 'Pilih dokumen dan aksi terlebih dahulu!');
            return;
        }

        switch ($this->bulkAction) {
            case 'delete':
                $this->bulkDelete();
                break;
            case 'export':
                return $this->bulkExport();
                break;
        }

        $this->selectedDocuments = [];
        $this->selectAll = false;
        $this->bulkAction = '';
    }

    private function bulkDelete()
    {
        $documents = Document::whereIn('id', $this->selectedDocuments)->get();

        foreach ($documents as $document) {
            if ($document->file_path && Storage::disk('public')->exists($document->file_path)) {
                Storage::disk('public')->delete($document->file_path);
            }
            $document->delete();
        }

        session()->flash('success', count($this->selectedDocuments) . ' dokumen berhasil dihapus!');
    }

    private function bulkExport()
    {
        $documents = Document::whereIn('id', $this->selectedDocuments)->get();
        return Excel::download(new DocumentsExport($documents), 'documents-' . date('Y-m-d') . '.xlsx');
    }

    public function exportAll()
    {
        $documents = $this->getFilteredQuery()->get();
        return Excel::download(new DocumentsExport($documents), 'all-documents-' . date('Y-m-d') . '.xlsx');
    }

    public function importDocuments()
    {
        $this->validate([
            'importFile' => 'required|mimes:xlsx,xls|max:10240',
        ]);

        try {
            Excel::import(new DocumentsImport, $this->importFile);
            session()->flash('success', 'Data berhasil diimport!');
            $this->showImportModal = false;
            $this->importFile = null;
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan saat import: ' . $e->getMessage());
        }
    }

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

    public function resetFilters()
    {
        $this->search = '';
        $this->fileType = '';
        $this->categoryFilter = '';
        $this->yearFilter = '';
        $this->archiveCategoryFilter = '';
        $this->resetPage();
    }

    public function downloadTemplate()
    {
        return Excel::download(new \App\Exports\DocumentTemplateExport, 'template-import-dokumen.xlsx');
    }

    public function render()
    {
        if (!auth()->user()->can('documents.view') && !auth()->user()->can('documents.view-own')) {
            abort(403, 'Unauthorized');
        }

        $query = Document::query();

        // Filter based on permissions
        if (auth()->user()->can('documents.view')) {
            // Super admin can see all
            $documents = $query->with(['user', 'category', 'archiveClassification']);
        } else {
            // Regular user only see own documents
            $documents = $query->where('user_id', auth()->id())
                ->with(['user', 'category', 'archiveClassification']);
        }

        // Apply other filters...
        $documents = $documents->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        $documents = $this->getFilteredQuery()
            ->with(['user', 'category', 'archiveClassification'])
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        $categories = Category::orderBy('name')->get();
        $years = Document::selectRaw('YEAR(tahun) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        // BARU: Kategori klasifikasi arsip
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

        return view('livewire.documents.document-index', [
            'documents' => $documents,
            'categories' => $categories,
            'years' => $years,
            'archiveCategories' => $archiveCategories,
        ]);
    }
}
