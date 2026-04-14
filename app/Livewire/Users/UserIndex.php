<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use Spatie\Permission\Models\Role;

class UserIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $roleFilter = '';
    public $perPage = 10;

    protected $queryString = [
        'search' => ['except' => ''],
        'roleFilter' => ['except' => ''],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingRoleFilter()
    {
        $this->resetPage();
    }

    #[On('delete-user')]
    public function delete($id)
    {
        // Prevent deleting own account
        if ($id == auth()->id()) {
            session()->flash('error', 'Anda tidak dapat menghapus akun sendiri!');
            return;
        }

        $user = User::findOrFail($id);

        // Prevent deleting if user has documents
        if ($user->documents()->count() > 0) {
            session()->flash('error', 'User memiliki dokumen. Hapus dokumen terlebih dahulu!');
            return;
        }

        $user->delete();
        session()->flash('success', 'User berhasil dihapus!');
    }

    public function resetFilters()
    {
        $this->search = '';
        $this->roleFilter = '';
        $this->resetPage();
    }

    public function render()
    {
        $users = User::query()
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->roleFilter, function ($query) {
                $query->role($this->roleFilter);
            })
            ->with('roles')
            ->withCount('documents')
            ->latest()
            ->paginate($this->perPage);

        $roles = Role::all();

        return view('livewire.users.user-index', [
            'users' => $users,
            'roles' => $roles,
        ]);
    }
}
