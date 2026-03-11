<?php

namespace Database\Seeders;

use App\Models\Academy;
use App\Models\DanceStyle;
use App\Models\Schedule;
use App\Models\Teacher;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    public function run(): void
    {
        $academy = Academy::where('slug', 'dancelife-huelva')->firstOrFail();

        $styles = DanceStyle::where('academy_id', $academy->id)
            ->get()
            ->keyBy('name');

        $teachers = Teacher::where('academy_id', $academy->id)
            ->get()
            ->keyBy('name');

        $rows = [
            ['style' => 'Urbano', 'teachers' => ['Lidia Fernández'],  'day' => 'monday',    'start' => '16:00', 'end' => '17:00', 'level' => 'Mini'],
            ['style' => 'Urbano', 'teachers' => ['Celia Gonzalez'],   'day' => 'monday',    'start' => '17:00', 'end' => '18:00', 'level' => 'Kids'],
            ['style' => 'Urbano', 'teachers' => ['Lidia Fernández'],  'day' => 'monday',    'start' => '18:00', 'end' => '19:00', 'level' => 'Junior'],
            ['style' => 'Urbano', 'teachers' => ['Celia Gonzalez'],   'day' => 'monday',    'start' => '19:00', 'end' => '20:00', 'level' => 'Avanzado'],

            ['style' => 'Latino', 'teachers' => ['Charlie', 'Vero'],  'day' => 'monday',    'start' => '20:00', 'end' => '21:00', 'level' => 'Latino'],
            ['style' => 'Latino', 'teachers' => ['Charlie', 'Vero'],  'day' => 'monday',    'start' => '21:00', 'end' => '22:00', 'level' => 'Latino'],

            ['style' => 'Urbano', 'teachers' => ['Lidia Fernández'],  'day' => 'tuesday',   'start' => '16:00', 'end' => '17:00', 'level' => 'Mini'],
            ['style' => 'Urbano', 'teachers' => ['Celia Gonzalez'],   'day' => 'tuesday',   'start' => '17:00', 'end' => '18:00', 'level' => 'Kids'],
            ['style' => 'Urbano', 'teachers' => ['Lidia Fernández'],  'day' => 'tuesday',   'start' => '18:00', 'end' => '19:00', 'level' => 'Junior'],

            ['style' => 'Latino', 'teachers' => ['Charlie', 'Vero'],  'day' => 'tuesday',   'start' => '20:00', 'end' => '21:00', 'level' => 'Latino'],
            ['style' => 'Latino', 'teachers' => ['Charlie', 'Vero'],  'day' => 'tuesday',   'start' => '21:00', 'end' => '22:00', 'level' => 'Latino'],

            ['style' => 'Urbano', 'teachers' => ['Celia Gonzalez'],   'day' => 'wednesday', 'start' => '16:00', 'end' => '17:00', 'level' => 'Mini'],
            ['style' => 'Urbano', 'teachers' => ['Lidia Fernández'],  'day' => 'wednesday', 'start' => '17:00', 'end' => '18:00', 'level' => 'Kids'],
            ['style' => 'Urbano', 'teachers' => ['Celia Gonzalez'],   'day' => 'wednesday', 'start' => '18:00', 'end' => '19:00', 'level' => 'Junior'],

            ['style' => 'Latino', 'teachers' => ['Charlie', 'Vero'],  'day' => 'wednesday', 'start' => '20:00', 'end' => '21:00', 'level' => 'Latino'],
            ['style' => 'Latino', 'teachers' => ['Charlie', 'Vero'],  'day' => 'wednesday', 'start' => '21:00', 'end' => '22:00', 'level' => 'Latino'],

            ['style' => 'Urbano', 'teachers' => ['Lidia Fernández'],  'day' => 'thursday',  'start' => '16:00', 'end' => '17:00', 'level' => 'Mini'],
            ['style' => 'Urbano', 'teachers' => ['Celia Gonzalez'],   'day' => 'thursday',  'start' => '17:00', 'end' => '18:00', 'level' => 'Kids'],
            ['style' => 'Urbano', 'teachers' => ['Lidia Fernández'],  'day' => 'thursday',  'start' => '18:00', 'end' => '19:00', 'level' => 'Junior'],

            ['style' => 'Latino', 'teachers' => ['Charlie', 'Vero'],  'day' => 'thursday',  'start' => '20:00', 'end' => '21:00', 'level' => 'Latino'],
            ['style' => 'Latino', 'teachers' => ['Charlie', 'Vero'],  'day' => 'thursday',  'start' => '21:00', 'end' => '22:00', 'level' => 'Latino'],

            ['style' => 'Urbano', 'teachers' => ['Celia Gonzalez'],   'day' => 'friday',    'start' => '17:00', 'end' => '18:30', 'level' => 'Coreografía'],
        ];

        foreach ($rows as $i => $row) {
            $style = $styles->get($row['style']);

            if (!$style) {
                throw new \RuntimeException("No existe el estilo: {$row['style']}");
            }

            $teacherIds = collect($row['teachers'])->map(function ($teacherName) use ($teachers) {
                $teacher = $teachers->get($teacherName);

                if (!$teacher) {
                    throw new \RuntimeException("No existe el profesor: {$teacherName}");
                }

                return $teacher->id;
            })->values()->all();

            $schedule = Schedule::updateOrCreate(
                [
                    'academy_id' => $academy->id,
                    'dance_style_id' => $style->id,
                    'day_of_week' => $row['day'],
                    'start_time' => $row['start'],
                    'end_time' => $row['end'],
                ],
                [
                    'level' => $row['level'],
                    'room' => 'Sala 1',
                    'is_active' => true,
                    'sort_order' => $i + 1,
                ]
            );

            $schedule->teachers()->sync($teacherIds);
        }
    }
}
