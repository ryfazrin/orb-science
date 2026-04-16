<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Enrollment;
use App\Models\UserQuizResult;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ExamController extends Controller
{
    public function show($course_id, $lesson_id)
    {
        $course = Course::with(['modules.lessons'])->findOrFail($course_id);
        $lesson = Lesson::with('questions.options')->findOrFail($lesson_id);

        abort_if($lesson->type !== 'quiz', 404);
        abort_if($lesson->module->course_id !== $course->id, 404);

        $userId = auth()->id();

        // Cari atau buat attempt baru
        $existingPassed = UserQuizResult::where('user_id', $userId)
            ->where('lesson_id', $lesson_id)
            ->where('passed', true)
            ->exists();

        // Cari attempt aktif (belum selesai, timer belum habis)
        $attempt = UserQuizResult::where('user_id', $userId)
            ->where('lesson_id', $lesson_id)
            ->whereNull('score') // score null = belum di-submit
            ->latest()
            ->first();

        // Jika tidak ada attempt aktif, buat yang baru
        if (!$attempt) {
            $lastAttempt = UserQuizResult::where('user_id', $userId)
                ->where('lesson_id', $lesson_id)
                ->max('attempt_number');

            $attempt = UserQuizResult::create([
                'user_id'        => $userId,
                'lesson_id'      => $lesson_id,
                'started_at'     => now(),
                'attempt_number' => ($lastAttempt ?? 0) + 1,
                'score'          => null,
                'passed'         => false,
            ]);
        }

        // Hitung sisa waktu
        $timeLimitSeconds = ($lesson->time_limit_minutes ?? 30) * 60;
        $elapsedSeconds   = now()->diffInSeconds($attempt->started_at);
        $remainingSeconds = max(0, $timeLimitSeconds - $elapsedSeconds);

        // Jika waktu habis, auto-submit dengan score seadanya
        if ($remainingSeconds <= 0 && is_null($attempt->score) ) {
            $attempt->update(['score' => 0, 'passed' => false]);
            return redirect()->route('course.learn', [$course_id, $lesson_id])
                ->with('quiz_score', 0)
                ->with('quiz_passed', false)
                ->with('quiz_timeout', true);
        }

        // Riwayat attempt sebelumnya
        $history = UserQuizResult::where('user_id', $userId)
            ->where('lesson_id', $lesson_id)
            ->whereNotNull('score')
            ->orderByDesc('attempt_number')
            ->get();

        return view('pages.exam', compact(
            'course', 'lesson', 'attempt', 'remainingSeconds', 'history', 'existingPassed'
        ));
    }

    public function submit(Request $request, $course_id, $lesson_id)
    {
        $userId  = auth()->id();
        $lesson  = Lesson::with('questions.options')->findOrFail($lesson_id);
        $attempt = UserQuizResult::where('user_id', $userId)
            ->where('lesson_id', $lesson_id)
            ->whereNull('score')
            ->latest()
            ->first();

        if (!$attempt) {
            return redirect()->route('course.learn', [$course_id, $lesson_id]);
        }

        // Hitung skor
        $answers      = $request->input('answers', []);
        $totalPoints  = 0;
        $earnedPoints = 0;

        foreach ($lesson->questions as $question) {
            $totalPoints    += $question->points;
            $selectedId      = $answers[$question->id] ?? null;
            if ($selectedId) {
                $option = $question->options->firstWhere('id', $selectedId);
                if ($option && $option->is_correct) {
                    $earnedPoints += $question->points;
                }
            }
        }

        $score  = $totalPoints > 0 ? (int) ceil(($earnedPoints / $totalPoints) * 100) : 0;
        $passed = $score >= 75;

        $attempt->update(['score' => $score, 'passed' => $passed]);

        // Jika lulus → otomatis complete lesson
        if ($passed) {
            $user = \App\Models\User::find($userId);
            $user->completedLessons()->syncWithoutDetaching([$lesson_id]);

            $course      = Course::with(['modules.lessons'])->findOrFail($course_id);
            $enrollment  = Enrollment::where('user_id', $userId)->where('course_id', $course_id)->first();

            if ($enrollment) {
                $allLessons        = $course->modules->flatMap->lessons->values();
                $courseLessonIds   = $allLessons->pluck('id')->toArray();
                $completedCount    = $user->completedLessons()->whereIn('lesson_id', $courseLessonIds)->count();
                $totalLessons      = count($courseLessonIds) ?: 1;
                $newProgress       = (int) ceil(($completedCount / $totalLessons) * 100);

                $enrollment->update([
                    'last_accessed_at' => now(),
                    'status'           => $newProgress >= 100 ? 'completed' : 'active',
                ]);
            }
        }

        return redirect()->route('course.learn', [$course_id, $lesson_id])
            ->with('quiz_score', $score)
            ->with('quiz_passed', $passed);
    }
}
