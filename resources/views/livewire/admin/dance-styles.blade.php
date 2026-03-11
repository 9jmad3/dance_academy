<div class="grid gap-6 xl:grid-cols-3">
    {{-- FORMULARIO --}}
    <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200 sm:p-6 xl:col-span-1">
        <div class="mb-5 flex items-center justify-between gap-4">
            <div>
                <h2 class="text-lg font-semibold text-slate-900">
                    {{ $editingId ? 'Editar estilo' : 'Nuevo estilo' }}
                </h2>
                <p class="mt-1 text-sm text-slate-500">
                    Gestiona los estilos visibles en la web.
                </p>
            </div>

            @if($editingId)
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
            <h2 class="text-lg font-semibold text-slate-900">Listado de estilos</h2>
            <p class="mt-1 text-sm text-slate-500">
                Revisa, edita o elimina los estilos disponibles.
            </p>
        </div>

        @if($styles->isEmpty())
            <div class="rounded-2xl border border-dashed border-slate-300 bg-slate-50 p-8 text-center text-sm text-slate-500">
                No hay estilos creados.
            </div>
        @else
            {{-- MÓVIL: CARDS --}}
            <div class="space-y-4 md:hidden">
                @foreach($styles as $style)
                    <article class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                        <div class="flex items-start justify-between gap-3">
                            <div class="min-w-0">
                                <p class="text-base font-semibold text-slate-900">
                                    {{ $style->name }}
                                </p>
                                <p class="mt-1 text-sm text-slate-500">
                                    {{ $style->description ?: 'Sin descripción' }}
                                </p>
                            </div>

                            <span class="shrink-0 rounded-full px-3 py-1 text-xs font-semibold {{ $style->is_active ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-200 text-slate-600' }}">
                                {{ $style->is_active ? 'Activo' : 'Inactivo' }}
                            </span>
                        </div>

                        <div class="mt-4 flex items-center justify-between gap-3">
                            <p class="text-sm text-slate-500">
                                <span class="font-medium text-slate-700">Orden:</span> {{ $style->sort_order }}
                            </p>

                            <div class="flex gap-2">
                                <button
                                    wire:click="edit({{ $style->id }})"
                                    class="rounded-xl border border-slate-300 px-3 py-2 text-sm font-medium text-slate-700 transition hover:bg-white"
                                >
                                    Editar
                                </button>

                                <button
                                    wire:click="delete({{ $style->id }})"
                                    wire:confirm="¿Eliminar estilo?"
                                    class="rounded-xl border border-red-200 px-3 py-2 text-sm font-medium text-red-600 transition hover:bg-red-50"
                                >
                                    Eliminar
                                </button>
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
                                <th class="px-4 py-3 font-medium">Nombre</th>
                                <th class="px-4 py-3 font-medium">Estado</th>
                                <th class="px-4 py-3 font-medium">Orden</th>
                                <th class="px-4 py-3 font-medium text-right">Acciones</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-200 bg-white">
                            @foreach($styles as $style)
                                <tr>
                                    <td class="px-4 py-4">
                                        <p class="font-medium text-slate-900">{{ $style->name }}</p>
                                        <p class="mt-1 text-slate-500">{{ $style->description ?: 'Sin descripción' }}</p>
                                    </td>

                                    <td class="px-4 py-4">
                                        <span class="rounded-full px-3 py-1 text-xs font-semibold {{ $style->is_active ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-200 text-slate-600' }}">
                                            {{ $style->is_active ? 'Activo' : 'Inactivo' }}
                                        </span>
                                    </td>

                                    <td class="px-4 py-4">{{ $style->sort_order }}</td>

                                    <td class="px-4 py-4">
                                        <div class="flex justify-end gap-2">
                                            <button
                                                wire:click="edit({{ $style->id }})"
                                                class="rounded-xl border border-slate-300 px-3 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-50"
                                            >
                                                Editar
                                            </button>

                                            <button
                                                wire:click="delete({{ $style->id }})"
                                                wire:confirm="¿Eliminar estilo?"
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
