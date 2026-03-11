<?php

namespace App\Livewire\Admin;

use App\Models\Academy;
use App\Models\DanceStyle;
use App\Models\Schedule;
use App\Models\Teacher;
use Livewire\Component;

class Dashboard extends Component
{
    public function getAcademyProperty(): Academy
    {
        return Academy::query()->first() ?: Academy::firstOrCreate(
            ['slug' => 'academia-demo'],
            [
                'name' => 'Academia Demo',
                'description' => 'Configura aquí la información principal de tu academia.',
                'hero_title' => 'Baila con nosotros',
                'hero_text' => 'Clases para todos los niveles con un equipo profesional.',
            ]
        );
    }

    public function render()
    {
        $academy = $this->academy;

        return view('livewire.admin.dashboard', [
            'academy' => $academy,
            'stylesCount' => DanceStyle::where('academy_id', $academy->id)->count(),
            'teachersCount' => Teacher::where('academy_id', $academy->id)->count(),
            'schedulesCount' => Schedule::where('academy_id', $academy->id)->count(),
            'latestSchedules' => Schedule::with(['danceStyle', 'teachers'])
                ->where('academy_id', $academy->id)
                ->latest()
                ->take(5)
                ->get(),
        ])->layout('layouts.admin', ['title' => 'Dashboard']);
    }
}
