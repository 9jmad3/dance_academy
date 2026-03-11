<?php

namespace App\Livewire\Admin;

use App\Models\Academy;
use App\Models\Teacher;
use Livewire\Component;
use Livewire\WithFileUploads;

class Teachers extends Component
{
    use WithFileUploads;

    public ?int $editingId = null;
    public string $name = '';
    public ?string $bio = null;
    public $photo = null;
    public ?string $currentPhoto = null;
    public bool $is_active = true;
    public int $sort_order = 0;

    protected function academy(): Academy
    {
        return Academy::query()->first() ?: Academy::firstOrCreate(
            ['slug' => 'academia-demo'],
            ['name' => 'Academia Demo']
        );
    }

    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'bio' => ['nullable', 'string'],
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'is_active' => ['boolean'],
            'sort_order' => ['required', 'integer', 'min:0'],
        ];
    }

    public function save(): void
    {
        $validated = $this->validate();

        $teacherData = [
            'academy_id' => $this->academy()->id,
            'name' => $this->name,
            'bio' => $this->bio,
            'is_active' => $this->is_active,
            'sort_order' => $this->sort_order,
        ];

        if ($this->photo) {
            $teacherData['photo'] = $this->photo->store('teachers', 'public');
        }

        $teacher = Teacher::updateOrCreate(
            ['id' => $this->editingId],
            $teacherData
        );

        if ($this->editingId && !$this->photo && $this->currentPhoto) {
            $teacher->update(['photo' => $this->currentPhoto]);
        }

        $this->resetForm();
        session()->flash('success', 'Profesor guardado correctamente.');
    }

    public function edit(int $id): void
    {
        $teacher = Teacher::where('academy_id', $this->academy()->id)->findOrFail($id);

        $this->editingId = $teacher->id;
        $this->name = $teacher->name;
        $this->bio = $teacher->bio;
        $this->photo = null;
        $this->currentPhoto = $teacher->photo;
        $this->is_active = $teacher->is_active;
        $this->sort_order = $teacher->sort_order;
    }

    public function delete(int $id): void
    {
        Teacher::where('academy_id', $this->academy()->id)->findOrFail($id)->delete();
        $this->resetForm();
        session()->flash('success', 'Profesor eliminado correctamente.');
    }

    public function resetForm(): void
    {
        $this->reset(['editingId', 'name', 'bio', 'photo', 'currentPhoto']);
        $this->is_active = true;
        $this->sort_order = 0;
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.admin.teachers', [
            'teachers' => Teacher::where('academy_id', $this->academy()->id)
                ->orderBy('sort_order')
                ->orderBy('name')
                ->get(),
        ])->layout('layouts.admin', ['title' => 'Profesores']);
    }
}
