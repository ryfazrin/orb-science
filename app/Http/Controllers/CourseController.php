<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function show($id)
    {
        $course = Course::with(['instructor.user', 'modules.lessons', 'reviews'])->findOrFail($id);
        
        // Calculate totals for UI display
        $totalLessons = $course->modules->flatMap->lessons->count();
        $totalDuration = $course->modules->flatMap->lessons->sum('duration_minutes');
        
        // Determine if current user is enrolled (move logic out of view)
        $isEnrolled = false;
        $firstLesson = null;

        if (auth()->check()) {
            $isEnrolled = Enrollment::where('user_id', auth()->id())
                ->where('course_id', $course->id)
                ->exists();
        }

        // find first lesson to link "Belajar sekarang"
        $firstLesson = $course->modules->flatMap->lessons->first();

        return view('pages.course-detail', compact('course', 'totalLessons', 'totalDuration', 'isEnrolled', 'firstLesson'));
    }
}
