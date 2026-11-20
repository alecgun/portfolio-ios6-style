<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotesSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'header_title',
        'date_label',
        'main_heading',
        'content',
    ];
}
