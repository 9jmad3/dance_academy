<div class="grid gap-6 xl:grid-cols-3">
    {{-- FORMULARIO --}}
    <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200 sm:p-6 xl:col-span-1">
        <div class="mb-5 flex items-center justify-between gap-4">
            <div>
                <h2 class="text-lg font-semibold text-slate-900">
                    {{ $editingId ? 'Editar horario' : 'Nuevo horario' }}
                </h2>
                <p class="mt-1 text-sm text-slate-500">
                    Crea y organiza las clases visibles en la academia.
                </p>
            </div>

            @if ($editingId)
                <button wire:click="resetForm" type="button"
                    class="shrink-0 rounded-xl border border-slate-200 px-3 py-2 text-sm font-medium text-slate-600 transition hover:bg-slate-50 hover:text-slate-900">
                    Cancelar
                </button>
            @endif
        </div>

        <form wire:submit="save" class="space-y-4">
            <div>
                <label class="mb-2 block text-sm font-medium text-slate-700">Estilo</label>
                <select wire:model="dance_style_id"
                    class="w-full rounded-xl border-slate-300 text-sm shadow-sm focus:border-slate-400 focus:ring-slate-400">
                    <option value="">Selecciona</option>
                    @foreach ($styles as $style)
                        <option value="{{ $style->id }}">{{ $style->name }}</option>
                    @endforeach
                </select>
                @error('dance_style_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="mb-2 block text-sm font-medium text-slate-700">Profesores</label>

                <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
                    @foreach ($teachers as $teacher)
                        <label class="block cursor-pointer">
                            <input type="checkbox" wire:model="teacher_ids" value="{{ $teacher->id }}"
                                class="peer sr-only">

                            <div
                                class="rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700 transition hover:border-slate-300 hover:bg-white hover:shadow-sm peer-checked:border-slate-900 peer-checked:bg-slate-900 peer-checked:text-white">
                                <span class="font-medium">{{ $teacher->name }}</span>
                            </div>
                        </label>
                    @endforeach
                </div>

                <p class="mt-2 text-xs text-slate-500">
                    Selecciona uno o varios profesores para esta clase.
                </p>

                @error('teacher_ids')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                @error('teacher_ids.*')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="mb-2 block text-sm font-medium text-slate-700">Día</label>
                <select wire:model="day_of_week"
                    class="w-full rounded-xl border-slate-300 text-sm shadow-sm focus:border-slate-400 focus:ring-slate-400">
                    @foreach ($days as $value => $label)
                        <option value="{{ $value }}">{{ $label }}</option>
                    @endforeach
                </select>
                @error('day_of_week')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Inicio</label>
                    <input type="time" wire:model="start_time"
                        class="w-full rounded-xl border-slate-300 text-sm shadow-sm focus:border-slate-400 focus:ring-slate-400">
                    @error('start_time')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Fin</label>
                    <input type="time" wire:model="end_time"
                        class="w-full rounded-xl border-slate-300 text-sm shadow-sm focus:border-slate-400 focus:ring-slate-400">
                    @error('end_time')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label class="mb-2 block text-sm font-medium text-slate-700">Nivel</label>
                <input type="text" wire:model="level"
                    class="w-full rounded-xl border-slate-300 text-sm shadow-sm focus:border-slate-400 focus:ring-slate-400">
                @error('level')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="mb-2 block text-sm font-medium text-slate-700">Sala</label>
                <input type="text" wire:model="room"
                    class="w-full rounded-xl border-slate-300 text-sm shadow-sm focus:border-slate-400 focus:ring-slate-400">
                @error('room')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="mb-2 block text-sm font-medium text-slate-700">Orden</label>
                <input type="number" wire:model="sort_order"
                    class="w-full rounded-xl border-slate-300 text-sm shadow-sm focus:border-slate-400 focus:ring-slate-400">
                @error('sort_order')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <label
                class="flex items-center gap-3 rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700">
                <input type="checkbox" wire:model="is_active"
                    class="rounded border-slate-300 text-slate-900 focus:ring-slate-400">
                <span class="font-medium">Activo</span>
            </label>

            <button type="submit"
                class="w-full rounded-xl bg-slate-900 px-4 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">
                Guardar
            </button>
        </form>
    </div>

    {{-- LISTADO --}}
    <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200 sm:p-6 xl:col-span-2">

        <div class="mb-5 flex items-center justify-between gap-4">
            <div>
                <h2 class="text-lg font-semibold text-slate-900">Listado de horarios</h2>
                <p class="mt-1 text-sm text-slate-500">
                    Revisa, edita o elimina las clases creadas.
                </p>
            </div>

            <a href="{{ route('admin.schedules.pdf', [
                'dance_style_id' => $filter_dance_style_id,
                'day_of_week' => $filter_day_of_week,
                'teacher_id' => $filter_teacher_id,
            ]) }}"
                class="inline-flex items-center rounded-xl bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-800">
                Descargar PDF
            </a>
        </div>

        {{-- FILTROS --}}
        <div class="mb-5 grid gap-4 rounded-2xl border border-slate-200 bg-slate-50 p-4 md:grid-cols-4">
            <div>
                <label class="mb-2 block text-sm font-medium text-slate-700">Filtrar por estilo</label>
                <select wire:model.live="filter_dance_style_id"
                    class="w-full rounded-xl border-slate-300 text-sm shadow-sm focus:border-slate-400 focus:ring-slate-400">
                    <option value="">Todos</option>
                    @foreach ($styles as $style)
                        <option value="{{ $style->id }}">{{ $style->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="mb-2 block text-sm font-medium text-slate-700">Filtrar por día</label>
                <select wire:model.live="filter_day_of_week"
                    class="w-full rounded-xl border-slate-300 text-sm shadow-sm focus:border-slate-400 focus:ring-slate-400">
                    <option value="">Todos</option>
                    @foreach ($days as $value => $label)
                        <option value="{{ $value }}">{{ $label }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="mb-2 block text-sm font-medium text-slate-700">Filtrar por profesor</label>
                <select wire:model.live="filter_teacher_id"
                    class="w-full rounded-xl border-slate-300 text-sm shadow-sm focus:border-slate-400 focus:ring-slate-400">
                    <option value="">Todos</option>
                    @foreach ($teachers as $teacher)
                        <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-end">
                <button wire:click="resetFilters" type="button"
                    class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-medium text-slate-700 transition hover:bg-slate-100">
                    Limpiar filtros
                </button>
            </div>
        </div>


        @if ($schedules->isEmpty())
            <div
                class="rounded-2xl border border-dashed border-slate-300 bg-slate-50 p-8 text-center text-sm text-slate-500">
                No hay horarios creados.
            </div>
        @else
            {{-- MÓVIL: CARDS --}}
            <div class="space-y-4 md:hidden">
                @foreach ($schedules as $schedule)
                    <article class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <span
                                    class="inline-flex rounded-full bg-slate-900 px-3 py-1 text-xs font-semibold text-white">
                                    {{ $schedule->day_label }}
                                </span>

                                <p class="mt-3 text-base font-semibold text-slate-900">
                                    {{ $schedule->danceStyle->name }}
                                </p>

                                <p class="mt-1 text-sm text-slate-500">
                                    {{ substr($schedule->start_time, 0, 5) }} -
                                    {{ substr($schedule->end_time, 0, 5) }}
                                </p>
                            </div>

                            <span
                                class="shrink-0 rounded-full px-3 py-1 text-xs font-semibold {{ $schedule->is_active ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-200 text-slate-600' }}">
                                {{ $schedule->is_active ? 'Activo' : 'Inactivo' }}
                            </span>
                        </div>

                        <div class="mt-4 space-y-2 text-sm text-slate-600">
                            <p>
                                <span class="font-medium text-slate-900">Profesores:</span>
                                {{ $schedule->teachers->pluck('name')->join(', ') }}
                            </p>
                            <p>
                                <span class="font-medium text-slate-900">Nivel:</span>
                                {{ $schedule->level ?: 'Sin nivel' }}
                            </p>
                            <p>
                                <span class="font-medium text-slate-900">Sala:</span>
                                {{ $schedule->room ?: 'Sin sala' }}
                            </p>
                            <p>
                                <span class="font-medium text-slate-900">Orden:</span>
                                {{ $schedule->sort_order }}
                            </p>
                        </div>

                        <div class="mt-4 flex gap-2">
                            <button wire:click="edit({{ $schedule->id }})"
                                class="flex-1 rounded-xl border border-slate-300 px-3 py-2 text-sm font-medium text-slate-700 transition hover:bg-white">
                                Editar
                            </button>

                            <button wire:click="delete({{ $schedule->id }})" wire:confirm="¿Eliminar horario?"
                                class="flex-1 rounded-xl border border-red-200 px-3 py-2 text-sm font-medium text-red-600 transition hover:bg-red-50">
                                Eliminar
                            </button>
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
                                <th class="px-4 py-3 font-medium">Día</th>
                                <th class="px-4 py-3 font-medium">Hora</th>
                                <th class="px-4 py-3 font-medium">Clase</th>
                                <th class="px-4 py-3 font-medium">Profesores</th>
                                <th class="px-4 py-3 font-medium text-right">Acciones</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-200 bg-white">
                            @foreach ($schedules as $schedule)
                                <tr>
                                    <td class="px-4 py-4">
                                        <span
                                            class="inline-flex rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700">
                                            {{ $schedule->day_label }}
                                        </span>
                                    </td>

                                    <td class="px-4 py-4">
                                        {{ substr($schedule->start_time, 0, 5) }} -
                                        {{ substr($schedule->end_time, 0, 5) }}
                                    </td>

                                    <td class="px-4 py-4">
                                        <p class="font-medium text-slate-900">{{ $schedule->danceStyle->name }}</p>
                                        <p class="mt-1 text-slate-500">
                                            {{ $schedule->level ?: 'Sin nivel' }} ·
                                            {{ $schedule->room ?: 'Sin sala' }}
                                        </p>
                                    </td>

                                    <td class="px-4 py-4">
                                        {{ $schedule->teachers->pluck('name')->join(', ') }}
                                    </td>

                                    <td class="px-4 py-4">
                                        <div class="flex justify-end gap-2">
                                            <button wire:click="edit({{ $schedule->id }})"
                                                class="rounded-xl border border-slate-300 px-3 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-50">
                                                Editar
                                            </button>

                                            <button wire:click="delete({{ $schedule->id }})"
                                                wire:confirm="¿Eliminar horario?"
                                                class="rounded-xl border border-red-200 px-3 py-2 text-sm font-medium text-red-600 transition hover:bg-red-50">
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
