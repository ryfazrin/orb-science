<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\User;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function show($id)
    {
        $course = Course::findOrFail($id);
        
        // Cek jika user sudah terdaftar di course ini
        $userId = auth()->id();
        $alreadyEnrolled = Enrollment::where('user_id', $userId)
            ->where('course_id', $id)
            ->exists();

        if ($alreadyEnrolled) {
            return redirect('/dashboard')->with('message', 'You are already enrolled in this course.');
        }

        return view('pages.checkout', compact('course'));
    }

    public function process(Request $request, $id)
    {
        $course = Course::findOrFail($id);
        
        $userId = auth()->id();
        
        Enrollment::create([
            'user_id' => $userId,
            'course_id' => $course->id,
            'status' => 'active',
        ]);

        return redirect('/dashboard')->with('success', 'Payment successful! Welcome to the course.');
    }
}
