<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function show($id)
    {
        $course = Course::with(['instructor.user', 'modules.lessons', 'reviews'])->findOrFail($id);
        
        // Calculate totals for UI display
        $totalLessons = $course->modules->flatMap->lessons->count();
        $totalDuration = $course->modules->flatMap->lessons->sum('duration_minutes');
        
        return view('pages.course-detail', compact('course', 'totalLessons', 'totalDuration'));
    }
}
