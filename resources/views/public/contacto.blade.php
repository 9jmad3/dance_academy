<x-public-layout title="Contacto" :academy="$academy">
    <section class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
        <div class="grid gap-10 lg:grid-cols-2 lg:items-start">
            <div class="max-w-2xl">
                <p class="text-sm font-bold uppercase tracking-[0.35em] text-emerald-600">
                    Contact
                </p>

                <h1 class="mt-4 text-4xl font-black uppercase tracking-tight text-slate-900 sm:text-5xl">
                    Contacto
                </h1>

                <p class="mt-4 text-base leading-7 text-slate-600">
                    Toda la información para que tus alumnos puedan localizarte fácilmente,
                    resolver dudas y seguir conectados con la academia.
                </p>

                <div class="mt-8 rounded-[2rem] bg-slate-900 p-8 text-white shadow-xl">
                    <p class="text-sm font-bold uppercase tracking-[0.35em] text-emerald-300">
                        Dancelife Studio
                    </p>

                    <h2 class="mt-4 text-3xl font-black uppercase">
                        Estamos cerca de ti
                    </h2>

                    <p class="mt-4 text-sm leading-7 text-slate-300">
                        Si quieres más información sobre horarios, estilos o profesores,
                        puedes contactar directamente con nosotros por teléfono, WhatsApp
                        o a través de Instagram.
                    </p>

                    @if($academy->instagram_url)
                        <a
                            href="{{ $academy->instagram_url }}"
                            target="_blank"
                            class="mt-6 inline-flex rounded-full bg-white px-5 py-3 text-sm font-bold uppercase tracking-wide text-slate-900 transition hover:bg-emerald-300"
                        >
                            Ver Instagram
                        </a>
                    @endif
                </div>
            </div>

            <div class="rounded-[2rem] border border-slate-200 bg-white p-8 shadow-sm">
                <h2 class="text-2xl font-black uppercase tracking-tight text-slate-900">
                    Información de contacto
                </h2>

                <div class="mt-8 space-y-4">
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                        <p class="text-xs font-bold uppercase tracking-[0.25em] text-slate-500">Teléfono</p>
                        <p class="mt-2 text-lg font-semibold text-slate-900">
                            {{ $academy->phone ?: 'Pendiente' }}
                        </p>
                    </div>

                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                        <p class="text-xs font-bold uppercase tracking-[0.25em] text-slate-500">Email</p>
                        <p class="mt-2 text-lg font-semibold text-slate-900">
                            {{ $academy->email ?: 'Pendiente' }}
                        </p>
                    </div>

                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                        <p class="text-xs font-bold uppercase tracking-[0.25em] text-slate-500">WhatsApp</p>
                        <p class="mt-2 text-lg font-semibold text-slate-900">
                            {{ $academy->whatsapp ?: 'Pendiente' }}
                        </p>
                    </div>

                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                        <p class="text-xs font-bold uppercase tracking-[0.25em] text-slate-500">Dirección</p>
                        <p class="mt-2 text-lg font-semibold text-slate-900">
                            {{ $academy->address ?: 'Pendiente' }}
                        </p>
                    </div>

                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                        <p class="text-xs font-bold uppercase tracking-[0.25em] text-slate-500">Instagram</p>
                        <div class="mt-2">
                            @if($academy->instagram_url)
                                <a
                                    href="{{ $academy->instagram_url }}"
                                    target="_blank"
                                    class="inline-flex text-lg font-semibold text-slate-900 transition hover:text-emerald-600"
                                >
                                    Abrir perfil
                                </a>
                            @else
                                <p class="text-lg font-semibold text-slate-900">Pendiente</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-public-layout>
