<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function index()
    {
        $skills = Skill::orderBy('sort_order')->get();
        return view('admin.skills.index', compact('skills'));
    }

    public function create()
    {
        return view('admin.skills.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'required|string|max:250',
            'icon_class' => 'required|string|max:100',
            'bg_gradient' => 'required|in:sky-blue,amber-orange,lime-green,fuchsia-purple,slate-gray,rose-red',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        Skill::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'icon_class' => $validated['icon_class'],
            'bg_gradient' => $validated['bg_gradient'],
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.skills.index')->with('success', 'Keahlian baru berhasil ditambahkan!');
    }

    public function edit(Skill $skill)
    {
        return view('admin.skills.edit', compact('skill'));
    }

    public function update(Request $request, Skill $skill)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'required|string|max:250',
            'icon_class' => 'required|string|max:100',
            'bg_gradient' => 'required|in:sky-blue,amber-orange,lime-green,fuchsia-purple,slate-gray,rose-red',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $skill->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'icon_class' => $validated['icon_class'],
            'bg_gradient' => $validated['bg_gradient'],
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.skills.index')->with('success', 'Keahlian berhasil diperbarui!');
    }

    public function destroy(Skill $skill)
    {
        $skill->delete();
        return redirect()->route('admin.skills.index')->with('success', 'Keahlian berhasil dihapus!');
    }
}
