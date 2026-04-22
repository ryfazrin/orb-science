<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminAccessSetting extends Model
{
    protected $fillable = ['resource_key', 'role', 'is_visible'];

    protected $casts = ['is_visible' => 'boolean'];

    /**
     * Check if a resource is visible for a given role.
     * Admin always returns true.
     */
    public static function isVisible(string $resourceClass, string $role): bool
    {
        if ($role === 'admin') {
            return true;
        }

        $setting = static::where('resource_key', $resourceClass)
            ->where('role', $role)
            ->first();

        // Default: visible if no record exists yet
        return $setting ? $setting->is_visible : true;
    }

    /**
     * Get all defined resource keys with their label.
     */
    public static function allResourceKeys(): array
    {
        return [
            \App\Filament\Resources\CourseResource::class   => 'Courses',
            \App\Filament\Resources\ModuleResource::class   => 'Modules',
            \App\Filament\Resources\LessonResource::class   => 'Lessons',
            \App\Filament\Resources\PathwayResource::class   => 'Pathways',
            \App\Filament\Resources\ArticleResource::class  => 'Articles',
            \App\Filament\Resources\UserResource::class     => 'Users',
        ];
    }
}
