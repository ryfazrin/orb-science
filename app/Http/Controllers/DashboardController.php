<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Fake login as the Demo Student created in seeder for demonstration purposes
        // Since we don't have full Auth scaffolded yet.
        $user = User::where('email', 'student@ilmukomputer.com')->first();
        
        if (!$user) {
            abort(404, 'Run migrations and seeders first.');
        }

        $enrollments = $user->enrollments()->with('course')->get();

        return view('pages.dashboard', compact('user', 'enrollments'));
    }
}
