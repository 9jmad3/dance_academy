<?php

namespace App\Livewire\Admin;

use App\Models\Academy;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class AcademySettings extends Component
{
    use WithFileUploads;

    public ?int $academyId = null;
    public string $name = '';
    public string $slug = '';
    public ?string $description = null;
    public ?string $phone = null;
    public ?string $email = null;
    public ?string $whatsapp = null;
    public ?string $address = null;
    public ?string $instagram_url = null;
    public $banner = null;
    public ?string $currentBanner = null;
    public ?string $hero_title = null;
    public ?string $hero_text = null;

    public function mount(): void
    {
        $academy = Academy::query()->first() ?: Academy::firstOrCreate(
            ['slug' => 'academia-demo'],
            [
                'name' => 'Academia Demo',
                'description' => 'Configura aquí la información principal de tu academia.',
                'hero_title' => 'Baila con nosotros',
                'hero_text' => 'Clases para todos los niveles con un equipo profesional.',
            ]
        );

        $this->academyId = $academy->id;
        $this->name = $academy->name;
        $this->slug = $academy->slug;
        $this->description = $academy->description;
        $this->phone = $academy->phone;
        $this->email = $academy->email;
        $this->whatsapp = $academy->whatsapp;
        $this->address = $academy->address;
        $this->instagram_url = $academy->instagram_url;
        $this->currentBanner = $academy->banner;
        $this->hero_title = $academy->hero_title;
        $this->hero_text = $academy->hero_text;
    }

    public function updatedName($value): void
    {
        if (blank($this->slug)) {
            $this->slug = Str::slug($value);
        }
    }

    public function save(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'alpha_dash', 'unique:academies,slug,' . $this->academyId],
            'description' => ['nullable', 'string'],
            'phone' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
            'whatsapp' => ['nullable', 'string', 'max:50'],
            'address' => ['nullable', 'string', 'max:255'],
            'instagram_url' => ['nullable', 'url', 'max:255'],
            'banner' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'hero_title' => ['nullable', 'string', 'max:255'],
            'hero_text' => ['nullable', 'string'],
        ]);

        unset($validated['banner']);

        $academy = Academy::findOrFail($this->academyId);

        if ($this->banner) {
            $validated['banner'] = $this->banner->store('academies/banners', 'public');
        }

        $academy->update($validated);

        $this->currentBanner = $academy->fresh()->banner;
        $this->banner = null;

        session()->flash('success', 'Academia actualizada correctamente.');
    }

    public function render()
    {
        return view('livewire.admin.academy-settings')
            ->layout('layouts.admin', ['title' => 'Academia']);
    }
}
