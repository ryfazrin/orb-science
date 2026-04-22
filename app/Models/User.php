<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable implements FilamentUser, HasAvatar
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'bio',
        'avatar_url',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    /**
     * Mengatur URL Avatar untuk Filament Header & Dashboard.
     */
    public function getFilamentAvatarUrl(): ?string
    {
        if ($this->avatar_url) {
            if (str_starts_with($this->avatar_url, 'http')) {
                return $this->avatar_url;
            }
            return Storage::url($this->avatar_url);
        }
        
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&background=bc0100&color=fff';
    }

    // ─── Role Helpers ─────────────────────────────────────────────────────────

    public function isAdmin(): bool
    {
        return $this->role?->key === 'admin';
    }

    public function isInstructor(): bool
    {
        return $this->role?->key === 'instructor';
    }

    public function isStudent(): bool
    {
        return $this->role?->key === 'student';
    }

    /**
     * Filament access gate — check if user's role has_admin_access.
     */
    public function canAccessPanel(Panel $panel): bool
    {
        // Secara *hardcode*, pastikan 'admin' selalu lolos
        if ($this->isAdmin()) {
            return true;
        }

        // Cek secara dinamis melalui relasi eloquent database
        return $this->role?->has_admin_access ?? false;
    }

    // ─── Relationships ────────────────────────────────────────────────────────

    public function instructor()
    {
        return $this->hasOne(Instructor::class);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function completedLessons()
    {
        return $this->belongsToMany(Lesson::class)->withTimestamps();
    }

    /**
     * Relasi ke tabel roles dinamis dengan foreign key standar role_id.
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
