<div class="space-y-6">
    {{-- MÉTRICAS --}}
    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-3">
        <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200 sm:p-6">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <p class="text-sm font-medium text-slate-500">Estilos activos</p>
                    <p class="mt-2 text-3xl font-bold tracking-tight text-slate-900">{{ $stylesCount }}</p>
                </div>

                <div
                    class="flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-600 ring-1 ring-emerald-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                            d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.868v4.264a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                            d="M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9z" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200 sm:p-6">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <p class="text-sm font-medium text-slate-500">Profesores</p>
                    <p class="mt-2 text-3xl font-bold tracking-tight text-slate-900">{{ $teachersCount }}</p>
                </div>

                <div
                    class="flex h-12 w-12 items-center justify-center rounded-2xl bg-sky-50 text-sky-600 ring-1 ring-sky-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                            d="M17 20h5V9H2v11h5m10 0v-5a3 3 0 00-3-3H10a3 3 0 00-3 3v5m10 0H7m10-11a3 3 0 11-6 0 3 3 0 016 0zm-8 0a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200 sm:p-6 sm:col-span-2 xl:col-span-1">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <p class="text-sm font-medium text-slate-500">Clases en horario</p>
                    <p class="mt-2 text-3xl font-bold tracking-tight text-slate-900">{{ $schedulesCount }}</p>
                </div>

                <div
                    class="flex h-12 w-12 items-center justify-center rounded-2xl bg-violet-50 text-violet-600 ring-1 ring-violet-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                            d="M8 7V3m8 4V3m-9 8h10m-11 9h12a2 2 0 002-2V7a2 2 0 00-2-2H6a2 2 0 00-2 2v11a2 2 0 002 2z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    {{-- KPI --}}
    <div class="grid gap-4 md:grid-cols-3">
        <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200 sm:p-6">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <p class="text-sm font-medium text-slate-500">Mayor carga</p>
                    <p class="mt-2 text-lg font-bold tracking-tight text-slate-900">
                        {{ $topTeachers->pluck('name')->join(', ') ?: 'Sin datos' }}
                    </p>
                    <p class="mt-1 text-sm text-slate-500">
                        @if ($topTeachers->isNotEmpty())
                            {{ number_format($topTeachers->first()->hours_total, 1, ',', '.') }} h ·
                            {{ $topTeachers->first()->classes_count }} clases
                        @else
                            Todavía sin horarios
                        @endif
                    </p>
                </div>

                <div
                    class="flex h-12 w-12 items-center justify-center rounded-2xl bg-red-50 text-red-600 ring-1 ring-red-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                            d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200 sm:p-6">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <p class="text-sm font-medium text-slate-500">Menor carga</p>
                    <p class="text-sm font-small text-slate-500">No se cuentan los profesores con 0 horas</p>
                    <p class="mt-2 text-lg font-bold tracking-tight text-slate-900">
                        {{ $minTeachers->pluck('name')->join(', ') ?: 'Sin datos' }}
                    </p>
                    <p class="mt-1 text-sm text-slate-500">
                        @if ($minTeachers->isNotEmpty())
                            {{ number_format($minTeachers->first()->hours_total, 1, ',', '.') }} h ·
                            {{ $minTeachers->first()->classes_count }} clases
                        @endif
                    </p>
                </div>

                <div
                    class="flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-600 ring-1 ring-emerald-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                            d="M11 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200 sm:p-6">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <p class="text-sm font-medium text-slate-500">Horas del equipo</p>
                    <p class="mt-2 text-3xl font-bold tracking-tight text-slate-900">
                        {{ number_format($totalTeamHours, 1, ',', '.') }}
                    </p>
                    <p class="mt-1 text-sm text-slate-500">
                        Total semanal acumulado
                    </p>
                </div>

                <div
                    class="flex h-12 w-12 items-center justify-center rounded-2xl bg-violet-50 text-violet-600 ring-1 ring-violet-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200 sm:p-6">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-lg font-semibold text-slate-900">Carga semanal del estudio</h2>
                <p class="mt-1 text-sm text-slate-500">
                    Revisa qué días concentran más clases y horas en la academia.
                </p>
            </div>
        </div>

        <div class="mt-5 space-y-4">
            @foreach ($weekStudioLoad as $day)
                @php
                    $percentage =
                        $maxStudioDayMinutes > 0 ? min(100, round(($day->minutes / $maxStudioDayMinutes) * 100)) : 0;
                @endphp

                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm font-semibold text-slate-900">{{ $day->label }}</p>
                            <p class="mt-1 text-sm text-slate-500">
                                {{ $day->classes }} clases · {{ number_format($day->hours, 1, ',', '.') }} horas
                            </p>
                        </div>

                        <div class="text-sm font-medium text-slate-700">
                            {{ $percentage }}%
                        </div>
                    </div>

                    <div class="mt-3 h-3 overflow-hidden rounded-full bg-slate-200">
                        <div class="h-full rounded-full bg-slate-900" style="width: {{ $percentage }}%;"></div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="grid gap-4 md:grid-cols-3">
        <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200 sm:p-6">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <p class="text-sm font-medium text-slate-500">Día más cargado</p>
                    <p class="mt-2 text-lg font-bold tracking-tight text-slate-900">
                        {{ $topStudioDays->pluck('label')->join(', ') ?: 'Sin datos' }}
                    </p>
                    <p class="mt-1 text-sm text-slate-500">
                        @if ($topStudioDays->isNotEmpty())
                            {{ number_format($topStudioDays->first()->hours, 1, ',', '.') }} h ·
                            {{ $topStudioDays->first()->classes }} clases
                        @else
                            Todavía sin horarios
                        @endif
                    </p>
                </div>

                <div
                    class="flex h-12 w-12 items-center justify-center rounded-2xl bg-red-50 text-red-600 ring-1 ring-red-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                            d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200 sm:p-6">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <p class="text-sm font-medium text-slate-500">Día más libre</p>
                    <p class="mt-2 text-lg font-bold tracking-tight text-slate-900">
                        {{ $minStudioDays->pluck('label')->join(', ') ?: 'Sin datos' }}
                    </p>
                    <p class="mt-1 text-sm text-slate-500">
                        @if ($minStudioDays->isNotEmpty())
                            {{ number_format($minStudioDays->first()->hours, 1, ',', '.') }} h ·
                            {{ $minStudioDays->first()->classes }} clases
                        @else
                            Todavía sin horarios
                        @endif
                    </p>
                </div>

                <div
                    class="flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-600 ring-1 ring-emerald-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                            d="M11 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200 sm:p-6">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <p class="text-sm font-medium text-slate-500">Media por día</p>
                    <p class="mt-2 text-3xl font-bold tracking-tight text-slate-900">
                        {{ number_format($averageStudioHours, 1, ',', '.') }}
                    </p>
                    <p class="mt-1 text-sm text-slate-500">
                        Horas medias en días con clases
                    </p>
                </div>

                <div
                    class="flex h-12 w-12 items-center justify-center rounded-2xl bg-violet-50 text-violet-600 ring-1 ring-violet-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    {{-- CARGA POR PROFESOR --}}
    <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200 sm:p-6">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-lg font-semibold text-slate-900">Carga de trabajo por profesor</h2>
                <p class="mt-1 text-sm text-slate-500">
                    Visualiza el reparto de clases y horas semanales del equipo.
                </p>
            </div>
        </div>

        @if ($teachersLoad->isEmpty())
            <div
                class="mt-5 rounded-2xl border border-dashed border-slate-300 bg-slate-50 p-8 text-center text-sm text-slate-500">
                No hay profesores con horarios asignados.
            </div>
        @else
            <div class="mt-5 grid gap-4 xl:grid-cols-2">
                @foreach ($teachersLoad as $teacher)
                    @php
                        $percentage =
                            $maxTeacherMinutes > 0
                                ? min(100, round(($teacher->minutes_total / $maxTeacherMinutes) * 100))
                                : 0;
                    @endphp

                    <article class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                        <div class="flex items-start justify-between gap-4">
                            <div class="min-w-0">
                                <h3 class="truncate text-base font-semibold text-slate-900">
                                    {{ $teacher->name }}
                                </h3>

                                <div class="mt-2 flex flex-wrap items-center gap-2">
                                    <span
                                        class="inline-flex rounded-full bg-slate-900 px-3 py-1 text-xs font-semibold text-white">
                                        {{ $teacher->classes_count }} clases
                                    </span>

                                    <span
                                        class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $teacher->load_badge }}">
                                        Carga {{ $teacher->load_level }}
                                    </span>
                                </div>
                            </div>

                            <div class="text-right">
                                <p class="text-2xl font-bold tracking-tight text-slate-900">
                                    {{ number_format($teacher->hours_total, 1, ',', '.') }}
                                </p>
                                <p class="text-xs font-medium uppercase tracking-wide text-slate-500">
                                    horas
                                </p>
                            </div>
                        </div>

                        <div class="mt-4">
                            <div class="mb-2 flex items-center justify-between text-xs text-slate-500">
                                <span>Comparativa de carga</span>
                                <span>{{ $percentage }}%</span>
                            </div>

                            <div class="h-3 overflow-hidden rounded-full bg-slate-200">
                                <div class="h-full rounded-full {{ $teacher->load_color }}"
                                    style="width: {{ $percentage }}%;"></div>
                            </div>
                        </div>

                        <div class="mt-4 grid grid-cols-4 gap-2 sm:grid-cols-7">
                            @foreach ($teacher->classes_by_day as $day)
                                <div class="rounded-xl border border-slate-200 bg-white px-2 py-3 text-center">
                                    <p class="text-[11px] font-semibold uppercase tracking-wide text-slate-500">
                                        {{ $day['label'] }}
                                    </p>
                                    <p class="mt-2 text-sm font-bold text-slate-900">
                                        {{ $day['count'] }}
                                    </p>
                                    <p class="mt-1 text-[11px] text-slate-500">
                                        {{ round($day['minutes'] / 60, 1) }} h
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </div>

    <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200 sm:p-6">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-lg font-semibold text-slate-900">Agenda semanal visual</h2>
                <p class="mt-1 text-sm text-slate-500">
                    Vista rápida del horario activo organizado por días.
                </p>
            </div>

            <a href="{{ route('admin.schedules') }}"
                class="inline-flex rounded-xl border border-slate-200 px-4 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-50">
                Ver horarios
            </a>
        </div>

        <div class="mt-5 grid gap-4 lg:grid-cols-2 2xl:grid-cols-4">
            @foreach ($weeklyAgenda as $day)
                <section class="overflow-hidden rounded-2xl border border-slate-200 bg-slate-50">
                    <div class="border-b border-slate-200 bg-white px-4 py-3">
                        <h3 class="text-sm font-semibold text-slate-900">{{ $day->label }}</h3>
                        <p class="mt-1 text-xs text-slate-500">
                            {{ $day->items->count() }}
                            {{ \Illuminate\Support\Str::plural('clase', $day->items->count()) }}
                        </p>
                    </div>

                    <div class="space-y-3 p-4">
                        @forelse($day->items as $item)
                            <article class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                                <div class="flex items-start justify-between gap-3">
                                    <div>
                                        <p class="text-sm font-semibold text-slate-900">{{ $item->style }}</p>
                                        <p class="mt-1 text-xs font-medium uppercase tracking-wide text-slate-500">
                                            {{ $item->time }}
                                        </p>
                                    </div>

                                    <span
                                        class="inline-flex rounded-full bg-slate-900 px-2.5 py-1 text-[11px] font-semibold text-white">
                                        {{ $item->level }}
                                    </span>
                                </div>

                                <div class="mt-3 space-y-1.5 text-sm text-slate-600">
                                    <p>
                                        <span class="font-medium text-slate-900">Profes:</span>
                                        {{ $item->teachers ?: 'Sin profesores' }}
                                    </p>
                                    <p>
                                        <span class="font-medium text-slate-900">Sala:</span>
                                        {{ $item->room }}
                                    </p>
                                </div>
                            </article>
                        @empty
                            <div
                                class="rounded-2xl border border-dashed border-slate-300 bg-white p-6 text-center text-sm text-slate-500">
                                Sin clases este día.
                            </div>
                        @endforelse
                    </div>
                </section>
            @endforeach
        </div>
    </div>

    {{-- CONTENIDO --}}
    <div class="grid gap-6 xl:grid-cols-3">
        {{-- ÚLTIMOS HORARIOS --}}
        <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200 sm:p-6 xl:col-span-2">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h2 class="text-lg font-semibold text-slate-900">Últimos horarios</h2>
                    <p class="mt-1 text-sm text-slate-500">
                        Revisa rápidamente las clases más recientes creadas en el sistema.
                    </p>
                </div>

                <a href="{{ route('admin.schedules') }}"
                    class="inline-flex rounded-xl border border-slate-200 px-4 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-50">
                    Gestionar
                </a>
            </div>

            @if ($latestSchedules->isEmpty())
                <div
                    class="mt-5 rounded-2xl border border-dashed border-slate-300 bg-slate-50 p-8 text-center text-sm text-slate-500">
                    Todavía no hay horarios creados.
                </div>
            @else
                {{-- MÓVIL: CARDS --}}
                <div class="mt-5 space-y-4 md:hidden">
                    @foreach ($latestSchedules as $schedule)
                        <article class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                            <div class="flex items-start justify-between gap-3">
                                <div>
                                    <span
                                        class="inline-flex rounded-full bg-slate-900 px-3 py-1 text-xs font-semibold text-white">
                                        {{ $schedule->day_label }}
                                    </span>

                                    <p class="mt-3 text-base font-semibold text-slate-900">
                                        {{ $schedule->danceStyle->name }}
                                    </p>

                                    <p class="mt-1 text-sm text-slate-500">
                                        {{ substr($schedule->start_time, 0, 5) }} -
                                        {{ substr($schedule->end_time, 0, 5) }}
                                    </p>
                                </div>
                            </div>

                            <div class="mt-4 text-sm text-slate-600">
                                <p>
                                    <span class="font-medium text-slate-900">Profesores:</span>
                                    {{ $schedule->teachers->pluck('name')->join(', ') }}
                                </p>
                            </div>
                        </article>
                    @endforeach
                </div>

                {{-- TABLET/DESKTOP: TABLA --}}
                <div class="mt-5 hidden overflow-hidden rounded-2xl border border-slate-200 md:block">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-slate-200 text-sm">
                            <thead class="bg-slate-50 text-left text-slate-600">
                                <tr>
                                    <th class="px-4 py-3 font-medium">Día</th>
                                    <th class="px-4 py-3 font-medium">Hora</th>
                                    <th class="px-4 py-3 font-medium">Estilo</th>
                                    <th class="px-4 py-3 font-medium">Profesores</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-slate-200 bg-white">
                                @foreach ($latestSchedules as $schedule)
                                    <tr>
                                        <td class="px-4 py-4">
                                            <span
                                                class="inline-flex rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700">
                                                {{ $schedule->day_label }}
                                            </span>
                                        </td>

                                        <td class="px-4 py-4">
                                            {{ substr($schedule->start_time, 0, 5) }} -
                                            {{ substr($schedule->end_time, 0, 5) }}
                                        </td>

                                        <td class="px-4 py-4 font-medium text-slate-900">
                                            {{ $schedule->danceStyle->name }}
                                        </td>

                                        <td class="px-4 py-4 text-slate-600">
                                            {{ $schedule->teachers->pluck('name')->join(', ') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>

        {{-- ACADEMIA ACTUAL --}}
        <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200 sm:p-6">
            <div>
                <h2 class="text-lg font-semibold text-slate-900">Academia actual</h2>
                <p class="mt-1 text-sm text-slate-500">
                    Información principal configurada para la web pública.
                </p>
            </div>

            <div class="mt-6 space-y-4">
                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Nombre</p>
                    <p class="mt-2 text-sm font-medium text-slate-900">{{ $academy->name }}</p>
                </div>

                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Slug</p>
                    <p class="mt-2 text-sm font-medium text-slate-900">{{ $academy->slug }}</p>
                </div>

                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Email</p>
                    <p class="mt-2 text-sm font-medium text-slate-900">{{ $academy->email ?: 'No configurado' }}</p>
                </div>

                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Teléfono</p>
                    <p class="mt-2 text-sm font-medium text-slate-900">{{ $academy->phone ?: 'No configurado' }}</p>
                </div>
            </div>

            <a href="{{ route('admin.academy') }}"
                class="mt-6 inline-flex w-full items-center justify-center rounded-xl bg-slate-900 px-4 py-3 text-sm font-medium text-white transition hover:bg-slate-800 sm:w-auto">
                Editar academia
            </a>
        </div>
    </div>
</div>
