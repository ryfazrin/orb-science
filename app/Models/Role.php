<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'key',
        'has_admin_access',
    ];

    protected $casts = [
        'has_admin_access' => 'boolean',
    ];

    /**
     * Relasi ke seluruh pengguna yang terhubung ke role ini.
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
