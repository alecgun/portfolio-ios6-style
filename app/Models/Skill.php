<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'icon_class',
        'bg_gradient',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    // Helper for gradient CSS classes
    public function getGradientClassesAttribute()
    {
        return match ($this->bg_gradient) {
            'amber-orange' => 'from-amber-300 via-orange-500 to-red-600',
            'lime-green' => 'from-lime-300 via-green-500 to-emerald-700',
            'fuchsia-purple' => 'from-fuchsia-400 via-purple-600 to-indigo-800',
            'slate-gray' => 'from-slate-400 via-slate-600 to-slate-800',
            'rose-red' => 'from-rose-400 via-red-500 to-rose-800',
            default => 'from-sky-300 via-blue-500 to-blue-700', // sky-blue
        };
    }
}
