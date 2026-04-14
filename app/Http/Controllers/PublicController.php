<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index()
    {
        return view('pages.landing');
    }

    public function catalog()
    {
        // Fetch published/active courses. We'll paginate them.
        $courses = Course::with('instructor.user')->paginate(12);
        
        return view('pages.catalog', compact('courses'));
    }

    public function pathway()
    {
        return view('pages.pathway');
    }

    public function article()
    {
        return view('pages.article');
    }

    public function about()
    {
        return view('pages.about');
    }

    public function support()
    {
        return view('pages.support');
    }

    public function pricing()
    {
        return view('pages.pricing');
    }
}
