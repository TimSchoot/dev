<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lesson extends Model
{
    protected $fillable = [
        'language_id',
        'title',
        'description',
        'content',
        'icon',
        'lesson_order'
    ];

    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }
}