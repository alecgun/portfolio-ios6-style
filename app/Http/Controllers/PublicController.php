<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Skill;
use App\Models\Project;
use App\Models\Experience;
use App\Models\NotesSection;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PublicController extends Controller
{
    public function index()
    {
        $profile = Profile::first();
        $skills = Skill::where('is_active', true)->orderBy('sort_order')->get();
        $projects = Project::where('is_published', true)->orderBy('sort_order')->get();
        $experiences = Experience::orderBy('sort_order')->get();
        $notes = NotesSection::first();

        return view('public.index', compact('profile', 'skills', 'projects', 'experiences', 'notes'));
    }

    public function submitContact(Request $request)
    {
        $validated = $request->validate([
            'sender_name' => 'required|string|max:100',
            'sender_email' => 'required|email|max:150',
            'message' => 'required|string|max:2000',
        ]);

        $message = ContactMessage::create([
            'sender_name' => $validated['sender_name'],
            'sender_email' => $validated['sender_email'],
            'message' => $validated['message'],
            'ip_address' => $request->ip(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pesan Anda telah berhasil dikirim! Saya akan segera menghubungi Anda.',
        ]);
    }

    public function downloadCv()
    {
        $profile = Profile::first();

        if ($profile && $profile->cv_pdf_path && Storage::disk('public')->exists($profile->cv_pdf_path)) {
            $path = Storage::disk('public')->path($profile->cv_pdf_path);
            $fileName = 'CV_' . str_replace(' ', '_', $profile->full_name) . '.pdf';
            return response()->download($path, $fileName);
        }

        // Return a friendly fallback note if not uploaded yet
        return response()->streamDownload(function () use ($profile) {
            echo "%PDF-1.4\n%Fallback CV Document for " . ($profile->full_name ?? 'Developer') . "\nSilakan unggah dokumen CV PDF melalui dashboard admin.";
        }, 'CV_' . ($profile ? str_replace(' ', '_', $profile->full_name) : 'Developer') . '.pdf', [
            'Content-Type' => 'application/pdf',
        ]);
    }
}
