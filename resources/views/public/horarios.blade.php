<x-public-layout title="Horarios" :academy="$academy">
    @php
        $groupedSchedules = $schedules->groupBy('day_of_week');

        $dayLabels = [
            'monday' => 'Lunes',
            'tuesday' => 'Martes',
            'wednesday' => 'Miércoles',
            'thursday' => 'Jueves',
            'friday' => 'Viernes',
            'saturday' => 'Sábado',
            'sunday' => 'Domingo',
        ];

        $dayColors = [
            'monday' => 'bg-emerald-100 text-emerald-700',
            'tuesday' => 'bg-sky-100 text-sky-700',
            'wednesday' => 'bg-violet-100 text-violet-700',
            'thursday' => 'bg-amber-100 text-amber-700',
            'friday' => 'bg-rose-100 text-rose-700',
            'saturday' => 'bg-fuchsia-100 text-fuchsia-700',
            'sunday' => 'bg-slate-100 text-slate-700',
        ];
    @endphp

    <section class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
        <div class="max-w-3xl">
            <p class="text-sm font-bold uppercase tracking-[0.35em] text-emerald-600">Schedule</p>
            <h1 class="mt-4 text-4xl font-black uppercase tracking-tight text-slate-900 sm:text-5xl">
                Horarios
            </h1>
            <p class="mt-4 text-base leading-7 text-slate-600">
                Consulta las clases por día, estilo y profesores. Encuentra fácilmente el horario que mejor encaja contigo.
            </p>
        </div>

        @if($schedules->isNotEmpty())
            <div class="mt-12 space-y-8">
                @foreach($groupedSchedules as $day => $daySchedules)
                    <section class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
                        <div class="flex flex-col gap-4 border-b border-slate-200 pb-6 sm:flex-row sm:items-center sm:justify-between">
                            <div class="flex items-center gap-4">
                                <span class="inline-flex rounded-full px-4 py-2 text-xs font-bold uppercase tracking-wide {{ $dayColors[$day] ?? 'bg-slate-100 text-slate-700' }}">
                                    {{ $dayLabels[$day] ?? ucfirst($day) }}
                                </span>

                                <p class="text-sm text-slate-500">
                                    {{ $daySchedules->count() }} {{ $daySchedules->count() === 1 ? 'clase' : 'clases' }}
                                </p>
                            </div>
                        </div>

                        <div class="mt-6 grid gap-4 lg:grid-cols-2 xl:grid-cols-3">
                            @foreach($daySchedules as $schedule)
                                <article class="rounded-3xl border border-slate-200 bg-slate-50 p-5 transition hover:bg-white hover:shadow-md">
                                    <div class="flex items-start justify-between gap-4">
                                        <div>
                                            <p class="text-sm font-bold uppercase tracking-wide text-emerald-600">
                                                {{ substr($schedule->start_time, 0, 5) }} - {{ substr($schedule->end_time, 0, 5) }}
                                            </p>

                                            <h2 class="mt-3 text-2xl font-black uppercase text-slate-900">
                                                {{ $schedule->danceStyle->name }}
                                            </h2>
                                        </div>

                                        <span class="rounded-full bg-white px-3 py-1 text-xs font-semibold text-slate-500 ring-1 ring-slate-200">
                                            {{ $schedule->level ?: 'General' }}
                                        </span>
                                    </div>

                                    <div class="mt-5 space-y-4 text-sm text-slate-600">
                                        <div>
                                            {{-- <p class="mb-3 font-semibold text-slate-900">Profesores</p> --}}

                                            @if($schedule->teachers->isNotEmpty())
                                                <div class="space-y-3">
                                                    @foreach($schedule->teachers as $teacher)
                                                        <div class="flex items-center gap-3">
                                                            @if($teacher->photo)
                                                                <img
                                                                    src="{{ asset('storage/' . $teacher->photo) }}"
                                                                    alt="{{ $teacher->name }}"
                                                                    class="h-10 w-10 rounded-full object-cover ring-2 ring-white shadow-sm"
                                                                >
                                                            @else
                                                                <div class="flex h-10 w-10 items-center justify-center rounded-full bg-slate-900 text-xs font-bold text-white">
                                                                    {{ \Illuminate\Support\Str::of($teacher->name)->substr(0, 1) }}
                                                                </div>
                                                            @endif

                                                            <span class="font-medium text-slate-700">{{ $teacher->name }}</span>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @else
                                                <p class="text-slate-500">Pendiente</p>
                                            @endif
                                        </div>

                                        <p>
                                            <span class="font-semibold text-slate-900">Sala:</span>
                                            {{ $schedule->room ?: 'Sala principal' }}
                                        </p>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    </section>
                @endforeach
            </div>
        @else
            <div class="mt-12 rounded-[2rem] border border-dashed border-slate-300 bg-slate-50 p-10 text-center text-slate-500">
                Aún no hay horarios publicados.
            </div>
        @endif
    </section>
</x-public-layout>
