<x-public-layout title="Estilos" :academy="$academy">
    <section class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">

        <div class="max-w-3xl">
            <p class="text-sm font-bold uppercase tracking-[0.35em] text-emerald-600">
                Dance Styles
            </p>

            <h1 class="mt-4 text-4xl font-black uppercase tracking-tight text-slate-900 sm:text-5xl">
                Estilos
            </h1>

            <p class="mt-4 text-base leading-7 text-slate-600">
                Descubre las disciplinas que puedes aprender en nuestra academia.
                Clases pensadas para todos los niveles donde podrás mejorar tu técnica,
                disfrutar del baile y formar parte de nuestra comunidad.
            </p>
        </div>

        <div class="mt-14 grid gap-8 md:grid-cols-2 xl:grid-cols-3">

            @forelse($styles as $style)

                <article
                    class="group relative overflow-hidden rounded-[2rem] border border-slate-200 bg-white p-8 shadow-sm transition hover:shadow-xl hover:-translate-y-1">

                    <div
                        class="absolute inset-0 opacity-0 transition group-hover:opacity-100 bg-gradient-to-br from-emerald-500/5 to-sky-500/5">
                    </div>

                    <div class="relative">

                        {{-- <span
                            class="inline-flex rounded-full bg-emerald-100 px-3 py-1 text-xs font-bold uppercase tracking-wide text-emerald-700">
                            Estilo
                        </span> --}}

                        <h2 class="mt-5 text-3xl font-black uppercase tracking-tight text-slate-900">
                            {{ $style->name }}
                        </h2>

                        <p class="mt-4 text-sm leading-7 text-slate-600">
                            {{ $style->description ?: 'Descripción pendiente de actualizar desde el panel admin.' }}
                        </p>

                        <div class="mt-6 flex items-center gap-2 text-xs font-semibold uppercase tracking-wide text-slate-400">
                            <span class="h-1 w-1 rounded-full bg-slate-400"></span>
                            Clases disponibles
                        </div>

                    </div>

                </article>

            @empty

                <div
                    class="rounded-[2rem] border border-dashed border-slate-300 bg-slate-50 p-12 text-center text-slate-500 md:col-span-2 xl:col-span-3">
                    Aún no hay estilos publicados.
                </div>

            @endforelse

        </div>
    </section>
</x-public-layout>
