<?php

use Illuminate\Support\Facades\Route;
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

// Course Details & Checkout
Route::get('/course/{id}', [CourseController::class, 'show']);
Route::get('/checkout/{id}', [CheckoutController::class, 'show']);
Route::post('/checkout/{id}/process', [CheckoutController::class, 'process']);

// Learning Experience (The Lesson Player Workspace)
Route::get('/course/{course_id}/learn/{lesson_id}', [LearningController::class, 'show']);
Route::post('/course/{course_id}/learn/{lesson_id}/complete', [LearningController::class, 'complete']);

// Dashboard (Protected later, conceptually)
Route::get('/dashboard', [DashboardController::class, 'index']);

// Auth Views (Dummy for now)
Route::get('/login', function () { return view('pages.login'); });
Route::get('/register', function () { return view('pages.register'); });
Route::get('/forgot-password', function () { return view('pages.forgot-password'); });

Route::get('/profile', function () { return view('pages.profile'); });
