<?php

namespace App\Livewire\Admin;

use App\Models\Academy;
use App\Models\DanceStyle;
use App\Models\Schedule;
use App\Models\Teacher;
use Livewire\Component;

class Schedules extends Component
{
    public ?int $editingId = null;
    public ?int $dance_style_id = null;
    public array $teacher_ids = [];
    public string $day_of_week = 'monday';
    public string $start_time = '18:00';
    public string $end_time = '19:00';
    public ?string $level = null;
    public ?string $room = null;
    public bool $is_active = true;
    public int $sort_order = 0;

    public ?string $filter_dance_style_id = null;
    public string $filter_day_of_week = '';
    public ?string $filter_teacher_id = null;

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
            'dance_style_id' => ['required', 'exists:dance_styles,id'],
            'teacher_ids' => ['required', 'array', 'min:1'],
            'teacher_ids.*' => ['exists:teachers,id'],
            'day_of_week' => ['required', 'in:' . implode(',', array_keys(Schedule::DAYS))],
            'start_time' => ['required'],
            'end_time' => ['required', 'after:start_time'],
            'level' => ['nullable', 'string', 'max:100'],
            'room' => ['nullable', 'string', 'max:100'],
            'is_active' => ['boolean'],
            'sort_order' => ['required', 'integer', 'min:0'],
        ];
    }

    public function save(): void
    {
        $validated = $this->validate();
        $validated['academy_id'] = $this->academy()->id;

        unset($validated['teacher_ids']);

        $schedule = Schedule::updateOrCreate(
            ['id' => $this->editingId],
            $validated
        );

        $schedule->teachers()->sync($this->teacher_ids);

        $this->resetForm();
        session()->flash('success', 'Horario guardado correctamente.');
    }

    public function edit(int $id): void
    {
        $schedule = Schedule::where('academy_id', $this->academy()->id)->findOrFail($id);

        $this->editingId = $schedule->id;
        $this->dance_style_id = $schedule->dance_style_id;
        $this->teacher_ids = $schedule->teachers->pluck('id')->map(fn ($id) => (string) $id)->toArray();
        $this->day_of_week = $schedule->day_of_week;
        $this->start_time = substr((string) $schedule->start_time, 0, 5);
        $this->end_time = substr((string) $schedule->end_time, 0, 5);
        $this->level = $schedule->level;
        $this->room = $schedule->room;
        $this->is_active = $schedule->is_active;
        $this->sort_order = $schedule->sort_order;
    }

    public function delete(int $id): void
    {
        Schedule::where('academy_id', $this->academy()->id)->findOrFail($id)->delete();
        $this->resetForm();
        session()->flash('success', 'Horario eliminado correctamente.');
    }

    public function resetForm(): void
    {
        $this->reset(['editingId', 'dance_style_id', 'teacher_ids', 'level', 'room']);
        $this->day_of_week = 'monday';
        $this->start_time = '18:00';
        $this->end_time = '19:00';
        $this->is_active = true;
        $this->sort_order = 0;
        $this->resetValidation();
    }

    public function resetFilters(): void
    {
        $this->filter_dance_style_id = null;
        $this->filter_day_of_week = '';
        $this->filter_teacher_id = null;
    }

    public function render()
    {
        $academy = $this->academy();

        $styles = DanceStyle::where('academy_id', $academy->id)
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $teachers = Teacher::where('academy_id', $academy->id)
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $schedulesQuery = Schedule::with(['danceStyle', 'teachers'])
            ->where('academy_id', $academy->id);

        if ($this->filter_dance_style_id) {
            $schedulesQuery->where('dance_style_id', $this->filter_dance_style_id);
        }

        if ($this->filter_day_of_week !== '') {
            $schedulesQuery->where('day_of_week', $this->filter_day_of_week);
        }

        if ($this->filter_teacher_id) {
            $schedulesQuery->whereHas('teachers', function ($query) {
                $query->where('teachers.id', $this->filter_teacher_id);
            });
        }

        $schedules = $schedulesQuery
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

        return view('livewire.admin.schedules', [
            'days' => Schedule::DAYS,
            'styles' => $styles,
            'teachers' => $teachers,
            'schedules' => $schedules,
        ])->layout('layouts.admin', ['title' => 'Horarios']);
    }
}
