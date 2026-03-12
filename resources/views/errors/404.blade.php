<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Página no encontrada</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

@php
$academy = \App\Models\Academy::first();
$banner = $academy?->banner ? asset('storage/'.$academy->banner) : null;
@endphp

<body class="relative min-h-screen overflow-hidden">

    {{-- Fondo --}}
    @if($banner)
        <div
            class="absolute inset-0 bg-cover bg-top"
            style="background-image: url('{{ $banner }}');">
        </div>

        {{-- Overlay suave para mejorar legibilidad --}}
        <div class="absolute inset-0 bg-black/35"></div>

        {{-- Luces suaves estilo premium --}}
        <div class="absolute -left-20 top-0 h-72 w-72 rounded-full bg-white/10 blur-3xl"></div>
        <div class="absolute -right-20 bottom-0 h-80 w-80 rounded-full bg-cyan-200/10 blur-3xl"></div>
    @else
        <div class="absolute inset-0 bg-gradient-to-br from-slate-950 via-slate-900 to-slate-800"></div>
        <div class="absolute -left-20 top-0 h-72 w-72 rounded-full bg-white/10 blur-3xl"></div>
        <div class="absolute -right-20 bottom-0 h-80 w-80 rounded-full bg-sky-300/10 blur-3xl"></div>
    @endif

    {{-- Contenido --}}
    <div class="relative z-10 flex min-h-screen items-center justify-center px-6 py-10">
        <div
            class="w-full max-w-2xl rounded-[32px] border border-white/20 bg-white/10 p-8 text-center text-white shadow-2xl backdrop-blur-2xl md:p-12">

            <div class="mx-auto w-fit rounded-full border border-white/20 bg-white/10 px-4 py-1 text-sm font-medium backdrop-blur-xl">
                Error 404
            </div>

            <div class="mt-6 text-6xl font-bold tracking-tight md:text-7xl">
                Página no encontrada
            </div>

            <p class="mx-auto mt-5 max-w-xl text-base leading-7 text-white/80 md:text-lg">
                Parece que esta página se ha salido del compás. Puede que no exista, haya cambiado de sitio o el enlace ya no esté disponible.
            </p>

            <div class="mt-8 flex flex-col items-center justify-center gap-3 sm:flex-row">
                <a href="{{ route('public.home') }}"
                    class="inline-flex min-w-[180px] items-center justify-center rounded-2xl bg-white px-6 py-3 text-sm font-semibold text-slate-900 transition hover:bg-white/90">
                    Volver a la web
                </a>

                @auth
                    <a href="{{ route('admin.dashboard') }}"
                        class="inline-flex min-w-[180px] items-center justify-center rounded-2xl border border-white/25 bg-white/5 px-6 py-3 text-sm font-semibold text-white transition hover:bg-white/10">
                        Ir al panel
                    </a>
                @endauth
            </div>
        </div>
    </div>

</body>

</html>
