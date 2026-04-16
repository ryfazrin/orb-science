<?php

namespace App\Http\Controllers;

use App\Models\Pathway;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class PathwayController extends Controller
{
    public function index()
    {
        $pathways = Pathway::with(['levels.courses'])->latest()->get();
        return view('pages.pathway', compact('pathways'));
    }

    public function show($slug)
    {
        $pathway = Pathway::with(['levels.courses.modules'])->where('slug', $slug)->firstOrFail();

        // Ambil kursus yang sudah di-enroll user (jika login)
        $enrolledCourseIds = [];
        $completedCourseIds = [];
        if (auth()->check()) {
            $enrollments = Enrollment::where('user_id', auth()->id())->get();
            $enrolledCourseIds   = $enrollments->pluck('course_id')->toArray();
            $completedCourseIds  = $enrollments->where('status', 'completed')->pluck('course_id')->toArray();
        }

        return view('pages.pathway-detail', compact('pathway', 'enrolledCourseIds', 'completedCourseIds'));
    }
}
