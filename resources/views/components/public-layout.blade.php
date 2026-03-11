{{-- resources/views/components/public-layout.blade.php --}}
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

        @php
            $isHome = request()->routeIs('public.home');
        @endphp

        <header id="site-header"
            class="{{ $isHome
                ? 'fixed top-0 inset-x-0 z-50 border-b border-white/10 bg-white/10 backdrop-blur-md'
                : 'sticky top-0 z-50 border-b border-slate-200/80 bg-white/90 backdrop-blur' }}">

            <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
                <a href="{{ route('public.home') }}" id="site-logo"
                    class="{{ $isHome
                        ? 'text-xl font-black uppercase tracking-tight text-white transition'
                        : 'text-xl font-black uppercase tracking-tight text-slate-900 transition' }}">
                    {{ $academy->name ?? 'Academia' }}
                </a>

                <nav id="site-nav"
                    class="{{ $isHome
                        ? 'hidden items-center gap-6 text-sm font-bold uppercase tracking-wide text-white lg:flex'
                        : 'hidden items-center gap-6 text-sm font-bold uppercase tracking-wide text-slate-600 lg:flex' }}">
                    <a href="{{ route('public.home') }}" class="nav-link transition hover:text-emerald-500">Inicio</a>
                    <a href="{{ route('public.schedules') }}" class="nav-link transition hover:text-emerald-500">Horarios</a>
                    <a href="{{ route('public.styles') }}" class="nav-link transition hover:text-emerald-500">Estilos</a>
                    <a href="{{ route('public.teachers') }}"
                        class="nav-link transition hover:text-emerald-500">Profesores</a>
                    <a href="{{ route('public.contact') }}" class="nav-link transition hover:text-emerald-500">Contacto</a>
                </nav>

                <div class="flex items-center gap-3">
                    @auth
                        <a href="{{ route('admin.dashboard') }}" id="site-button"
                            class="{{ $isHome
                                ? 'rounded-full border border-white/20 bg-white/10 px-5 py-2.5 text-sm font-bold uppercase tracking-wide text-white transition'
                                : 'rounded-full bg-slate-900 px-5 py-2.5 text-sm font-bold uppercase tracking-wide text-white transition hover:bg-emerald-500' }}">
                            Admin
                        </a>
                    @else
                        <a href="{{ route('login') }}" id="site-button"
                            class="{{ $isHome
                                ? 'rounded-full border border-white/20 bg-white/10 px-5 py-2.5 text-sm font-bold uppercase tracking-wide text-white transition'
                                : 'rounded-full bg-slate-900 px-5 py-2.5 text-sm font-bold uppercase tracking-wide text-white transition hover:bg-emerald-500' }}">
                            Acceso
                        </a>
                    @endauth
                </div>
            </div>
        </header>

        @if ($isHome)
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const header = document.getElementById('site-header');
                    const logo = document.getElementById('site-logo');
                    const nav = document.getElementById('site-nav');
                    const button = document.getElementById('site-button');
                    const links = nav ? nav.querySelectorAll('.nav-link') : [];

                    function updateHeader() {
                        if (window.scrollY > 30) {
                            header.className =
                                'fixed top-0 inset-x-0 z-50 border-b border-slate-200/80 bg-white/90 backdrop-blur';
                            logo.className = 'text-xl font-black uppercase tracking-tight text-slate-900 transition';
                            nav.className =
                                'hidden items-center gap-6 text-sm font-bold uppercase tracking-wide text-slate-600 lg:flex';
                            button.className =
                                'rounded-full bg-slate-900 px-5 py-2.5 text-sm font-bold uppercase tracking-wide text-white transition hover:bg-emerald-500';

                            links.forEach(link => {
                                link.classList.remove('hover:text-white');
                                link.classList.add('hover:text-emerald-600');
                            });
                        } else {
                            header.className =
                                'fixed top-0 inset-x-0 z-50 border-b border-white/10 bg-white/10 backdrop-blur-md';
                            logo.className = 'text-xl font-black uppercase tracking-tight text-white transition';
                            nav.className =
                                'hidden items-center gap-6 text-sm font-bold uppercase tracking-wide text-white lg:flex';
                            button.className =
                                'rounded-full border border-white/20 bg-white/10 px-5 py-2.5 text-sm font-bold uppercase tracking-wide text-white transition hover:bg-white/20';

                            links.forEach(link => {
                                link.classList.remove('hover:text-emerald-600');
                                link.classList.add('hover:text-white');
                            });
                        }
                    }

                    updateHeader();
                    window.addEventListener('scroll', updateHeader);
                });
            </script>
        @endif

        <main class="flex-1">
            {{ $slot }}
        </main>

        <footer class="bg-slate-950 text-white">
            <div class="mx-auto grid max-w-7xl gap-10 px-4 py-14 sm:px-6 lg:grid-cols-4 lg:px-8">
                <div class="lg:col-span-2">
                    <h3 class="text-2xl font-black uppercase">{{ $academy->name ?? 'Academia' }}</h3>
                    <p class="mt-4 max-w-xl text-sm leading-7 text-slate-300">
                        {{ $academy->description ?: 'Academia de baile con una presencia pública clara, moderna y preparada para crecer.' }}
                    </p>
                </div>

                <div>
                    <h4 class="text-sm font-bold uppercase tracking-[0.25em] text-emerald-500">Navegación</h4>
                    <div class="mt-4 space-y-3 text-sm text-slate-300">
                        <p><a href="{{ route('public.home') }}" class="hover:text-white">Inicio</a></p>
                        <p><a href="{{ route('public.schedules') }}" class="hover:text-white">Horarios</a></p>
                        <p><a href="{{ route('public.styles') }}" class="hover:text-white">Estilos</a></p>
                        <p><a href="{{ route('public.teachers') }}" class="hover:text-white">Profesores</a></p>
                        <p><a href="{{ route('public.contact') }}" class="hover:text-white">Contacto</a></p>
                    </div>
                </div>

                <div>
                    <h4 class="text-sm font-bold uppercase tracking-[0.25em] text-emerald-500">Contacto</h4>
                    <div class="mt-4 space-y-3 text-sm text-slate-300">
                        <p>{{ $academy->phone ?: 'Sin teléfono' }}</p>
                        <p>{{ $academy->email ?: 'Sin email' }}</p>
                        <p>{{ $academy->address ?: 'Sin dirección' }}</p>
                        @if (!empty($academy->instagram_url))
                            <p>
                                <a href="{{ $academy->instagram_url }}" target="_blank" class="hover:text-white">
                                    Instagram
                                </a>
                            </p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="border-t border-white/10">
                <div
                    class="mx-auto max-w-7xl px-4 py-5 text-xs uppercase tracking-[0.2em] text-slate-400 sm:px-6 lg:px-8">
                    {{ now()->year }} · {{ $academy->name ?? config('app.name', 'Dance Academy') }}
                </div>
            </div>
        </footer>
    </div>
</body>

</html>
