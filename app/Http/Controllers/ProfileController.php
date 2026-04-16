<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Enrollment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Tampilkan halaman profil pengguna di frontend
     */
    public function show(Request $request): View
    {
        $user        = $request->user();
        $enrollments = Enrollment::with('course')
            ->where('user_id', $user->id)
            ->where('status', 'completed')
            ->latest('updated_at')
            ->get();

        return view('pages.profile', compact('user', 'enrollments'));
    }

    /**
     * Update informasi profil (nama, email, bio)
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.show')->with('status', 'profile-updated');
    }

    /**
     * Upload foto profil
     */
    public function updateAvatar(Request $request): RedirectResponse
    {
        $request->validate([
            'avatar' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $user = $request->user();

        // Hapus avatar lama jika ada
        if ($user->avatar_url && Storage::disk('public')->exists($user->avatar_url)) {
            Storage::disk('public')->delete($user->avatar_url);
        }

        $path = $request->file('avatar')->store('avatars', 'public');
        $user->update(['avatar_url' => $path]);

        return Redirect::route('profile.show')->with('status', 'avatar-updated');
    }

    /**
     * Generate dan download sertifikat PDF untuk kursus yang diselesaikan
     */
    public function certificate(Request $request, $course_id): \Symfony\Component\HttpFoundation\Response
    {
        $user       = $request->user();
        $enrollment = Enrollment::with('course')
            ->where('user_id', $user->id)
            ->where('course_id', $course_id)
            ->where('status', 'completed')
            ->firstOrFail();

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.certificate', [
            'user'       => $user,
            'course'     => $enrollment->course,
            'enrollment' => $enrollment,
        ])->setPaper('a4', 'landscape');

        $filename = 'Sertifikat_' . str_replace(' ', '_', $enrollment->course->title) . '.pdf';

        return $pdf->download($filename);
    }

    /**
     * Display the user's profile form (Breeze default — kept for compatibility)
     */
    public function edit(Request $request): View
    {
        return $this->show($request);
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
