<?php

namespace App\Livewire\Category;

use App\Models\Category;
use Livewire\Component;

class CategoryCreate extends Component
{
    public $name;

    protected $rules = [
        "name" => "string|required|max:255",
    ];

    protected $messages = [
        "name.required" => "Nama harus diisi"
    ];

    public function save()
    {
        $this->validate();
        try {
            $category = Category::create([
                "name" => $this->name
            ]);
            session()->flash("success", "Category Berhasil ditambahkan");
            return $this->redirect('/categories', navigate: true);
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi Kesalahan');
        }
    }
    public function render()
    {
        return view('livewire.category.category-create');
    }
}