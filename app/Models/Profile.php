<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'full_name',
        'role_badge',
        'headline',
        'bio',
        'avatar_path',
        'cv_pdf_path',
        'cv_version_label',
        'is_open_to_work',
        'is_freelance_available',
        'freelance_period_text',
        'location_base',
    ];

    protected $casts = [
        'is_open_to_work' => 'boolean',
        'is_freelance_available' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
