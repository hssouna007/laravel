<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'due_date',
        'priority',
        'status',
        'focus_area_id',
        'user_id',
        'order',
    ];

    protected $casts = [
        'due_date' => 'datetime',
        'order' => 'integer',
    ];

    public function focusArea(): BelongsTo
    {
        return $this->belongsTo(FocusArea::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
} 