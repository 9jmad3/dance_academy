{{-- resources/views/public/home.blade.php --}}
<x-public-layout :title="$academy->name" :academy="$academy">
    @php
        $featuredSchedules = $schedules->take(6);
        $featuredTeachers = $teachers->take(3);
        $featuredStyles = $styles->take(6);

        $dayColors = [
            'monday' => 'bg-emerald-100 text-emerald-700',
            'tuesday' => 'bg-sky-100 text-sky-700',
            'wednesday' => 'bg-violet-100 text-violet-700',
            'thursday' => 'bg-amber-100 text-amber-700',
            'friday' => 'bg-rose-100 text-rose-700',
            'saturday' => 'bg-fuchsia-100 text-fuchsia-700',
            'sunday' => 'bg-slate-200 text-slate-700',
        ];
    @endphp

    {{-- HERO --}}
    <section class="relative overflow-hidden bg-slate-950 pt-24 text-white">
        @if ($academy->banner)
            <div class="hero-banner-image absolute inset-0 bg-cover bg-top"
                style="background-image: url('{{ asset('storage/' . $academy->banner) }}');"></div>

            <div class="absolute inset-0 bg-slate-950/70"></div>
        @endif

        <div
            class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,_rgba(16,185,129,0.18),_transparent_35%),radial-gradient(circle_at_bottom_left,_rgba(59,130,246,0.14),_transparent_30%)]">
        </div>

        <div
            class="relative mx-auto grid max-w-7xl gap-10 px-4 py-20 sm:px-6 lg:grid-cols-2 lg:items-center lg:px-8 lg:py-28">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.35em] text-emerald-300">
                    Academia de baile
                </p>

                <h1 class="mt-5 text-5xl font-black uppercase leading-none sm:text-6xl lg:text-7xl">
                    {{ $academy->hero_title ?: 'Dance to the beat' }}
                </h1>

                <p class="mt-6 max-w-xl text-base leading-7 text-slate-300 sm:text-lg">
                    {{ $academy->hero_text ?: ($academy->description ?: 'Clases de baile con profesores especializados, horarios claros y una experiencia pensada para crecer contigo en cada paso.') }}
                </p>

                <div class="mt-8 flex flex-wrap gap-4">
                    <a href="{{ route('public.schedules') }}"
                        class="rounded-full bg-emerald-500 px-6 py-3 text-sm font-bold uppercase tracking-wide text-white transition hover:bg-emerald-400">
                        Ver horarios
                    </a>

                    <a href="{{ route('public.contact') }}"
                        class="rounded-full border border-white/20 px-6 py-3 text-sm font-bold uppercase tracking-wide text-white transition hover:bg-white/10">
                        Contactar
                    </a>
                </div>

                <div class="mt-10 grid max-w-xl grid-cols-3 gap-4">
                    <div class="rounded-2xl border border-white/10 bg-white/5 p-4 backdrop-blur">
                        <p class="text-3xl font-black">{{ $styles->count() }}</p>
                        <p class="mt-1 text-sm text-slate-300">Estilos</p>
                    </div>
                    <div class="rounded-2xl border border-white/10 bg-white/5 p-4 backdrop-blur">
                        <p class="text-3xl font-black">{{ $teachers->count() }}</p>
                        <p class="mt-1 text-sm text-slate-300">Profesores</p>
                    </div>
                    <div class="rounded-2xl border border-white/10 bg-white/5 p-4 backdrop-blur">
                        <p class="text-3xl font-black">{{ $schedules->count() }}</p>
                        <p class="mt-1 text-sm text-slate-300">Clases</p>
                    </div>
                </div>
            </div>

            <div class="relative">
                <div class="rounded-[2rem] border border-white/10 bg-white/5 p-5 shadow-2xl backdrop-blur">
                    <div class="grid gap-4 sm:grid-cols-2">
                        <div class="rounded-3xl bg-gradient-to-br from-emerald-400 to-emerald-600 p-6 text-slate-950">
                            <p class="text-sm font-bold uppercase tracking-[0.25em]">Clase destacada</p>
                            @if ($featuredSchedules->isNotEmpty())
                                <h3 class="mt-5 text-3xl font-black uppercase">
                                    {{ $featuredSchedules->first()->danceStyle->name }}
                                </h3>
                                <p class="mt-3 text-sm font-semibold">
                                    {{ $featuredSchedules->first()->day_label }}
                                    ·
                                    {{ substr($featuredSchedules->first()->start_time, 0, 5) }}
                                    - {{ substr($featuredSchedules->first()->end_time, 0, 5) }}
                                </p>
                                <p class="mt-2 text-sm">
                                    {{ $featuredSchedules->first()->teachers->pluck('name')->join(', ') }}
                                    @if ($featuredSchedules->first()->level)
                                        · {{ $featuredSchedules->first()->level }}
                                    @endif
                                </p>
                            @else
                                <h3 class="mt-5 text-3xl font-black uppercase">Tu academia</h3>
                                <p class="mt-3 text-sm">Crea horarios desde el panel admin para mostrar aquí tus clases.
                                </p>
                            @endif
                        </div>

                        <div class="rounded-3xl border border-white/10 bg-slate-900/70 p-6">
                            <p class="text-sm font-bold uppercase tracking-[0.25em] text-emerald-300">Nuestro servicio
                            </p>
                            <ul class="mt-5 space-y-3 text-sm text-slate-300">
                                <li>• Clases por niveles</li>
                                <li>• Profesores asignados por clase</li>
                                <li>• Horarios visibles y ordenados</li>
                                <li>• Información pública siempre actualizada</li>
                            </ul>
                        </div>
                    </div>

                    <div class="mt-4 rounded-3xl border border-white/10 bg-white/5 p-6">
                        <p class="text-sm font-bold uppercase tracking-[0.25em] text-slate-300">Baila, conecta y
                            evoluciona</p>
                        <p class="mt-3 max-w-2xl text-sm leading-7 text-slate-300">
                            Nuestras clases están diseñadas para que aprendas técnica, ganes confianza y formes parte de
                            una comunidad que comparte la misma pasión por el baile.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- TRAININGS / ESTILOS --}}
    <section class="bg-white py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl">
                <p class="text-sm font-bold uppercase tracking-[0.35em] text-emerald-600">Trainings</p>
                <h2 class="mt-4 text-4xl font-black uppercase tracking-tight text-slate-900">
                    Nuestros estilos de baile
                </h2>
                <p class="mt-4 text-base leading-7 text-slate-600">
                    Diseñado para que tu academia pueda enseñar cada disciplina con identidad propia, profesores
                    distintos y horarios independientes.
                </p>
            </div>

            <div class="mt-12 grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                @forelse($featuredStyles as $index => $style)
                    <article
                        class="group overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-xl">
                        <div class="h-3 w-full bg-gradient-to-r from-emerald-500 via-cyan-500 to-violet-500"></div>
                        <div class="p-8">
                            <div
                                class="flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100 text-lg font-black text-slate-700">
                                {{ str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) }}
                            </div>
                            <h3 class="mt-6 text-2xl font-black uppercase text-slate-900">
                                {{ $style->name }}
                            </h3>
                            <p class="mt-4 text-sm leading-7 text-slate-600">
                                {{ $style->description ?: 'Descripción pendiente. Puedes editar este estilo desde el panel admin.' }}
                            </p>
                            <a href="{{ route('public.styles') }}"
                                class="mt-6 inline-flex text-sm font-bold uppercase tracking-wide text-emerald-600 transition group-hover:text-slate-900">
                                Ver estilos
                            </a>
                        </div>
                    </article>
                @empty
                    <div
                        class="rounded-[2rem] border border-dashed border-slate-300 bg-slate-50 p-10 text-slate-500 md:col-span-2 xl:col-span-3">
                        Aún no hay estilos creados. Añádelos desde <strong>/admin/estilos</strong>.
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- CLASSES + OPENING HOURS --}}
    <section class="bg-slate-50 py-20">
        <div class="mx-auto grid max-w-7xl gap-10 px-4 sm:px-6 lg:grid-cols-3 lg:px-8">
            <div class="lg:col-span-2">
                <p class="text-sm font-bold uppercase tracking-[0.35em] text-emerald-600">By style</p>
                <h2 class="mt-4 text-4xl font-black uppercase tracking-tight text-slate-900">
                    Horarios por estilos
                </h2>

                <p class="mt-4 max-w-2xl text-sm leading-7 text-slate-600">
                    Encuentra fácilmente las clases según el estilo que quieres bailar y consulta sus próximos horarios.
                </p>

                <div class="mt-10 space-y-6">
                    @foreach ($groupedSchedules as $groupName => $items)
                        <article class="rounded-[2rem] bg-white p-6 shadow-sm ring-1 ring-slate-200">
                            <div class="flex flex-col gap-4 md:flex-row md:items-start md:justify-between">
                                <div>
                                    <h3 class="text-2xl font-black uppercase text-slate-900">
                                        {{ $groupName }}
                                    </h3>

                                    <p class="mt-3 max-w-2xl text-sm leading-7 text-slate-600">
                                        @if ($groupName === 'Latino')
                                            Clases de salsa y bachata agrupadas en una misma experiencia para aprender,
                                            disfrutar y evolucionar a tu ritmo.
                                        @else
                                            Clases de urbano con energía, técnica y trabajo coreográfico en distintos
                                            niveles.
                                        @endif
                                    </p>
                                </div>

                                <a href="{{ route('public.schedules') }}"
                                    class="inline-flex rounded-full bg-slate-900 px-5 py-3 text-xs font-bold uppercase tracking-wide text-white transition hover:bg-emerald-500">
                                    Ver horarios
                                </a>
                            </div>

                            <div class="mt-6 grid gap-4 md:grid-cols-2 xl:grid-cols-3">
                                @forelse($items->take(6) as $schedule)
                                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                                        <div class="flex items-center justify-between gap-3">
                                            <span
                                                class="inline-flex rounded-full bg-emerald-100 px-3 py-1 text-xs font-bold uppercase tracking-wide text-emerald-700">
                                                {{ $schedule->day_label }}
                                            </span>

                                            <span class="text-sm font-bold text-slate-500">
                                                {{ substr($schedule->start_time, 0, 5) }} -
                                                {{ substr($schedule->end_time, 0, 5) }}
                                            </span>
                                        </div>

                                        <div class="mt-4 space-y-2 text-sm text-slate-600">
                                            <p>
                                                <span class="font-semibold text-slate-900">Clase:</span>
                                                {{ $schedule->danceStyle->name }}
                                            </p>
                                            <p>
                                                <span class="font-semibold text-slate-900">Profesor:</span>
                                                {{ $schedule->teachers->pluck('name')->join(', ') }}
                                            </p>
                                            <p>
                                                <span class="font-semibold text-slate-900">Nivel:</span>
                                                {{ $schedule->level ?: 'General' }}
                                            </p>
                                        </div>
                                    </div>
                                @empty
                                    <div
                                        class="rounded-2xl border border-dashed border-slate-300 bg-slate-50 p-6 text-sm text-slate-500 md:col-span-2 xl:col-span-3">
                                        Este estilo aún no tiene horarios publicados.
                                    </div>
                                @endforelse
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>

            <aside class="rounded-[2rem] bg-slate-900 p-8 text-white shadow-xl">
                <p class="text-sm font-bold uppercase tracking-[0.35em] text-emerald-300">
                    @if ($nextAvailableDay === $currentDaySlug)
                        Hoy
                    @else
                        Próximo día con clase
                    @endif
                </p>

                @php
                    $dayLabels = [
                        'monday' => 'Lunes',
                        'tuesday' => 'Martes',
                        'wednesday' => 'Miércoles',
                        'thursday' => 'Jueves',
                        'friday' => 'Viernes',
                        'saturday' => 'Sábado',
                        'sunday' => 'Domingo',
                    ];
                @endphp

                <h2 class="mt-4 text-3xl font-black uppercase">
                    {{ $dayLabels[$nextAvailableDay] ?? 'Horarios' }}
                </h2>

                <p class="mt-4 text-sm leading-7 text-slate-300">
                    @if ($nextAvailableDay === $currentDaySlug)
                        Estas son las clases disponibles para hoy en la academia.
                    @else
                        Hoy no hay clases. Te mostramos el próximo día disponible para que planifiques tu semana.
                    @endif
                </p>

                <div class="mt-8 space-y-4">
                    @forelse($nextAvailableSchedules as $schedule)
                        <div class="flex items-start justify-between gap-4 border-b border-white/10 pb-4 text-sm">
                            <div>
                                <p class="font-bold uppercase">{{ $schedule->danceStyle->name }}</p>
                                <p class="mt-1 text-slate-300">{{ $schedule->teachers->pluck('name')->join(', ') }}</p>
                                @if ($schedule->level)
                                    <p class="mt-1 text-slate-400">{{ $schedule->level }}</p>
                                @endif
                            </div>

                            <p class="font-semibold text-emerald-300">
                                {{ substr($schedule->start_time, 0, 5) }} – {{ substr($schedule->end_time, 0, 5) }}
                            </p>
                        </div>
                    @empty
                        <p class="text-sm text-slate-300">
                            No hay horarios disponibles todavía.
                        </p>
                    @endforelse
                </div>

                <a href="{{ route('public.schedules') }}"
                    class="mt-8 inline-flex rounded-full bg-white px-5 py-3 text-sm font-bold uppercase tracking-wide text-slate-900 transition hover:bg-emerald-300">
                    Ver todos
                </a>
            </aside>
        </div>
    </section>

    {{-- TEACHERS --}}
    <section class="bg-white py-20 overflow-hidden">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <p class="text-sm font-bold uppercase tracking-[0.35em] text-emerald-600">
                Team
            </p>

            <h2 class="mt-4 text-4xl font-black uppercase tracking-tight text-slate-900">
                Profesores
            </h2>

            @if ($teachers->count())
                <div class="marquee-wrapper mt-12">
                    <div class="marquee-track">

                        @foreach ($teachers as $teacher)
                            <article class="teacher-card">
                                @if ($teacher->photo)
                                    <img src="{{ asset('storage/' . $teacher->photo) }}" alt="{{ $teacher->name }}"
                                        class="h-20 w-20 rounded-full object-cover ring-4 ring-white shadow-lg">
                                @else
                                    <div
                                        class="flex h-20 w-20 items-center justify-center rounded-full bg-slate-900 text-2xl font-black text-white">
                                        {{ \Illuminate\Support\Str::of($teacher->name)->substr(0, 1) }}
                                    </div>
                                @endif

                                <h3 class="mt-6 text-2xl font-black uppercase text-slate-900">
                                    {{ $teacher->name }}
                                </h3>

                                <p class="mt-4 text-sm leading-7 text-slate-600">
                                    {{ $teacher->bio ?: 'Perfil pendiente de completar desde el panel admin.' }}
                                </p>
                            </article>
                        @endforeach

                        @foreach ($teachers as $teacher)
                            <article class="teacher-card">
                                @if ($teacher->photo)
                                    <img src="{{ asset('storage/' . $teacher->photo) }}" alt="{{ $teacher->name }}"
                                        class="h-20 w-20 rounded-full object-cover ring-4 ring-white shadow-lg">
                                @else
                                    <div
                                        class="flex h-20 w-20 items-center justify-center rounded-full bg-slate-900 text-2xl font-black text-white">
                                        {{ \Illuminate\Support\Str::of($teacher->name)->substr(0, 1) }}
                                    </div>
                                @endif

                                <h3 class="mt-6 text-2xl font-black uppercase text-slate-900">
                                    {{ $teacher->name }}
                                </h3>

                                <p class="mt-4 text-sm leading-7 text-slate-600">
                                    {{ $teacher->bio ?: 'Perfil pendiente de completar desde el panel admin.' }}
                                </p>
                            </article>
                        @endforeach

                    </div>
                </div>

                {{-- BOTÓN VER PROFESORES --}}
                <div class="mt-12 flex justify-center">
                    <a href="{{ route('public.teachers') }}"
                        class="inline-flex items-center rounded-full bg-slate-900 px-8 py-4 text-sm font-bold uppercase tracking-wide text-white transition hover:bg-emerald-500">
                        Ver todos los profesores
                    </a>
                </div>
            @else
                <div
                    class="mt-10 rounded-[2rem] border border-dashed border-slate-300 bg-slate-50 p-10 text-slate-500">
                    Aún no hay profesores creados. Añádelos desde <strong>/admin/profesores</strong>.
                </div>
            @endif
        </div>
    </section>

    {{-- CONTACT --}}
    <section class="bg-slate-950 py-20 text-white">
        <div class="mx-auto grid max-w-7xl gap-10 px-4 sm:px-6 lg:grid-cols-2 lg:px-8">
            <div>
                <p class="text-sm font-bold uppercase tracking-[0.35em] text-emerald-300">Contact us</p>
                <h2 class="mt-4 text-4xl font-black uppercase tracking-tight">
                    Ponte en contacto
                </h2>
                <p class="mt-5 max-w-xl text-base leading-7 text-slate-300">
                    Facilita aquí la información clave de tu academia para que cualquier alumno pueda escribirte o
                    encontrarte rápidamente.
                </p>
            </div>

            <div class="grid gap-4 sm:grid-cols-2">
                <a href="https://maps.app.goo.gl/wmJkLPd2k6NxFccF7">
                    <div class="rounded-[2rem] border border-white/10 bg-white/5 p-6">
                        <p class="text-xs font-bold uppercase tracking-[0.25em] text-emerald-300">Dirección</p>
                        <p class="mt-3 text-sm leading-7 text-slate-200">
                            {{ $academy->address ?: 'Pendiente de configurar en el panel admin.' }}
                        </p>
                    </div>
                </a>

                <div class="rounded-[2rem] border border-white/10 bg-white/5 p-6">
                    <p class="text-xs font-bold uppercase tracking-[0.25em] text-emerald-300">Teléfono</p>
                    <p class="mt-3 text-sm leading-7 text-slate-200">
                        {{ $academy->phone ?: 'Pendiente de configurar.' }}
                    </p>
                </div>

                <div class="rounded-[2rem] border border-white/10 bg-white/5 p-6">
                    <p class="text-xs font-bold uppercase tracking-[0.25em] text-emerald-300">Email</p>
                    <p class="mt-3 text-sm leading-7 text-slate-200">
                        {{ $academy->email ?: 'Pendiente de configurar.' }}
                    </p>
                </div>

                @if ($academy->instagram_url)
                    <a href="{{ $academy->instagram_url }}">
                @endif
                <div class="rounded-[2rem] border border-white/10 bg-white/5 p-6">
                    <p class="text-xs font-bold uppercase tracking-[0.25em] text-emerald-300">Instagram</p>
                    <p class="mt-3 text-sm leading-7 text-slate-200">dancelifehuelva</p>
                </div>

                @if ($academy->instagram_url)
                    </a>
                @endif
            </div>
        </div>
    </section>
</x-public-layout>
