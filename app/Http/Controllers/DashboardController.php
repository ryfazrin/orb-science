<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        $user = User::findOrFail($userId);

        $enrollments = $user->enrollments()->with('course')->get();

        return view('pages.dashboard', compact('user', 'enrollments'));
    }
}
