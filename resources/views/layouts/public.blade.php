<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Academia' }} - {{ $academy->name ?? config('app.name', 'Dance Academy') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-slate-900 antialiased">
    <div class="min-h-screen flex flex-col">
        <header class="border-b border-slate-200 bg-white/95 backdrop-blur">
            <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
                <a href="{{ route('public.home') }}" class="text-xl font-bold tracking-tight text-slate-900">{{ $academy->name ?? 'Academia' }}</a>
                <nav class="flex flex-wrap items-center gap-4 text-sm font-medium text-slate-600">
                    <a href="{{ route('public.home') }}" class="hover:text-slate-900">Inicio</a>
                    <a href="{{ route('public.schedules') }}" class="hover:text-slate-900">Horarios</a>
                    <a href="{{ route('public.styles') }}" class="hover:text-slate-900">Estilos</a>
                    <a href="{{ route('public.teachers') }}" class="hover:text-slate-900">Profesores</a>
                    <a href="{{ route('public.contact') }}" class="hover:text-slate-900">Contacto</a>
                    @auth
                        <a href="{{ route('admin.dashboard') }}" class="rounded-xl bg-slate-900 px-4 py-2 text-white">Admin</a>
                    @else
                        <a href="{{ route('login') }}" class="rounded-xl bg-slate-900 px-4 py-2 text-white">Acceso</a>
                    @endauth
                </nav>
            </div>
        </header>

        <main class="flex-1">
            {{ $slot }}
        </main>

        <footer class="border-t border-slate-200 bg-slate-50">
            <div class="mx-auto grid max-w-7xl gap-6 px-4 py-10 sm:px-6 lg:grid-cols-3 lg:px-8">
                <div>
                    <h3 class="text-lg font-semibold">{{ $academy->name ?? 'Academia' }}</h3>
                    <p class="mt-2 text-sm text-slate-600">{{ $academy->description ?? 'Academia de baile con clases para todos los niveles.' }}</p>
                </div>
                <div>
                    <h4 class="font-semibold">Contacto</h4>
                    <div class="mt-2 space-y-1 text-sm text-slate-600">
                        <p>{{ $academy->phone }}</p>
                        <p>{{ $academy->email }}</p>
                        <p>{{ $academy->address }}</p>
                    </div>
                </div>
                <div>
                    <h4 class="font-semibold">Síguenos</h4>
                    <div class="mt-2 text-sm text-slate-600">
                        @if(!empty($academy->instagram_url))
                            <a href="{{ $academy->instagram_url }}" target="_blank" class="hover:text-slate-900">Instagram</a>
                        @else
                            <p>Actualiza tus redes desde el panel admin.</p>
                        @endif
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
