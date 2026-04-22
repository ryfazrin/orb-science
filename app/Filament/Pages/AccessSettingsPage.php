<?php

namespace App\Filament\Pages;

use App\Models\AdminAccessSetting;
use App\Models\Role;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class AccessSettingsPage extends Page
{
    protected static ?string $navigationIcon  = 'heroicon-o-key';
    protected static ?string $navigationLabel = 'Pengaturan Akses';
    protected static ?string $navigationGroup = 'User Management';
    protected static ?int    $navigationSort  = 3;
    protected static ?string $title = 'Pengaturan Akses Menu';
    protected static string  $view = 'filament.pages.access-settings-page';

    /** @var array<string, array<string, bool>> */
    public array $settings = [];

    public static function canAccess(): bool
    {
        return auth()->user()?->isAdmin() ?? false;
    }

    public function mount(): void
    {
        $this->loadSettings();
    }

    protected function getDynamicRoles()
    {
        return collect(Role::where('has_admin_access', true)->where('key', '!=', 'admin')->get());
    }

    public function loadSettings(): void
    {
        $resources = AdminAccessSetting::allResourceKeys();
        $dynamicRoles = $this->getDynamicRoles();

        foreach ($resources as $key => $label) {
            $safeKey = str_replace('\\', '_', $key);
            foreach ($dynamicRoles as $roleModel) {
                $roleKey = $roleModel->key;
                $record = AdminAccessSetting::where('resource_key', $key)
                    ->where('role', $roleKey)
                    ->first();

                // Cek setting, default true jika belum ada
                $this->settings[$safeKey][$roleKey] = $record ? $record->is_visible : true;
            }
        }
    }

    public function save(): void
    {
        $resources = AdminAccessSetting::allResourceKeys();
        $dynamicRoles = $this->getDynamicRoles();

        foreach ($resources as $key => $label) {
            $safeKey = str_replace('\\', '_', $key);
            foreach ($dynamicRoles as $roleModel) {
                $roleKey = $roleModel->key;
                $isVisible = $this->settings[$safeKey][$roleKey] ?? true;

                AdminAccessSetting::updateOrCreate(
                    ['resource_key' => $key, 'role' => $roleKey],
                    ['is_visible'   => $isVisible]
                );
            }
        }

        Notification::make()
            ->title('Pengaturan akses berhasil disimpan!')
            ->success()
            ->send();
    }

    public function getResources(): array
    {
        return AdminAccessSetting::allResourceKeys();
    }
}
