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
    $banner = $academy?->banner_image ? asset('storage/' . $academy->banner_image) : null;
@endphp

<body class="min-h-screen bg-gray-100 text-gray-900 antialiased">

    <div class="relative min-h-screen overflow-hidden">

        @if($banner)
            <div
                class="absolute inset-0 bg-cover bg-top bg-no-repeat"
                style="background-image: url('{{ $banner }}');">
            </div>

            <div class="absolute inset-0 bg-white/30"></div>
            <div class="absolute inset-0 backdrop-blur-[2px]"></div>
        @else
            <div class="absolute inset-0 bg-gradient-to-br from-white via-slate-50 to-slate-100"></div>
        @endif

        <div class="relative z-10 flex min-h-screen flex-col">
            <div class="border-b border-white/30 bg-white/20 backdrop-blur-xl">
                <div class="mx-auto flex h-16 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">
                    <a href="{{ route('public.home') }}" class="text-lg font-semibold tracking-tight text-gray-900">
                        {{ $academy?->name ?? config('app.name', 'Dance Academy') }}
                    </a>

                    <div class="flex items-center gap-3">
                        <a href="{{ route('public.home') }}"
                            class="inline-flex items-center rounded-md px-3 py-2 text-sm font-medium text-gray-700 transition hover:bg-white/40 hover:text-gray-900">
                            Inicio
                        </a>

                        @auth
                            <a href="{{ route('admin.dashboard') }}"
                                class="inline-flex items-center rounded-md px-3 py-2 text-sm font-medium text-gray-700 transition hover:bg-white/40 hover:text-gray-900">
                                Panel
                            </a>
                        @endauth
                    </div>
                </div>
            </div>

            <div class="flex flex-1 items-center justify-center px-4 py-10 sm:px-6 lg:px-8">
                <div
                    class="w-full max-w-2xl rounded-3xl border border-white/20 bg-white/80 p-8 shadow-xl backdrop-blur-sm sm:p-12">

                    <div class="flex flex-col items-center text-center">
                        <div
                            class="inline-flex items-center rounded-full border border-white/50 bg-white/40 px-4 py-1.5 text-sm font-medium text-gray-700 backdrop-blur-xl">
                            Error 404
                        </div>

                        <h1 class="mt-6 text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl">
                            Página no encontrada
                        </h1>

                        <p class="mt-4 max-w-xl text-base leading-7 text-gray-700 sm:text-lg">
                            La página que intentas abrir no existe, ha cambiado de dirección o ya no está disponible.
                        </p>

                        <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                            <a href="{{ route('public.home') }}"
                                class="inline-flex items-center justify-center rounded-xl bg-gray-900 px-5 py-3 text-sm font-medium text-white transition hover:bg-gray-800">
                                Volver a la web
                            </a>

                            @auth
                                <a href="{{ route('admin.dashboard') }}"
                                    class="inline-flex items-center justify-center rounded-xl border border-gray-300 bg-white/60 px-5 py-3 text-sm font-medium text-gray-700 transition hover:bg-white/80">
                                    Ir al panel
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</body>

</html>
