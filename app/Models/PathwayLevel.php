<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PathwayLevel extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function pathway()
    {
        return $this->belongsTo(Pathway::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'pathway_level_course')
                    ->withPivot('order')
                    ->orderByPivot('order');
    }
}
