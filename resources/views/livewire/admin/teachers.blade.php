<div class="grid gap-6 xl:grid-cols-3">
    {{-- FORMULARIO --}}
    <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200 sm:p-6 xl:col-span-1">
        <div class="mb-5 flex items-center justify-between gap-4">
            <div>
                <h2 class="text-lg font-semibold text-slate-900">
                    {{ $editingId ? 'Editar profesor' : 'Nuevo profesor' }}
                </h2>
                <p class="mt-1 text-sm text-slate-500">
                    Añade o actualiza los perfiles visibles en la web.
                </p>
            </div>

            @if ($editingId)
                <button
                    wire:click="resetForm"
                    type="button"
                    class="shrink-0 rounded-xl border border-slate-200 px-3 py-2 text-sm font-medium text-slate-600 transition hover:bg-slate-50 hover:text-slate-900"
                >
                    Cancelar
                </button>
            @endif
        </div>

        <form wire:submit="save" class="space-y-4">
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
                <label class="mb-2 block text-sm font-medium text-slate-700">Biografía</label>
                <textarea
                    wire:model="bio"
                    rows="4"
                    class="w-full rounded-xl border-slate-300 text-sm shadow-sm focus:border-slate-400 focus:ring-slate-400"
                ></textarea>
                @error('bio')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="mb-2 block text-sm font-medium text-slate-700">Foto</label>

                <label class="block cursor-pointer">
                    <input type="file" wire:model="photo" accept=".jpg,.jpeg,.png,.webp" class="hidden">

                    <div class="rounded-2xl border border-dashed border-slate-300 bg-slate-50 p-5 transition hover:border-slate-400 hover:bg-slate-100">
                        <div class="flex items-center gap-4">
                            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-white shadow-sm ring-1 ring-slate-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                        d="M3 15.75V18a2.25 2.25 0 002.25 2.25h13.5A2.25 2.25 0 0021 18v-2.25M7.5 9l4.5-4.5m0 0L16.5 9M12 4.5V16.5" />
                                </svg>
                            </div>

                            <div>
                                <p class="text-sm font-semibold text-slate-900">Subir imagen</p>
                                <p class="text-xs text-slate-500">
                                    Haz clic para seleccionar una foto en JPG, PNG o WEBP
                                </p>
                            </div>
                        </div>
                    </div>
                </label>

                @error('photo')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror

                <div wire:loading wire:target="photo" class="mt-2 text-sm text-slate-500">
                    Subiendo imagen...
                </div>

                @if ($photo)
                    <div class="mt-4 overflow-hidden rounded-2xl border border-slate-200 bg-slate-50 p-3">
                        <p class="mb-3 text-xs font-medium uppercase tracking-wide text-slate-500">Vista previa</p>
                        <img src="{{ $photo->temporaryUrl() }}" class="h-36 w-full rounded-xl object-cover">
                    </div>
                @elseif ($currentPhoto)
                    <div class="mt-4 overflow-hidden rounded-2xl border border-slate-200 bg-slate-50 p-3">
                        <p class="mb-3 text-xs font-medium uppercase tracking-wide text-slate-500">Imagen actual</p>
                        <img src="{{ asset('storage/' . $currentPhoto) }}" class="h-36 w-full rounded-xl object-cover">
                    </div>
                @endif
            </div>

            <div>
                <label class="mb-2 block text-sm font-medium text-slate-700">Orden</label>
                <input
                    type="number"
                    wire:model="sort_order"
                    class="w-full rounded-xl border-slate-300 text-sm shadow-sm focus:border-slate-400 focus:ring-slate-400"
                >
                @error('sort_order')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <label class="flex items-center gap-3 rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700">
                <input
                    type="checkbox"
                    wire:model="is_active"
                    class="rounded border-slate-300 text-slate-900 focus:ring-slate-400"
                >
                <span class="font-medium">Activo</span>
            </label>

            <button
                type="submit"
                class="w-full rounded-xl bg-slate-900 px-4 py-3 text-sm font-semibold text-white transition hover:bg-slate-800"
            >
                Guardar
            </button>
        </form>
    </div>

    {{-- LISTADO --}}
    <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200 sm:p-6 xl:col-span-2">
        <div class="mb-5">
            <h2 class="text-lg font-semibold text-slate-900">Listado de profesores</h2>
            <p class="mt-1 text-sm text-slate-500">
                Gestiona los profesores publicados y su orden de aparición.
            </p>
        </div>

        @if($teachers->isEmpty())
            <div class="rounded-2xl border border-dashed border-slate-300 bg-slate-50 p-8 text-center text-sm text-slate-500">
                No hay profesores creados.
            </div>
        @else
            {{-- MÓVIL: CARDS --}}
            <div class="space-y-4 md:hidden">
                @foreach($teachers as $teacher)
                    <article class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                        <div class="flex items-start gap-4">
                            @if($teacher->photo)
                                <img
                                    src="{{ asset('storage/' . $teacher->photo) }}"
                                    alt="{{ $teacher->name }}"
                                    class="h-14 w-14 shrink-0 rounded-2xl object-cover ring-1 ring-slate-200"
                                >
                            @else
                                <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-slate-900 text-base font-bold text-white">
                                    {{ \Illuminate\Support\Str::of($teacher->name)->substr(0, 1) }}
                                </div>
                            @endif

                            <div class="min-w-0 flex-1">
                                <div class="flex items-start justify-between gap-3">
                                    <div class="min-w-0">
                                        <p class="text-base font-semibold text-slate-900">
                                            {{ $teacher->name }}
                                        </p>
                                        <p class="mt-1 text-sm text-slate-500">
                                            {{ $teacher->bio ?: 'Sin biografía' }}
                                        </p>
                                    </div>

                                    <span class="shrink-0 rounded-full px-3 py-1 text-xs font-semibold {{ $teacher->is_active ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-200 text-slate-600' }}">
                                        {{ $teacher->is_active ? 'Activo' : 'Inactivo' }}
                                    </span>
                                </div>

                                <div class="mt-4 flex items-center justify-between gap-3">
                                    <p class="text-sm text-slate-500">
                                        <span class="font-medium text-slate-700">Orden:</span> {{ $teacher->sort_order }}
                                    </p>

                                    <div class="flex gap-2">
                                        <button
                                            wire:click="edit({{ $teacher->id }})"
                                            class="rounded-xl border border-slate-300 px-3 py-2 text-sm font-medium text-slate-700 transition hover:bg-white"
                                        >
                                            Editar
                                        </button>

                                        <button
                                            wire:click="delete({{ $teacher->id }})"
                                            wire:confirm="¿Eliminar profesor?"
                                            class="rounded-xl border border-red-200 px-3 py-2 text-sm font-medium text-red-600 transition hover:bg-red-50"
                                        >
                                            Eliminar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            {{-- TABLET/DESKTOP: TABLA --}}
            <div class="hidden overflow-hidden rounded-2xl border border-slate-200 md:block">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200 text-sm">
                        <thead class="bg-slate-50 text-left text-slate-600">
                            <tr>
                                <th class="px-4 py-3 font-medium">Profesor</th>
                                <th class="px-4 py-3 font-medium">Estado</th>
                                <th class="px-4 py-3 font-medium">Orden</th>
                                <th class="px-4 py-3 font-medium text-right">Acciones</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-200 bg-white">
                            @foreach($teachers as $teacher)
                                <tr>
                                    <td class="px-4 py-4">
                                        <div class="flex items-start gap-3">
                                            @if($teacher->photo)
                                                <img
                                                    src="{{ asset('storage/' . $teacher->photo) }}"
                                                    alt="{{ $teacher->name }}"
                                                    class="h-12 w-12 shrink-0 rounded-xl object-cover ring-1 ring-slate-200"
                                                >
                                            @else
                                                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-slate-900 text-sm font-bold text-white">
                                                    {{ \Illuminate\Support\Str::of($teacher->name)->substr(0, 1) }}
                                                </div>
                                            @endif

                                            <div>
                                                <p class="font-medium text-slate-900">{{ $teacher->name }}</p>
                                                <p class="mt-1 text-slate-500">{{ $teacher->bio ?: 'Sin biografía' }}</p>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-4 py-4">
                                        <span class="rounded-full px-3 py-1 text-xs font-semibold {{ $teacher->is_active ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-200 text-slate-600' }}">
                                            {{ $teacher->is_active ? 'Activo' : 'Inactivo' }}
                                        </span>
                                    </td>

                                    <td class="px-4 py-4">{{ $teacher->sort_order }}</td>

                                    <td class="px-4 py-4">
                                        <div class="flex justify-end gap-2">
                                            <button
                                                wire:click="edit({{ $teacher->id }})"
                                                class="rounded-xl border border-slate-300 px-3 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-50"
                                            >
                                                Editar
                                            </button>

                                            <button
                                                wire:click="delete({{ $teacher->id }})"
                                                wire:confirm="¿Eliminar profesor?"
                                                class="rounded-xl border border-red-200 px-3 py-2 text-sm font-medium text-red-600 transition hover:bg-red-50"
                                            >
                                                Eliminar
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
</div>
