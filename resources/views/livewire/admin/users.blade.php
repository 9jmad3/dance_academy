<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-semibold text-slate-900">Gestión de usuarios</h2>
            <p class="text-sm text-slate-500">Crea y edita usuarios del panel.</p>
        </div>

        <button wire:click="create"
            class="rounded-xl bg-slate-900 px-4 py-2 text-sm font-medium text-white transition hover:bg-slate-800">
            Nuevo usuario
        </button>
    </div>

    @if ($showForm)
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <h3 class="mb-6 text-lg font-semibold text-slate-900">
                {{ $isEditing ? 'Editar usuario' : 'Crear usuario' }}
            </h3>

            <div class="grid gap-6 md:grid-cols-2">
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Nombre</label>
                    <input type="text" wire:model.defer="name"
                        class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm shadow-sm focus:border-slate-400 focus:outline-none">
                    @error('name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Correo</label>
                    <input type="email" wire:model.defer="email"
                        class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm shadow-sm focus:border-slate-400 focus:outline-none">
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">
                        {{ $isEditing ? 'Nueva contraseña (opcional)' : 'Contraseña' }}
                    </label>
                    <input type="password" wire:model.defer="password"
                        class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm shadow-sm focus:border-slate-400 focus:outline-none">
                    @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center">
                    <label class="inline-flex items-center gap-3 rounded-xl border border-slate-200 px-4 py-3">
                        <input type="checkbox" wire:model.defer="is_active" class="rounded border-slate-300 text-slate-900">
                        <span class="text-sm font-medium text-slate-700">Usuario activo</span>
                    </label>
                    @error('is_active')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-6 flex items-center gap-3">
                <button wire:click="save"
                    class="rounded-xl bg-emerald-600 px-4 py-2 text-sm font-medium text-white transition hover:bg-emerald-700">
                    {{ $isEditing ? 'Guardar cambios' : 'Crear usuario' }}
                </button>

                <button wire:click="cancel"
                    class="rounded-xl border border-slate-300 bg-white px-4 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-50">
                    Cancelar
                </button>
            </div>
        </div>
    @endif

    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Nombre</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Correo</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Activo</th>
                        <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-slate-500">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($users as $user)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4 text-sm font-medium text-slate-900">{{ $user->name }}</td>
                            <td class="px-6 py-4 text-sm text-slate-600">{{ $user->email }}</td>
                            <td class="px-6 py-4 text-sm">
                                @if($user->is_active)
                                    <span class="inline-flex rounded-full bg-emerald-100 px-3 py-1 text-xs font-medium text-emerald-700">
                                        Sí
                                    </span>
                                @else
                                    <span class="inline-flex rounded-full bg-red-100 px-3 py-1 text-xs font-medium text-red-700">
                                        No
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right text-sm">
                                <div class="flex justify-end gap-2">
                                    <button wire:click="edit({{ $user->id }})"
                                        class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm font-medium text-slate-700 hover:bg-slate-50">
                                        Editar
                                    </button>

                                    <button wire:click="toggleActive({{ $user->id }})"
                                        class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm font-medium text-slate-700 hover:bg-slate-50">
                                        {{ $user->is_active ? 'Desactivar' : 'Activar' }}
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-sm text-slate-500">
                                No hay usuarios registrados.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
