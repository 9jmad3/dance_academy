<div class="space-y-6">

    {{-- HEADER --}}
    <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
        <h2 class="text-lg font-semibold text-slate-900">Mi cuenta</h2>
        <p class="mt-1 text-sm text-slate-500">
            Gestiona tu perfil, contraseña y seguridad de acceso.
        </p>
    </div>


    {{-- PERFIL --}}
    <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
        <livewire:profile.update-profile-information-form />
    </div>


    {{-- CONTRASEÑA --}}
    <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
        <livewire:profile.update-password-form />
    </div>


    {{-- 2FA --}}
    @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
        <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
            <livewire:profile.two-factor-authentication-form />
        </div>
    @endif


    {{-- SESIONES --}}
    <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
        <livewire:profile.logout-other-browser-sessions-form />
    </div>


    {{-- ELIMINAR CUENTA --}}
    @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
        <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-red-200">
            <livewire:profile.delete-user-form />
        </div>
    @endif

</div>
