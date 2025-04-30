<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProgressLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'focus_area_id',
        'user_id',
        'content',
        'progress',
        'mood',
        'images',
    ];

    protected $casts = [
        'progress' => 'integer',
        'images' => 'array',
    ];

    public function focusArea(): BelongsTo
    {
        return $this->belongsTo(FocusArea::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
} 