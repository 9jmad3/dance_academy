<x-public-layout title="Profesores" :academy="$academy">
    <section class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
        <div class="max-w-3xl">
            <p class="text-sm font-bold uppercase tracking-[0.35em] text-emerald-600">
                Team
            </p>

            <h1 class="mt-4 text-4xl font-black uppercase tracking-tight text-slate-900 sm:text-5xl">
                Profesores
            </h1>

            <p class="mt-4 text-base leading-7 text-slate-600">
                Conoce al equipo que da vida a cada clase de la academia.
                Profesores con experiencia, cercanía y pasión por enseñar.
            </p>
        </div>

        @if($teachers->isNotEmpty())
            <div class="mt-14 grid gap-8 md:grid-cols-2 xl:grid-cols-3">
                @foreach($teachers as $teacher)
                    <article
                        class="group relative h-[420px] overflow-hidden rounded-[2rem] bg-slate-200 shadow-lg"
                    >
                        @if($teacher->photo)
                            <div
                                class="absolute inset-0 bg-cover bg-center transition duration-700 group-hover:scale-105"
                                style="background-image: url('{{ asset('storage/' . $teacher->photo) }}')"
                            ></div>
                        @else
                            <div class="absolute inset-0 bg-gradient-to-br from-slate-800 via-slate-900 to-slate-950"></div>
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="flex h-24 w-24 items-center justify-center rounded-full bg-white/10 text-3xl font-black text-white ring-1 ring-white/20">
                                    {{ \Illuminate\Support\Str::of($teacher->name)->substr(0, 1) }}
                                </div>
                            </div>
                        @endif

                        <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/35 to-black/10"></div>

                        <div class="relative flex h-full flex-col justify-end p-8 text-white">
                            <span class="inline-flex w-fit rounded-full bg-white/10 px-3 py-1 text-xs font-bold uppercase tracking-[0.25em] text-emerald-300 backdrop-blur">
                                Profesor
                            </span>

                            <h2 class="mt-4 text-3xl font-black uppercase tracking-tight">
                                {{ $teacher->name }}
                            </h2>

                            <p class="mt-3 text-sm leading-7 text-white/85">
                                {{ $teacher->bio ?: 'Biografía pendiente de actualizar desde el panel admin.' }}
                            </p>
                        </div>
                    </article>
                @endforeach
            </div>
        @else
            <div class="mt-12 rounded-[2rem] border border-dashed border-slate-300 bg-slate-50 p-12 text-center text-slate-500">
                Aún no hay profesores publicados.
            </div>
        @endif
    </section>
</x-public-layout>
