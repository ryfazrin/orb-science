<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class LearningController extends Controller
{
    public function show($course_id, $lesson_id)
    {
        // For the course workspace, we need almost identical variables as the course detail + the current lesson
        $course = Course::with(['modules.lessons'])->findOrFail($course_id);
        $currentLesson = Lesson::findOrFail($lesson_id);
        
        // Ensure lesson belongs to the course
        abort_if($currentLesson->module->course_id !== $course->id, 404);

        // Flatten all lessons in order
        $allLessons = $course->modules->flatMap->lessons->values();
        $currentIndex = $allLessons->search(function($l) use ($currentLesson) {
            return $l->id === $currentLesson->id;
        });

        $prevLesson = $currentIndex > 0 ? $allLessons[$currentIndex - 1] : null;
        $nextLesson = $currentIndex < $allLessons->count() - 1 ? $allLessons[$currentIndex + 1] : null;

        // Fetch User 1 Enrollment Progress
        $userId = 1;
        $user = \App\Models\User::find($userId);
        $enrollment = Enrollment::where('user_id', $userId)->where('course_id', $course->id)->first();
        
        $completedLessonIds = $user->completedLessons->pluck('id')->toArray();
        $totalLessons = $allLessons->count();
        $courseLessonIds = $allLessons->pluck('id')->toArray();
        $completedLessonsCount = collect($completedLessonIds)->intersect($courseLessonIds)->count();
        
        $progressPercent = $totalLessons > 0 ? ceil(($completedLessonsCount / $totalLessons) * 100) : 0;

        return view('pages.lesson', compact('course', 'currentLesson', 'prevLesson', 'nextLesson', 'progressPercent', 'totalLessons', 'completedLessonsCount', 'completedLessonIds'));
    }

    public function complete(Request $request, $course_id, $lesson_id)
    {
        $userId = 1;
        $user = \App\Models\User::find($userId);
        $course = Course::with(['modules.lessons'])->findOrFail($course_id);
        
        // Record passing
        $user->completedLessons()->syncWithoutDetaching([$lesson_id]);

        $enrollment = Enrollment::where('user_id', $userId)->where('course_id', $course_id)->first();

        // Get Next Lesson
        $allLessons = $course->modules->flatMap->lessons->values();
        $currentIndex = $allLessons->search(function($l) use ($lesson_id) {
            return $l->id == $lesson_id;
        });

        $nextLesson = $currentIndex !== false && $currentIndex < $allLessons->count() - 1 
            ? $allLessons[$currentIndex + 1] 
            : null;

        if ($enrollment) {
            $courseLessonIds = $allLessons->pluck('id')->toArray();
            $completedCount = $user->completedLessons()->whereIn('lesson_id', $courseLessonIds)->count();
            $totalLessons = count($courseLessonIds) ?: 1;
            
            $newProgress = min(100, ceil(($completedCount / $totalLessons) * 100));
            
            $enrollment->update([
                'progress_percentage' => $newProgress,
                'last_accessed_at' => now(),
                'status' => $newProgress == 100 ? 'completed' : 'active'
            ]);
        }

        if ($nextLesson) {
            return redirect("/course/{$course_id}/learn/{$nextLesson->id}");
        }

        return redirect("/dashboard");
    }
}
