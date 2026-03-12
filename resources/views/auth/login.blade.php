<x-guest-layout>
    <div class="min-h-screen bg-slate-50 sm:flex sm:items-center sm:justify-center sm:px-4">
        <div class="w-full min-h-screen bg-slate-50 sm:min-h-0 sm:max-w-md sm:rounded-2xl sm:border sm:border-slate-200 sm:bg-white sm:shadow-sm">

            {{-- Cabecera móvil tipo app / escritorio normal --}}
            <div class="px-6 pt-10 pb-8 text-center sm:rounded-t-2xl sm:bg-slate-50 sm:px-8 sm:pt-8 sm:pb-6">
                <a href="/" class="inline-flex justify-center">
                    <div>
                        <div class="text-3xl font-bold tracking-tight text-slate-900 sm:text-2xl">
                            Dance Life
                        </div>
                        <div class="mt-1 text-sm tracking-[0.35em] text-slate-500">
                            STUDIO
                        </div>
                    </div>
                </a>
            </div>

            <div class="px-6 pb-10 sm:px-8 sm:pb-8">
                <x-validation-errors class="mb-4" />

                @if (session('status'))
                    <div class="mb-4 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label for="email" class="mb-2 block text-sm font-medium text-slate-700">
                            Email
                        </label>
                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autofocus
                            autocomplete="username"
                            class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3.5 text-base text-slate-900 shadow-sm outline-none transition focus:border-slate-400 focus:ring-0"
                        >
                    </div>

                    <div>
                        <label for="password" class="mb-2 block text-sm font-medium text-slate-700">
                            Password
                        </label>
                        <input
                            id="password"
                            type="password"
                            name="password"
                            required
                            autocomplete="current-password"
                            class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3.5 text-base text-slate-900 shadow-sm outline-none transition focus:border-slate-400 focus:ring-0"
                        >
                    </div>

                    <div class="flex items-center">
                        <label for="remember_me" class="inline-flex items-center gap-3">
                            <input id="remember_me" type="checkbox" name="remember" class="rounded border-slate-300 text-slate-900 shadow-sm focus:ring-0">
                            <span class="text-sm text-slate-600">Remember me</span>
                        </label>
                    </div>

                    <div class="space-y-3 pt-2 sm:flex sm:items-center sm:justify-between sm:space-y-0">
                        @if (Route::has('password.request'))
                            <a class="block text-center text-sm font-medium text-slate-600 underline-offset-4 hover:text-slate-900 hover:underline sm:text-left"
                               href="{{ route('password.request') }}">
                                Forgot your password?
                            </a>
                        @endif

                        <button
                            type="submit"
                            class="inline-flex w-full items-center justify-center rounded-2xl bg-slate-900 px-5 py-3.5 text-sm font-semibold uppercase tracking-wide text-white transition hover:bg-slate-800 sm:w-auto sm:min-w-[120px]"
                        >
                            Log in
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
