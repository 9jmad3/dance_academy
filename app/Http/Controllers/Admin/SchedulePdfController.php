<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Academy;
use App\Models\Schedule;
use App\Models\Teacher;
use App\Models\DanceStyle;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SchedulePdfController extends Controller
{
    public function __invoke(Request $request)
    {
        $academy = Academy::query()->firstOrFail();

        $days = [
            'monday' => 'Lunes',
            'tuesday' => 'Martes',
            'wednesday' => 'Miércoles',
            'thursday' => 'Jueves',
            'friday' => 'Viernes',
            'saturday' => 'Sábado',
            'sunday' => 'Domingo',
        ];

        $weekStart = Carbon::now()->startOfWeek(Carbon::MONDAY);
        $weekEnd = Carbon::now()->endOfWeek(Carbon::SUNDAY);

        $primaryColor = $academy->primary_color ?? '#0f172a';
        $secondaryColor = $academy->secondary_color ?? '#334155';

        $danceStyleId = $request->query('dance_style_id');
        $dayOfWeek = $request->query('day_of_week');
        $teacherId = $request->query('teacher_id');

        $query = Schedule::with(['danceStyle', 'teachers'])
            ->where('academy_id', $academy->id)
            ->where('is_active', true);

        if ($danceStyleId) {
            $query->where('dance_style_id', $danceStyleId);
        }

        if ($dayOfWeek) {
            $query->where('day_of_week', $dayOfWeek);
        }

        if ($teacherId) {
            $query->whereHas('teachers', function ($q) use ($teacherId) {
                $q->where('teachers.id', $teacherId);
            });
        }

        $schedules = $query
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
            ->get()
            ->groupBy('day_of_week');

        $selectedStyle = $danceStyleId
            ? DanceStyle::where('academy_id', $academy->id)->find($danceStyleId)
            : null;

        $selectedTeacher = $teacherId
            ? Teacher::where('academy_id', $academy->id)->find($teacherId)
            : null;

        $selectedDayLabel = $dayOfWeek && isset($days[$dayOfWeek])
            ? $days[$dayOfWeek]
            : null;

        $pdf = Pdf::loadView('pdf.schedules', [
            'academy' => $academy,
            'days' => $days,
            'schedules' => $schedules,
            'weekStart' => $weekStart,
            'weekEnd' => $weekEnd,
            'primaryColor' => $primaryColor,
            'secondaryColor' => $secondaryColor,
            'selectedStyle' => $selectedStyle,
            'selectedTeacher' => $selectedTeacher,
            'selectedDayLabel' => $selectedDayLabel,
        ])->setPaper('a4', 'portrait');

        return $pdf->download('horarios-semana-' . $weekStart->format('Y-m-d') . '.pdf');
    }
}
