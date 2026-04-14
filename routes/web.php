<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.landing');
});

Route::get('/dashboard', function () {
    return view('pages.dashboard');
});

Route::get('/catalog', function () {
    return view('pages.catalog');
});

Route::get('/course/{id}', function ($id) {
    return view('pages.course-detail');
});

Route::get('/course/{course_id}/learn/{lesson_id}', function ($course_id, $lesson_id) {
    return view('pages.lesson');
});

Route::get('/pathway', function () {
    return view('pages.pathway');
});

Route::get('/article/{id?}', function () {
    return view('pages.article');
});

Route::get('/about', function () {
    return view('pages.about');
});

Route::get('/support', function () {
    return view('pages.support');
});

Route::get('/pricing', function () {
    return view('pages.pricing');
});

Route::get('/login', function () {
    return view('pages.login');
});

Route::get('/register', function () {
    return view('pages.register');
});

Route::get('/forgot-password', function () {
    return view('pages.forgot-password');
});

Route::get('/profile', function () {
    return view('pages.profile');
});
