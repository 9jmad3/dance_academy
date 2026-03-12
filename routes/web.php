<?php

use App\Livewire\Admin\AcademySettings;
use App\Livewire\Admin\DanceStyles;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Schedules;
use App\Http\Controllers\Admin\SchedulePdfController;
use App\Livewire\Admin\Teachers;
use App\Livewire\Admin\Users;
use App\Models\Academy;
use App\Models\DanceStyle;
use App\Models\Schedule;
use App\Models\Teacher;
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Account;

$academyResolver = function () {
    return Academy::query()->first() ?: Academy::firstOrCreate(
        ['slug' => 'academia-demo'],
        [
            'name' => 'Academia Demo',
            'description' => 'Configura la academia desde el panel admin.',
            'hero_title' => 'Baila con nosotros',
            'hero_text' => 'Clases para todos los niveles con horarios flexibles.',
        ]
    );
};

Route::get('/', function () use ($academyResolver) {
    $academy = $academyResolver();

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

    $schedules = Schedule::with(['danceStyle', 'teachers'])
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

    $groupedSchedules = [
        'Latino' => $schedules->filter(
            fn($schedule) =>
            $schedule->danceStyle->name === 'Latino'
        )->values(),

        'Urbano' => $schedules->filter(
            fn($schedule) =>
            $schedule->danceStyle->name === 'Urbano'
        )->values(),
    ];

    $todayMap = [
        1 => 'monday',
        2 => 'tuesday',
        3 => 'wednesday',
        4 => 'thursday',
        5 => 'friday',
        6 => 'saturday',
        7 => 'sunday',
    ];

    $currentDaySlug = $todayMap[now()->dayOfWeekIso];

    $orderedDays = [];
    for ($i = 0; $i < 7; $i++) {
        $dayNumber = (($todayMap ? now()->dayOfWeekIso : 1) - 1 + $i) % 7 + 1;
        $orderedDays[] = $todayMap[$dayNumber];
    }

    $nextAvailableDay = null;
    $nextAvailableSchedules = collect();

    foreach ($orderedDays as $day) {
        $daySchedules = $schedules->where('day_of_week', $day)->values();

        if ($daySchedules->isNotEmpty()) {
            $nextAvailableDay = $day;
            $nextAvailableSchedules = $daySchedules;
            break;
        }
    }

    return view('public.home', [
        'academy' => $academy,
        'styles' => $styles,
        'teachers' => $teachers,
        'schedules' => $schedules,
        'groupedSchedules' => $groupedSchedules,
        'currentDaySlug' => $currentDaySlug,
        'nextAvailableDay' => $nextAvailableDay,
        'nextAvailableSchedules' => $nextAvailableSchedules,
    ]);
})->name('public.home');

Route::get('/horarios', function () use ($academyResolver) {
    $academy = $academyResolver();

    return view('public.horarios', [
        'academy' => $academy,
        'schedules' => Schedule::with(['danceStyle', 'teachers'])
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
            ->get(),
    ]);
})->name('public.schedules');

Route::get('/estilos', function () use ($academyResolver) {
    $academy = $academyResolver();

    return view('public.estilos', [
        'academy' => $academy,
        'styles' => DanceStyle::where('academy_id', $academy->id)
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get(),
    ]);
})->name('public.styles');

Route::get('/profesores', function () use ($academyResolver) {
    $academy = $academyResolver();

    return view('public.profesores', [
        'academy' => $academy,
        'teachers' => Teacher::where('academy_id', $academy->id)
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get(),
    ]);
})->name('public.teachers');

Route::get('/contacto', function () use ($academyResolver) {
    return view('public.contacto', [
        'academy' => $academyResolver(),
    ]);
})->name('public.contact');

Route::middleware(['auth', 'active'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', Dashboard::class)->name('dashboard');
    Route::get('/academia', AcademySettings::class)->name('academy');
    Route::get('/estilos', DanceStyles::class)->name('styles');
    Route::get('/profesores', Teachers::class)->name('teachers');
    Route::get('/horarios', Schedules::class)->name('schedules');
    Route::get('/horarios/pdf', SchedulePdfController::class)->name('schedules.pdf');
    Route::get('/usuarios', Users::class)->name('users');
    Route::get('/cuenta', Account::class)->name('account');
});
