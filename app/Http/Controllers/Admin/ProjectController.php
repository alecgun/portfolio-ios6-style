<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::orderBy('sort_order')->latest()->paginate(10);
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:150',
            'category' => 'required|in:app,web,other',
            'category_badge' => 'required|string|max:50',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
            'short_description' => 'required|string|max:250',
            'full_description' => 'nullable|string',
            'tech_stack' => 'required|string|max:150',
            'project_url' => 'nullable|url|max:255',
            'github_url' => 'nullable|url|max:255',
            'sort_order' => 'nullable|integer',
            'is_published' => 'nullable|boolean',
        ]);

        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('projects', 'public');
        }

        $baseSlug = Str::slug($validated['title']);
        $slug = $baseSlug;
        $count = 1;
        while (Project::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $count++;
        }

        Project::create([
            'title' => $validated['title'],
            'slug' => $slug,
            'category' => $validated['category'],
            'category_badge' => $validated['category_badge'],
            'thumbnail_path' => $thumbnailPath,
            'short_description' => $validated['short_description'],
            'full_description' => $validated['full_description'] ?? null,
            'tech_stack' => $validated['tech_stack'],
            'project_url' => $validated['project_url'] ?? null,
            'github_url' => $validated['github_url'] ?? null,
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_published' => $request->boolean('is_published', true),
        ]);

        return redirect()->route('admin.projects.index')->with('success', 'Proyek berhasil ditambahkan!');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:150',
            'category' => 'required|in:app,web,other',
            'category_badge' => 'required|string|max:50',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
            'short_description' => 'required|string|max:250',
            'full_description' => 'nullable|string',
            'tech_stack' => 'required|string|max:150',
            'project_url' => 'nullable|url|max:255',
            'github_url' => 'nullable|url|max:255',
            'sort_order' => 'nullable|integer',
            'is_published' => 'nullable|boolean',
        ]);

        if ($request->hasFile('thumbnail')) {
            if ($project->thumbnail_path && !str_starts_with($project->thumbnail_path, 'http') && Storage::disk('public')->exists($project->thumbnail_path)) {
                Storage::disk('public')->delete($project->thumbnail_path);
            }
            $project->thumbnail_path = $request->file('thumbnail')->store('projects', 'public');
        }

        $project->title = $validated['title'];
        $project->category = $validated['category'];
        $project->category_badge = $validated['category_badge'];
        $project->short_description = $validated['short_description'];
        $project->full_description = $validated['full_description'] ?? null;
        $project->tech_stack = $validated['tech_stack'];
        $project->project_url = $validated['project_url'] ?? null;
        $project->github_url = $validated['github_url'] ?? null;
        $project->sort_order = $validated['sort_order'] ?? 0;
        $project->is_published = $request->boolean('is_published');
        $project->save();

        return redirect()->route('admin.projects.index')->with('success', 'Proyek berhasil diperbarui!');
    }

    public function destroy(Project $project)
    {
        if ($project->thumbnail_path && !str_starts_with($project->thumbnail_path, 'http') && Storage::disk('public')->exists($project->thumbnail_path)) {
            Storage::disk('public')->delete($project->thumbnail_path);
        }

        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', 'Proyek berhasil dihapus!');
    }
}
