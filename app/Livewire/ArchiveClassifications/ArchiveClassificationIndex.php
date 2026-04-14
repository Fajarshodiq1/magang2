<?php

namespace App\Livewire\ArchiveClassifications;

use App\Models\ArchiveClassification;
use Livewire\Component;
use Livewire\WithPagination;

class ArchiveClassificationIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $categoryFilter = '';
    public $statusFilter = 'all';
    public $perPage = 10;

    protected $queryString = [
        'search' => ['except' => ''],
        'categoryFilter' => ['except' => ''],
        'statusFilter' => ['except' => 'all'],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingCategoryFilter()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function toggleStatus($id)
    {
        $classification = ArchiveClassification::findOrFail($id);
        $classification->update(['is_active' => !$classification->is_active]);

        session()->flash('success', 'Status berhasil diubah!');
    }

    public function delete($id)
    {
        try {
            $classification = ArchiveClassification::findOrFail($id);

            // Check if used in documents
            if ($classification->documents()->count() > 0) {
                session()->flash('error', 'Tidak dapat menghapus! Kode klasifikasi ini masih digunakan oleh dokumen.');
                return;
            }

            $classification->delete();
            session()->flash('success', 'Kode klasifikasi berhasil dihapus!');
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal menghapus: ' . $e->getMessage());
        }
    }

    public function render()
    {
        $classifications = ArchiveClassification::query()
            ->search($this->search)
            ->byCategory($this->categoryFilter)
            ->when($this->statusFilter !== 'all', function ($q) {
                $q->where('is_active', $this->statusFilter === 'active');
            })
            ->withCount('documents')
            ->orderBy('category')
            ->orderBy('code')
            ->paginate($this->perPage);

        $categories = ArchiveClassification::query()
            ->select('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        return view('livewire.archive-classifications.archive-classification-index', [
            'classifications' => $classifications,
            'categories' => $categories,
        ]);
    }
}
