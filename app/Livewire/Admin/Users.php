<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Users extends Component
{
    public ?int $userId = null;

    public string $name = '';
    public string $email = '';
    public string $password = '';
    public bool $is_active = true;

    public bool $showForm = false;
    public bool $isEditing = false;

    public function create(): void
    {
        $this->resetForm();
        $this->isEditing = false;
        $this->showForm = true;
    }

    public function edit(int $id): void
    {
        $user = User::findOrFail($id);

        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->password = '';
        $this->is_active = (bool) $user->is_active;
        $this->isEditing = true;
        $this->showForm = true;
    }

    public function save(): void
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($this->userId),
            ],
            'is_active' => ['boolean'],
        ];

        if ($this->isEditing) {
            $rules['password'] = ['nullable', 'string', 'min:8'];
        } else {
            $rules['password'] = ['required', 'string', 'min:8'];
        }

        $validated = $this->validate($rules);

        if ($this->isEditing) {
            $user = User::findOrFail($this->userId);

            $data = [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'is_active' => $validated['is_active'],
            ];

            if (!empty($validated['password'])) {
                $data['password'] = Hash::make($validated['password']);
            }

            $user->update($data);

            session()->flash('success', 'Usuario actualizado correctamente.');
        } else {
            User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'is_active' => $validated['is_active'],
            ]);

            session()->flash('success', 'Usuario creado correctamente.');
        }

        $this->resetForm();
    }

    public function cancel(): void
    {
        $this->resetForm();
    }

    public function toggleActive(int $id): void
    {
        $user = User::findOrFail($id);

        $user->update([
            'is_active' => !$user->is_active,
        ]);

        session()->flash('success', 'Estado del usuario actualizado.');
    }

    private function resetForm(): void
    {
        $this->reset([
            'userId',
            'name',
            'email',
            'password',
            'showForm',
            'isEditing',
        ]);

        $this->is_active = true;
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.admin.users', [
            'users' => User::query()->orderBy('name')->get(),
        ])->layout('layouts.admin', [
            'title' => 'Usuarios',
        ]);
    }
}
