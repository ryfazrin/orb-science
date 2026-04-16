<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LearningController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CheckoutController;

// Public Pages
Route::get('/', [PublicController::class, 'index']);
Route::get('/catalog', [PublicController::class, 'catalog']);
Route::get('/pathway', [PublicController::class, 'pathway']);
Route::get('/article/{id?}', [PublicController::class, 'article']);
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
});

// Profile Routes provided by Breeze
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Auth Scaffolding routes from Breeze
require __DIR__.'/auth.php';
