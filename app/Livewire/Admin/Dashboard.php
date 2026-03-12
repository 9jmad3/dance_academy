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

        $dayLabels = [
            'monday' => 'Lun',
            'tuesday' => 'Mar',
            'wednesday' => 'Mié',
            'thursday' => 'Jue',
            'friday' => 'Vie',
            'saturday' => 'Sáb',
            'sunday' => 'Dom',
        ];

        $teachersLoad = Teacher::query()
            ->where('academy_id', $academy->id)
            ->where('is_active', true)
            ->with(['schedules' => function ($query) use ($academy) {
                $query->where('academy_id', $academy->id)
                    ->where('is_active', true)
                    ->orderByRaw("CASE day_of_week
                        WHEN 'monday' THEN 1
                        WHEN 'tuesday' THEN 2
                        WHEN 'wednesday' THEN 3
                        WHEN 'thursday' THEN 4
                        WHEN 'friday' THEN 5
                        WHEN 'saturday' THEN 6
                        WHEN 'sunday' THEN 7
                        ELSE 8 END")
                    ->orderBy('start_time');
            }])
            ->get()
            ->map(function ($teacher) use ($dayLabels) {
                $totalMinutes = 0;
                $classesByDay = [];

                foreach ($dayLabels as $dayKey => $dayLabel) {
                    $classesByDay[$dayKey] = [
                        'label' => $dayLabel,
                        'count' => 0,
                        'minutes' => 0,
                    ];
                }

                foreach ($teacher->schedules as $schedule) {
                    $start = strtotime($schedule->start_time);
                    $end = strtotime($schedule->end_time);

                    $minutes = (! $start || ! $end || $end <= $start)
                        ? 0
                        : (int) (($end - $start) / 60);

                    $totalMinutes += $minutes;

                    if (isset($classesByDay[$schedule->day_of_week])) {
                        $classesByDay[$schedule->day_of_week]['count']++;
                        $classesByDay[$schedule->day_of_week]['minutes'] += $minutes;
                    }
                }

                $hoursTotal = round($totalMinutes / 60, 1);
                $classesCount = $teacher->schedules->count();

                if ($hoursTotal >= 8) {
                    $loadLevel = 'alta';
                    $loadColor = 'bg-red-500';
                    $loadBadge = 'bg-red-100 text-red-700';
                } elseif ($hoursTotal >= 4) {
                    $loadLevel = 'media';
                    $loadColor = 'bg-amber-500';
                    $loadBadge = 'bg-amber-100 text-amber-700';
                } else {
                    $loadLevel = 'baja';
                    $loadColor = 'bg-emerald-500';
                    $loadBadge = 'bg-emerald-100 text-emerald-700';
                }

                return (object) [
                    'name' => $teacher->name,
                    'classes_count' => $classesCount,
                    'hours_total' => $hoursTotal,
                    'minutes_total' => $totalMinutes,
                    'classes_by_day' => collect($classesByDay)->values(),
                    'load_level' => $loadLevel,
                    'load_color' => $loadColor,
                    'load_badge' => $loadBadge,
                ];
            })
            ->sortByDesc('minutes_total')
            ->values();

        $maxTeacherMinutes = $teachersLoad->max('minutes_total') ?: 1;

        $teachersWithLoad = $teachersLoad
            ->filter(fn($teacher) => $teacher->minutes_total > 0)
            ->values();

        $maxMinutes = $teachersWithLoad->max('minutes_total');
        $minMinutes = $teachersWithLoad->min('minutes_total');

        $topTeachers = $teachersWithLoad
            ->filter(fn($teacher) => $teacher->minutes_total === $maxMinutes)
            ->values();

        $minTeachers = $teachersWithLoad
            ->filter(fn($teacher) => $teacher->minutes_total === $minMinutes)
            ->values();

        $totalTeamHours = round($teachersLoad->sum('minutes_total') / 60, 1);

        $weekStudioLoadBase = [
            'monday' => ['label' => 'Lunes', 'classes' => 0, 'minutes' => 0],
            'tuesday' => ['label' => 'Martes', 'classes' => 0, 'minutes' => 0],
            'wednesday' => ['label' => 'Miércoles', 'classes' => 0, 'minutes' => 0],
            'thursday' => ['label' => 'Jueves', 'classes' => 0, 'minutes' => 0],
            'friday' => ['label' => 'Viernes', 'classes' => 0, 'minutes' => 0],
            'saturday' => ['label' => 'Sábado', 'classes' => 0, 'minutes' => 0],
            'sunday' => ['label' => 'Domingo', 'classes' => 0, 'minutes' => 0],
        ];

        $activeSchedules = Schedule::query()
            ->where('academy_id', $academy->id)
            ->where('is_active', true)
            ->get();

        foreach ($activeSchedules as $schedule) {
            $start = strtotime($schedule->start_time);
            $end = strtotime($schedule->end_time);

            $minutes = (! $start || ! $end || $end <= $start)
                ? 0
                : (int) (($end - $start) / 60);

            if (isset($weekStudioLoadBase[$schedule->day_of_week])) {
                $weekStudioLoadBase[$schedule->day_of_week]['classes']++;
                $weekStudioLoadBase[$schedule->day_of_week]['minutes'] += $minutes;
            }
        }

        $weekStudioLoad = collect($weekStudioLoadBase)
            ->map(function ($day) {
                $day['hours'] = round($day['minutes'] / 60, 1);

                return (object) $day;
            })
            ->values();

        $maxStudioDayMinutes = $weekStudioLoad->max('minutes') ?: 1;

        $daysWithClasses = $weekStudioLoad
            ->filter(fn($day) => $day->minutes > 0)
            ->values();

        $topStudioDays = collect();
        $minStudioDays = collect();
        $averageStudioHours = 0;

        if ($daysWithClasses->isNotEmpty()) {
            $maxDayMinutes = $daysWithClasses->max('minutes');
            $minDayMinutes = $daysWithClasses->min('minutes');

            $topStudioDays = $daysWithClasses
                ->filter(fn($day) => $day->minutes === $maxDayMinutes)
                ->values();

            $minStudioDays = $daysWithClasses
                ->filter(fn($day) => $day->minutes === $minDayMinutes)
                ->values();

            $averageStudioHours = round($daysWithClasses->avg('minutes') / 60, 1);
        }

        $weeklyAgendaBase = [
            'monday' => ['label' => 'Lunes', 'items' => collect()],
            'tuesday' => ['label' => 'Martes', 'items' => collect()],
            'wednesday' => ['label' => 'Miércoles', 'items' => collect()],
            'thursday' => ['label' => 'Jueves', 'items' => collect()],
            'friday' => ['label' => 'Viernes', 'items' => collect()],
            'saturday' => ['label' => 'Sábado', 'items' => collect()],
            'sunday' => ['label' => 'Domingo', 'items' => collect()],
        ];

        $agendaSchedules = Schedule::with(['danceStyle', 'teachers'])
            ->where('academy_id', $academy->id)
            ->where('is_active', true)
            ->orderByRaw("CASE day_of_week
        WHEN 'monday' THEN 1
        WHEN 'tuesday' THEN 2
        WHEN 'wednesday' THEN 3
        WHEN 'thursday' THEN 4
        WHEN 'friday' THEN 5
        WHEN 'saturday' THEN 6
        WHEN 'sunday' THEN 7
        ELSE 8 END")
            ->orderBy('start_time')
            ->orderBy('sort_order')
            ->get();

        foreach ($agendaSchedules as $schedule) {
            if (isset($weeklyAgendaBase[$schedule->day_of_week])) {
                $weeklyAgendaBase[$schedule->day_of_week]['items']->push((object) [
                    'time' => substr($schedule->start_time, 0, 5) . ' - ' . substr($schedule->end_time, 0, 5),
                    'style' => $schedule->danceStyle?->name ?? 'Sin estilo',
                    'teachers' => $schedule->teachers->pluck('name')->join(', '),
                    'room' => $schedule->room ?: 'Sin sala',
                    'level' => $schedule->level ?: 'Sin nivel',
                ]);
            }
        }

        $weeklyAgenda = collect($weeklyAgendaBase)
            ->map(fn($day) => (object) [
                'label' => $day['label'],
                'items' => $day['items'],
            ])
            ->values();

        return view('livewire.admin.dashboard', [
            'academy' => $academy,
            'stylesCount' => DanceStyle::where('academy_id', $academy->id)->where('is_active', true)->count(),
            'teachersCount' => Teacher::where('academy_id', $academy->id)->where('is_active', true)->count(),
            'schedulesCount' => Schedule::where('academy_id', $academy->id)->where('is_active', true)->count(),
            'latestSchedules' => Schedule::with(['danceStyle', 'teachers'])
                ->where('academy_id', $academy->id)
                ->where('is_active', true)
                ->latest()
                ->take(5)
                ->get(),
            'teachersLoad' => $teachersLoad,
            'maxTeacherMinutes' => $maxTeacherMinutes,
            'topTeachers' => $topTeachers,
            'minTeachers' => $minTeachers,
            'totalTeamHours' => $totalTeamHours,
            'weekStudioLoad' => $weekStudioLoad,
            'maxStudioDayMinutes' => $maxStudioDayMinutes,
            'topStudioDays' => $topStudioDays,
            'minStudioDays' => $minStudioDays,
            'averageStudioHours' => $averageStudioHours,
            'weeklyAgenda' => $weeklyAgenda,
        ])->layout('layouts.admin', ['title' => 'Dashboard']);
    }
}
