<div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200 sm:p-6">
    <div class="mb-6">
        <h2 class="text-lg font-semibold text-slate-900">Datos de la academia</h2>
        <p class="mt-1 text-sm text-slate-500">
            Configura la información principal que se mostrará en la web pública.
        </p>
    </div>

    <form wire:submit="save" class="space-y-8">
        {{-- INFORMACIÓN GENERAL --}}
        <section class="space-y-5">
            <div>
                <h3 class="text-sm font-semibold uppercase tracking-wide text-slate-700">
                    Información general
                </h3>
                <p class="mt-1 text-sm text-slate-500">
                    Nombre, URL pública y descripción principal de la academia.
                </p>
            </div>

            <div class="grid gap-5 lg:grid-cols-2">
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Nombre</label>
                    <input
                        type="text"
                        wire:model="name"
                        class="w-full rounded-xl border-slate-300 text-sm shadow-sm focus:border-slate-400 focus:ring-slate-400"
                    >
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Slug</label>
                    <input
                        type="text"
                        wire:model="slug"
                        class="w-full rounded-xl border-slate-300 text-sm shadow-sm focus:border-slate-400 focus:ring-slate-400"
                    >
                    @error('slug')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="lg:col-span-2">
                    <label class="mb-2 block text-sm font-medium text-slate-700">Descripción</label>
                    <textarea
                        wire:model="description"
                        rows="4"
                        class="w-full rounded-xl border-slate-300 text-sm shadow-sm focus:border-slate-400 focus:ring-slate-400"
                    ></textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </section>

        {{-- CONTACTO --}}
        <section class="space-y-5 border-t border-slate-200 pt-8">
            <div>
                <h3 class="text-sm font-semibold uppercase tracking-wide text-slate-700">
                    Contacto
                </h3>
                <p class="mt-1 text-sm text-slate-500">
                    Datos visibles para que los alumnos puedan localizarte fácilmente.
                </p>
            </div>

            <div class="grid gap-5 lg:grid-cols-2">
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Teléfono</label>
                    <input
                        type="text"
                        wire:model="phone"
                        class="w-full rounded-xl border-slate-300 text-sm shadow-sm focus:border-slate-400 focus:ring-slate-400"
                    >
                    @error('phone')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Email</label>
                    <input
                        type="email"
                        wire:model="email"
                        class="w-full rounded-xl border-slate-300 text-sm shadow-sm focus:border-slate-400 focus:ring-slate-400"
                    >
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">WhatsApp</label>
                    <input
                        type="text"
                        wire:model="whatsapp"
                        class="w-full rounded-xl border-slate-300 text-sm shadow-sm focus:border-slate-400 focus:ring-slate-400"
                    >
                    @error('whatsapp')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Dirección</label>
                    <input
                        type="text"
                        wire:model="address"
                        class="w-full rounded-xl border-slate-300 text-sm shadow-sm focus:border-slate-400 focus:ring-slate-400"
                    >
                    @error('address')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="lg:col-span-2">
                    <label class="mb-2 block text-sm font-medium text-slate-700">Instagram URL</label>
                    <input
                        type="url"
                        wire:model="instagram_url"
                        class="w-full rounded-xl border-slate-300 text-sm shadow-sm focus:border-slate-400 focus:ring-slate-400"
                    >
                    @error('instagram_url')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </section>

        {{-- IMAGEN / BANNER --}}
        <section class="space-y-5 border-t border-slate-200 pt-8">
            <div>
                <h3 class="text-sm font-semibold uppercase tracking-wide text-slate-700">
                    Banner principal
                </h3>
                <p class="mt-1 text-sm text-slate-500">
                    Imagen de cabecera para la landing principal de la academia.
                </p>
            </div>

            <div>
                <label class="mb-2 block text-sm font-medium text-slate-700">Banner de la academia</label>

                <label class="block cursor-pointer">
                    <input type="file" wire:model="banner" accept=".jpg,.jpeg,.png,.webp" class="hidden">

                    <div class="rounded-2xl border border-dashed border-slate-300 bg-slate-50 p-6 transition hover:border-slate-400 hover:bg-slate-100">
                        <div class="flex items-center gap-4">
                            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-white shadow-sm ring-1 ring-slate-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                        d="M3 15.75V18a2.25 2.25 0 002.25 2.25h13.5A2.25 2.25 0 0021 18v-2.25M7.5 9l4.5-4.5m0 0L16.5 9M12 4.5V16.5" />
                                </svg>
                            </div>

                            <div>
                                <p class="text-sm font-semibold text-slate-900">Subir banner</p>
                                <p class="text-xs text-slate-500">
                                    Haz clic para seleccionar una imagen (JPG, PNG o WEBP)
                                </p>
                            </div>
                        </div>
                    </div>
                </label>

                @error('banner')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror

                <div wire:loading wire:target="banner" class="mt-2 text-sm text-slate-500">
                    Subiendo banner...
                </div>

                @if ($banner)
                    <div class="mt-4 overflow-hidden rounded-2xl border border-slate-200 bg-slate-50 p-3">
                        <p class="mb-3 text-xs font-medium uppercase tracking-wide text-slate-500">
                            Vista previa
                        </p>
                        <img src="{{ $banner->temporaryUrl() }}" class="h-48 w-full rounded-xl object-cover">
                    </div>
                @elseif ($currentBanner)
                    <div class="mt-4 overflow-hidden rounded-2xl border border-slate-200 bg-slate-50 p-3">
                        <p class="mb-3 text-xs font-medium uppercase tracking-wide text-slate-500">
                            Banner actual
                        </p>
                        <img src="{{ asset('storage/' . $currentBanner) }}" class="h-48 w-full rounded-xl object-cover">
                    </div>
                @endif
            </div>
        </section>

        {{-- HERO --}}
        <section class="space-y-5 border-t border-slate-200 pt-8">
            <div>
                <h3 class="text-sm font-semibold uppercase tracking-wide text-slate-700">
                    Hero de la landing
                </h3>
                <p class="mt-1 text-sm text-slate-500">
                    Título y texto principal que verán los usuarios al entrar en la web.
                </p>
            </div>

            <div class="grid gap-5 lg:grid-cols-2">
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Hero title</label>
                    <input
                        type="text"
                        wire:model="hero_title"
                        class="w-full rounded-xl border-slate-300 text-sm shadow-sm focus:border-slate-400 focus:ring-slate-400"
                    >
                    @error('hero_title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="lg:col-span-2">
                    <label class="mb-2 block text-sm font-medium text-slate-700">Hero text</label>
                    <textarea
                        wire:model="hero_text"
                        rows="4"
                        class="w-full rounded-xl border-slate-300 text-sm shadow-sm focus:border-slate-400 focus:ring-slate-400"
                    ></textarea>
                    @error('hero_text')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </section>

        {{-- BOTÓN --}}
        <div class="border-t border-slate-200 pt-6">
            <button
                type="submit"
                class="inline-flex w-full items-center justify-center rounded-xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-800 sm:w-auto"
            >
                Guardar cambios
            </button>
        </div>
    </form>
</div>
