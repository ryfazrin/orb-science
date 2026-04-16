<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        $user   = User::findOrFail($userId);

        $enrollments = $user->enrollments()->with('course')->latest('updated_at')->get();

        // ======== ALGORITMA REKOMENDASI ========
        // 1. Ambil semua course_id yang sudah di-enroll
        $enrolledCourseIds = $enrollments->pluck('course_id')->toArray();

        // 2. Ambil category_id dari kursus yang sudah di-enroll
        $enrolledCategoryIds = Enrollment::where('user_id', $userId)
            ->with('course')
            ->get()
            ->pluck('course.category_id')
            ->filter()
            ->unique()
            ->toArray();

        // 3. Cari kursus yang belum di-enroll, prioritaskan dari kategori yang sama
        $recommended = Course::whereNotIn('id', $enrolledCourseIds)
            ->when(!empty($enrolledCategoryIds), function ($q) use ($enrolledCategoryIds) {
                // Urutkan: kategori relevan dulu, sisanya belakang
                $q->orderByRaw(
                    'CASE WHEN category_id IN (' . implode(',', $enrolledCategoryIds) . ') THEN 0 ELSE 1 END'
                );
            })
            ->with('instructor.user')
            ->limit(4)
            ->get();

        // 4. Jika rekomendasi < 4, tambahkan kursus populer (berdasarkan jumlah enrollment)
        if ($recommended->count() < 4) {
            $fallbackIds = $recommended->pluck('id')->merge($enrolledCourseIds)->toArray();
            $fallback    = Course::whereNotIn('id', $fallbackIds)
                ->withCount('enrollments')
                ->orderByDesc('enrollments_count')
                ->with('instructor.user')
                ->limit(4 - $recommended->count())
                ->get();
            $recommended = $recommended->merge($fallback);
        }
        // ======================================

        return view('pages.dashboard', compact('user', 'enrollments', 'recommended'));
    }
}
