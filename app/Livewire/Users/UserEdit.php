<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserEdit extends Component
{
    public User $user;
    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $role_id;
    public $change_password = false;

    public function mount(User $user)
    {
        $this->user = $user;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role_id = $user->roles->first()?->id;
    }

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->user->id,
            'password' => $this->change_password ? 'required|string|min:8|confirmed' : 'nullable',
            'role_id' => 'required|exists:roles,id',
        ];
    }

    protected $messages = [
        'name.required' => 'Nama harus diisi.',
        'email.required' => 'Email harus diisi.',
        'email.email' => 'Format email tidak valid.',
        'email.unique' => 'Email sudah digunakan.',
        'password.required' => 'Password harus diisi.',
        'password.min' => 'Password minimal 8 karakter.',
        'password.confirmed' => 'Konfirmasi password tidak cocok.',
        'role_id.required' => 'Role harus dipilih.',
    ];

    public function save()
    {
        $this->validate();

        try {
            // Update user
            $this->user->update([
                'name' => $this->name,
                'email' => $this->email,
            ]);

            // Update password if changed
            if ($this->change_password && $this->password) {
                $this->user->update([
                    'password' => Hash::make($this->password),
                ]);
            }

            // Sync role
            $role = Role::findById($this->role_id);
            $this->user->syncRoles([$role]);

            session()->flash('success', 'User berhasil diupdate!');
            return $this->redirect('/users', navigate: true);
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function render()
    {
        $roles = Role::all();

        return view('livewire.users.user-edit', [
            'roles' => $roles,
        ]);
    }
}
