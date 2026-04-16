<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LearningController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\PathwayController;
use App\Http\Controllers\ArticleController;

// Public Pages
Route::get('/', [PublicController::class, 'index']);
Route::get('/catalog', [PublicController::class, 'catalog']);
Route::get('/pathway', [PathwayController::class, 'index']);
Route::get('/pathway/{slug}', [PathwayController::class, 'show']);
Route::get('/article', [ArticleController::class, 'index']);
Route::get('/article/{slug}', [ArticleController::class, 'show']);
Route::get('/about', [PublicController::class, 'about']);
Route::get('/support', [PublicController::class, 'support']);
Route::get('/pricing', [PublicController::class, 'pricing']);

// Course Details
Route::get('/course/{id}', [CourseController::class, 'show']);

// Protected LMS Routes
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Checkout Process
    Route::get('/checkout/{id}', [CheckoutController::class, 'show'])->name('checkout.show');
    Route::post('/checkout/{id}/process', [CheckoutController::class, 'process'])->name('checkout.process');
    
    // Learning Experience (The Lesson Player Workspace)
    Route::get('/course/{course_id}/learn/{lesson_id}', [LearningController::class, 'show'])->name('course.learn');
    Route::post('/course/{course_id}/learn/{lesson_id}/complete', [LearningController::class, 'complete'])->name('course.lesson.complete');
    Route::post('/course/{course_id}/learn/{lesson_id}/quiz', [LearningController::class, 'submitQuiz'])->name('course.lesson.quiz.submit');

    // Exam / Quiz Standalone Page
    Route::get('/course/{course_id}/exam/{lesson_id}', [ExamController::class, 'show'])->name('course.exam.show');
    Route::post('/course/{course_id}/exam/{lesson_id}/submit', [ExamController::class, 'submit'])->name('course.exam.submit');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.avatar');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/course/{id}/certificate', [ProfileController::class, 'certificate'])->name('course.certificate');
});

// Auth Scaffolding routes from Breeze
require __DIR__.'/auth.php';
