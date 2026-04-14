<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function getProgressPercentageAttribute()
    {
        $course = $this->course()->with('modules.lessons')->first();
        if (!$course || $course->modules->isEmpty()) return 0;
        
        $courseLessonIds = $course->modules->flatMap->lessons->pluck('id')->toArray();
        $totalLessons = count($courseLessonIds);
        
        if ($totalLessons === 0) return 0;
        
        $completedLessons = \App\Models\User::find($this->user_id)
            ->completedLessons()
            ->whereIn('lesson_id', $courseLessonIds)
            ->count();
            
        return ceil(($completedLessons / $totalLessons) * 100);
    }
}
