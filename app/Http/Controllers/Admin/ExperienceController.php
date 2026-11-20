<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    public function index()
    {
        $experiences = Experience::orderBy('sort_order')->get();
        return view('admin.experiences.index', compact('experiences'));
    }

    public function create()
    {
        return view('admin.experiences.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'role_title' => 'required|string|max:150',
            'company_name' => 'required|string|max:150',
            'period' => 'required|string|max:100',
            'summary' => 'nullable|string',
            'sort_order' => 'nullable|integer',
        ]);

        Experience::create([
            'role_title' => $validated['role_title'],
            'company_name' => $validated['company_name'],
            'period' => $validated['period'],
            'summary' => $validated['summary'] ?? null,
            'sort_order' => $validated['sort_order'] ?? 0,
        ]);

        return redirect()->route('admin.experiences.index')->with('success', 'Riwayat pengalaman berhasil ditambahkan!');
    }

    public function edit(Experience $experience)
    {
        return view('admin.experiences.edit', compact('experience'));
    }

    public function update(Request $request, Experience $experience)
    {
        $validated = $request->validate([
            'role_title' => 'required|string|max:150',
            'company_name' => 'required|string|max:150',
            'period' => 'required|string|max:100',
            'summary' => 'nullable|string',
            'sort_order' => 'nullable|integer',
        ]);

        $experience->update([
            'role_title' => $validated['role_title'],
            'company_name' => $validated['company_name'],
            'period' => $validated['period'],
            'summary' => $validated['summary'] ?? null,
            'sort_order' => $validated['sort_order'] ?? 0,
        ]);

        return redirect()->route('admin.experiences.index')->with('success', 'Riwayat pengalaman berhasil diperbarui!');
    }

    public function destroy(Experience $experience)
    {
        $experience->delete();
        return redirect()->route('admin.experiences.index')->with('success', 'Riwayat pengalaman berhasil dihapus!');
    }
}
