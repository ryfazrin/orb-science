<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Pathway extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected static function booted(): void
    {
        static::creating(function ($pathway) {
            if (empty($pathway->slug)) {
                $pathway->slug = Str::slug($pathway->title);
            }
        });
    }

    public function levels()
    {
        return $this->hasMany(PathwayLevel::class)->orderBy('order');
    }

    /**
     * Hitung total kursus di seluruh level jalur ini
     */
    public function getTotalCoursesAttribute(): int
    {
        return $this->levels->sum(fn ($level) => $level->courses->count());
    }

    /**
     * Hitung total durasi menit kursus di seluruh level
     */
    public function getTotalMinutesAttribute(): int
    {
        return $this->levels->flatMap->courses->sum('duration_minutes');
    }
}
