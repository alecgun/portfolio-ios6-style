<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NotesSection;
use Illuminate\Http\Request;

class NotesController extends Controller
{
    public function edit()
    {
        $notes = NotesSection::firstOrCreate(['id' => 1], [
            'header_title' => 'Catatan Karier & Filosofi',
            'date_label' => date('d M Y'),
            'main_heading' => 'Mengapa Detail Kecil Sangat Berarti?',
            'content' => 'Tuliskan filosofi desain dan pendekatan kerja Anda di sini...',
        ]);

        return view('admin.notes.edit', compact('notes'));
    }

    public function update(Request $request)
    {
        $notes = NotesSection::firstOrFail();

        $validated = $request->validate([
            'header_title' => 'required|string|max:150',
            'date_label' => 'required|string|max:50',
            'main_heading' => 'required|string|max:200',
            'content' => 'required|string',
        ]);

        $notes->update($validated);

        return redirect()->route('admin.notes.edit')->with('success', 'Catatan filosofi berhasil diperbarui!');
    }
}
