<x-filament-panels::page>
    <form wire:submit.prevent="save">
        <div class="rounded-2xl border border-gray-200 bg-white shadow-sm overflow-hidden">

            @php
                $dynamicRoles = \App\Models\Role::where('has_admin_access', true)->where('key', '!=', 'admin')->get();
                $totalCols = 2 + $dynamicRoles->count(); // Resource Name + Admin + DynamicRoles
            @endphp

            {{-- Header --}}
            <div class="px-6 py-5 border-b border-gray-100 bg-gray-50">
                <h2 class="text-base font-bold text-gray-800">Konfigurasi Akses per Role</h2>
                <p class="text-sm text-gray-500 mt-1">
                    Atur menu mana yang bisa diakses oleh setiap role panel admin.
                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-red-50 text-red-700 text-xs font-bold ml-2">
                        Admin selalu bisa akses semua menu.
                    </span>
                </p>
                @if($dynamicRoles->isEmpty())
                <div class="mt-4 px-4 py-3 rounded-xl bg-amber-50 border border-amber-200 text-amber-700 text-sm font-semibold flex items-center gap-2">
                    <x-filament::icon icon="heroicon-o-exclamation-triangle" class="w-5 h-5 flex-shrink-0" />
                    Belum ada role lain yang diizinkan masuk ke panel Admin. Buat role baru dengan akses panel admin terlebih dahulu.
                </div>
                @endif
            </div>

            {{-- Table Header --}}
            <div class="grid gap-4 px-6 py-3 border-b border-gray-100 bg-gray-50/50" style="grid-template-columns: 1fr repeat({{ $totalCols - 1 }}, minmax(130px, 150px));">
                <div class="text-xs font-black uppercase tracking-wider text-gray-400">Resource / Menu</div>
                
                @foreach($dynamicRoles as $roleModel)
                <div class="text-xs font-black uppercase tracking-wider text-gray-400 text-center">
                    <span class="inline-flex items-center gap-1 px-2 py-1 rounded-lg bg-amber-50 text-amber-700">
                        🎓 {{ $roleModel->name }}
                    </span>
                </div>
                @endforeach

                <div class="text-xs font-black uppercase tracking-wider text-gray-400 text-center">
                    <span class="inline-flex items-center gap-1 px-2 py-1 rounded-lg bg-red-50 text-red-700">
                        🛡️ Admin
                    </span>
                </div>
            </div>

            {{-- Rows --}}
            @foreach ($this->getResources() as $resourceKey => $resourceLabel)
                @php $safeKey = str_replace('\\', '_', $resourceKey); @endphp
                <div class="grid gap-4 px-6 py-4 border-b border-gray-50 hover:bg-gray-50/50 transition-colors items-center" style="grid-template-columns: 1fr repeat({{ $totalCols - 1 }}, minmax(130px, 150px));">
                    {{-- Resource Name --}}
                    <div>
                        <p class="text-sm font-bold text-gray-800">{{ $resourceLabel }}</p>
                        <p class="text-xs text-gray-400 mt-0.5 font-mono truncate max-w-[200px]" title="{{ class_basename($resourceKey) }}">{{ class_basename($resourceKey) }}</p>
                    </div>

                    {{-- Dynamic Roles Toggles --}}
                    @foreach($dynamicRoles as $roleModel)
                    <div class="flex justify-center">
                        <x-filament::input.checkbox wire:model="settings.{{ $safeKey }}.{{ $roleModel->key }}" />
                    </div>
                    @endforeach

                    {{-- Admin Toggle (always on, disabled) --}}
                    <div class="flex justify-center">
                        <x-filament::input.checkbox checked disabled />
                    </div>
                </div>
            @endforeach

            {{-- Footer --}}
            <div class="px-6 py-4 bg-gray-50 flex items-center justify-between">
                <p class="text-xs text-gray-400">
                    Perubahan berlaku segera setelah disimpan.
                </p>
                <button
                    type="submit"
                    class="px-6 py-2.5 rounded-xl text-white text-sm font-bold shadow-sm hover:opacity-90 transition-opacity disabled:opacity-50"
                    style="background-color: #bc0100;"
                    {{ $dynamicRoles->isEmpty() ? 'disabled' : '' }}
                >
                    Simpan Pengaturan
                </button>
            </div>
        </div>
    </form>
</x-filament-panels::page>
