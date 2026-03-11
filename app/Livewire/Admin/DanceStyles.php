<?php

namespace App\Livewire\Admin;

use App\Models\Academy;
use App\Models\DanceStyle;
use Livewire\Component;

class DanceStyles extends Component
{
    public ?int $editingId = null;
    public string $name = '';
    public ?string $description = null;
    public bool $is_active = true;
    public int $sort_order = 0;

    protected function academy(): Academy
    {
        return Academy::query()->first() ?: Academy::firstOrCreate(['slug' => 'academia-demo'], ['name' => 'Academia Demo']);
    }

    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'is_active' => ['boolean'],
            'sort_order' => ['required', 'integer', 'min:0'],
        ];
    }

    public function save(): void
    {
        $validated = $this->validate();
        $validated['academy_id'] = $this->academy()->id;

        DanceStyle::updateOrCreate(
            ['id' => $this->editingId],
            $validated
        );

        $this->resetForm();
        session()->flash('success', 'Estilo guardado correctamente.');
    }

    public function edit(int $id): void
    {
        $style = DanceStyle::where('academy_id', $this->academy()->id)->findOrFail($id);

        $this->editingId = $style->id;
        $this->name = $style->name;
        $this->description = $style->description;
        $this->is_active = $style->is_active;
        $this->sort_order = $style->sort_order;
    }

    public function delete(int $id): void
    {
        DanceStyle::where('academy_id', $this->academy()->id)->findOrFail($id)->delete();
        $this->resetForm();
        session()->flash('success', 'Estilo eliminado correctamente.');
    }

    public function resetForm(): void
    {
        $this->reset(['editingId', 'name', 'description']);
        $this->is_active = true;
        $this->sort_order = 0;
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.admin.dance-styles', [
            'styles' => DanceStyle::where('academy_id', $this->academy()->id)
                ->orderBy('sort_order')
                ->orderBy('name')
                ->get(),
        ])->layout('layouts.admin', ['title' => 'Estilos']);
    }
}
