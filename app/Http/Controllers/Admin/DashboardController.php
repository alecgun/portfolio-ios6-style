<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Skill;
use App\Models\ContactMessage;

class DashboardController extends Controller
{
    public function index()
    {
        $profile = Profile::first();
        $totalProjects = Project::count();
        $totalSkills = Skill::count();
        $totalMessages = ContactMessage::count();
        $unreadMessages = ContactMessage::where('is_read', false)->count();
        $recentMessages = ContactMessage::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'profile',
            'totalProjects',
            'totalSkills',
            'totalMessages',
            'unreadMessages',
            'recentMessages'
        ));
    }
}
