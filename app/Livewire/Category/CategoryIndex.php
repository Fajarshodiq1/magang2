<?php

namespace App\Livewire\Category;

use App\Models\Category;
use Livewire\Component;

class CategoryIndex extends Component
{
    public $search = '';

    // Mengambil semua kategori
    public function getCategoriesProperty()
    {
        return Category::where('name', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->get();
    }

    // Hapus kategori
    public function deleteCategory($id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->delete();
            session()->flash('success', 'Kategori berhasil dihapus');
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan saat menghapus kategori');
        }
    }

    public function render()
    {
        $categories = Category::query()
            ->withCount('documents')
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->paginate(10);

        return view('livewire.category.category-index', compact('categories'));
    }
}
