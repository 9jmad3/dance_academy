<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Admin' }} - {{ config('app.name', 'Dance Academy') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="h-screen overflow-x-hidden overflow-y-hidden bg-slate-100 text-slate-900 antialiased">
    <div x-data="{ open: false }" class="flex h-screen w-full overflow-x-hidden flex-col lg:flex-row">

        {{-- TOP BAR MÓVIL --}}
        <div
            class="flex items-center justify-between border-b border-slate-200 bg-slate-900 px-4 py-4 text-white lg:hidden">
            <a href="{{ route('admin.dashboard') }}" class="text-lg font-bold tracking-tight">
                DanceAdmin
            </a>

            <button type="button" @click="open = !open"
                class="inline-flex items-center justify-center rounded-xl border border-white/10 bg-white/10 p-2 hover:bg-white/20">
                <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                        d="M4 6h16M4 12h16M4 18h16" />
                </svg>

                <svg x-show="open" x-cloak xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- SIDEBAR --}}
        <aside :class="open ? 'block' : 'hidden'"
            class="w-full border-b border-slate-800 bg-slate-900 text-white lg:flex lg:h-screen lg:w-72 lg:flex-col lg:border-b-0 lg:border-r">
            <div class="hidden px-6 py-6 lg:block">
                <a href="{{ route('admin.dashboard') }}" class="text-xl font-bold tracking-tight">DanceAdmin</a>
                <p class="mt-1 text-sm text-slate-400">Gestión de academia</p>
            </div>

            <nav class="space-y-1 px-4 py-4 lg:flex-1 lg:overflow-y-auto lg:py-6">
                <a href="{{ route('admin.dashboard') }}"
                    class="block rounded-xl px-4 py-3 text-sm font-medium transition hover:bg-slate-800 {{ request()->routeIs('admin.dashboard') ? 'bg-slate-800' : '' }}">
                    Dashboard
                </a>

                <a href="{{ route('admin.academy') }}"
                    class="block rounded-xl px-4 py-3 text-sm font-medium transition hover:bg-slate-800 {{ request()->routeIs('admin.academy') ? 'bg-slate-800' : '' }}">
                    Academia
                </a>

                <a href="{{ route('admin.styles') }}"
                    class="block rounded-xl px-4 py-3 text-sm font-medium transition hover:bg-slate-800 {{ request()->routeIs('admin.styles') ? 'bg-slate-800' : '' }}">
                    Estilos
                </a>

                <a href="{{ route('admin.teachers') }}"
                    class="block rounded-xl px-4 py-3 text-sm font-medium transition hover:bg-slate-800 {{ request()->routeIs('admin.teachers') ? 'bg-slate-800' : '' }}">
                    Profesores
                </a>

                <a href="{{ route('admin.schedules') }}"
                    class="block rounded-xl px-4 py-3 text-sm font-medium transition hover:bg-slate-800 {{ request()->routeIs('admin.schedules') ? 'bg-slate-800' : '' }}">
                    Horarios
                </a>

                <a href="{{ route('admin.users') }}"
                    class="block rounded-xl px-4 py-3 text-sm font-medium transition hover:bg-slate-800 {{ request()->routeIs('admin.users') ? 'bg-slate-800' : '' }}">
                    Usuarios
                </a>

                <a href="{{ route('public.home') }}"
                    class="block rounded-xl px-4 py-3 text-sm font-medium text-emerald-300 transition hover:bg-slate-800">
                    Ver web pública
                </a>
            </nav>
        </aside>

        {{-- CONTENIDO --}}
        <div class="flex min-h-0 min-w-0 flex-1 flex-col overflow-x-hidden">
            <header class="shrink-0 border-b border-slate-200 bg-white px-4 py-4 shadow-sm sm:px-6">
                <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                    <div class="min-w-0">
                        <h1 class="truncate text-2xl font-semibold">{{ $title ?? 'Panel' }}</h1>
                        <p class="text-sm text-slate-500">Administra el contenido de la academia.</p>
                    </div>


                    <div class="flex items-center gap-3 self-end md:self-auto">

                        <x-dropdown align="right" width="48">

                            <x-slot name="trigger">
                                <button
                                    class="flex items-center gap-3 rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm text-slate-700 shadow-sm hover:bg-slate-50">
                                    <span class="font-medium">
                                        {{ Auth::user()->name }}
                                    </span>

                                    <svg class="h-4 w-4 text-slate-500" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                            </x-slot>

                            <x-slot name="content">

                                {{-- Gestión de cuenta --}}
                                <div class="block px-4 py-2 text-xs text-slate-400">
                                    Cuenta
                                </div>

                                <x-dropdown-link href="{{ route('admin.account') }}">
                                    Mi cuenta
                                </x-dropdown-link>

                                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                    <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                        API Tokens
                                    </x-dropdown-link>
                                @endif

                                <div class="border-t border-slate-200"></div>

                                {{-- Logout --}}
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-dropdown-link href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                        Cerrar sesión
                                    </x-dropdown-link>
                                </form>

                            </x-slot>

                        </x-dropdown>

                    </div>
                </div>
            </header>

            <main class="min-h-0 min-w-0 flex-1 overflow-y-auto overflow-x-hidden p-4 sm:p-6">
                @if (session('success'))
                    <div
                        class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                        {{ session('success') }}
                    </div>
                @endif

                {{ $slot }}
            </main>
        </div>
    </div>

    @livewireScripts
</body>

</html>
