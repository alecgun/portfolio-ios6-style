<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        $profile = Profile::firstOrCreate([
            'user_id' => auth()->id()
        ], [
            'full_name' => auth()->user()->name ?? 'Developer',
            'role_badge' => 'Product Designer & Frontend Engineer',
            'headline' => 'Halo, Saya ' . (auth()->user()->name ?? 'Developer'),
            'bio' => 'Deskripsi profil Anda...',
            'cv_version_label' => 'v6.1.3',
            'is_open_to_work' => true,
            'is_freelance_available' => true,
            'freelance_period_text' => 'Tersedia untuk Q4 2026',
            'location_base' => 'Indonesia',
        ]);

        return view('admin.profile.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $profile = Profile::firstOrFail();

        $validated = $request->validate([
            'full_name' => 'required|string|max:100',
            'role_badge' => 'required|string|max:150',
            'headline' => 'required|string|max:150',
            'bio' => 'required|string',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'cv_pdf' => 'nullable|file|mimes:pdf|max:10240',
            'cv_version_label' => 'required|string|max:20',
            'is_open_to_work' => 'nullable|boolean',
            'is_freelance_available' => 'nullable|boolean',
            'freelance_period_text' => 'required|string|max:100',
            'location_base' => 'required|string|max:150',
        ]);

        if ($request->hasFile('avatar')) {
            if ($profile->avatar_path && !str_starts_with($profile->avatar_path, 'http') && Storage::disk('public')->exists($profile->avatar_path)) {
                Storage::disk('public')->delete($profile->avatar_path);
            }
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $profile->avatar_path = $avatarPath;
        }

        if ($request->hasFile('cv_pdf')) {
            if ($profile->cv_pdf_path && Storage::disk('public')->exists($profile->cv_pdf_path)) {
                Storage::disk('public')->delete($profile->cv_pdf_path);
            }
            $cvPath = $request->file('cv_pdf')->store('resumes', 'public');
            $profile->cv_pdf_path = $cvPath;
        }

        $profile->full_name = $validated['full_name'];
        $profile->role_badge = $validated['role_badge'];
        $profile->headline = $validated['headline'];
        $profile->bio = $validated['bio'];
        $profile->cv_version_label = $validated['cv_version_label'];
        $profile->is_open_to_work = $request->boolean('is_open_to_work');
        $profile->is_freelance_available = $request->boolean('is_freelance_available');
        $profile->freelance_period_text = $validated['freelance_period_text'];
        $profile->location_base = $validated['location_base'];
        $profile->save();

        return redirect()->route('admin.profile.edit')->with('success', 'Profil berhasil diperbarui!');
    }

    public function toggleAvailability()
    {
        $profile = Profile::firstOrFail();
        $profile->is_freelance_available = !$profile->is_freelance_available;
        $profile->save();

        return response()->json([
            'success' => true,
            'is_available' => $profile->is_freelance_available,
        ]);
    }
}
