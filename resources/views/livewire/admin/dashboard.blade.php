<div class="space-y-6">
    {{-- MÉTRICAS --}}
    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-3">
        <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200 sm:p-6">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <p class="text-sm font-medium text-slate-500">Estilos activos</p>
                    <p class="mt-2 text-3xl font-bold tracking-tight text-slate-900">{{ $stylesCount }}</p>
                </div>

                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-600 ring-1 ring-emerald-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.868v4.264a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9z" />
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

                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-sky-50 text-sky-600 ring-1 ring-sky-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17 20h5V9H2v11h5m10 0v-5a3 3 0 00-3-3H10a3 3 0 00-3 3v5m10 0H7m10-11a3 3 0 11-6 0 3 3 0 016 0zm-8 0a3 3 0 11-6 0 3 3 0 016 0z" />
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

                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-violet-50 text-violet-600 ring-1 ring-violet-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 7V3m8 4V3m-9 8h10m-11 9h12a2 2 0 002-2V7a2 2 0 00-2-2H6a2 2 0 00-2 2v11a2 2 0 002 2z" />
                    </svg>
                </div>
            </div>
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

                <a
                    href="{{ route('admin.schedules') }}"
                    class="inline-flex rounded-xl border border-slate-200 px-4 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-50"
                >
                    Gestionar
                </a>
            </div>

            @if($latestSchedules->isEmpty())
                <div class="mt-5 rounded-2xl border border-dashed border-slate-300 bg-slate-50 p-8 text-center text-sm text-slate-500">
                    Todavía no hay horarios creados.
                </div>
            @else
                {{-- MÓVIL: CARDS --}}
                <div class="mt-5 space-y-4 md:hidden">
                    @foreach($latestSchedules as $schedule)
                        <article class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                            <div class="flex items-start justify-between gap-3">
                                <div>
                                    <span class="inline-flex rounded-full bg-slate-900 px-3 py-1 text-xs font-semibold text-white">
                                        {{ $schedule->day_label }}
                                    </span>

                                    <p class="mt-3 text-base font-semibold text-slate-900">
                                        {{ $schedule->danceStyle->name }}
                                    </p>

                                    <p class="mt-1 text-sm text-slate-500">
                                        {{ substr($schedule->start_time, 0, 5) }} - {{ substr($schedule->end_time, 0, 5) }}
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
                                @foreach($latestSchedules as $schedule)
                                    <tr>
                                        <td class="px-4 py-4">
                                            <span class="inline-flex rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700">
                                                {{ $schedule->day_label }}
                                            </span>
                                        </td>

                                        <td class="px-4 py-4">
                                            {{ substr($schedule->start_time, 0, 5) }} - {{ substr($schedule->end_time, 0, 5) }}
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

            <a
                href="{{ route('admin.academy') }}"
                class="mt-6 inline-flex w-full items-center justify-center rounded-xl bg-slate-900 px-4 py-3 text-sm font-medium text-white transition hover:bg-slate-800 sm:w-auto"
            >
                Editar academia
            </a>
        </div>
    </div>
</div>
