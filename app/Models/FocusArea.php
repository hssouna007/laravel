<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FocusArea extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'color',
        'user_id',
        'order',
        'latitude',
        'longitude',
        'progress',
        'visibility',
        'start_date',
        'end_date',
        'is_template',
    ];

    protected $casts = [
        'order' => 'integer',
        'progress' => 'integer',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'is_template' => 'boolean',
    ];

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function milestones(): HasMany
    {
        return $this->hasMany(Milestone::class);
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(Attachment::class);
    }

    public function logs(): HasMany
    {
        return $this->hasMany(ProgressLog::class);
    }

    public function sharedWith()
    {
        return $this->belongsToMany(User::class, 'focus_area_shares')
            ->withPivot('permission')
            ->withTimestamps();
    }

    public function calculateProgress()
    {
        $totalTasks = $this->tasks()->count();
        if ($totalTasks === 0) {
            return 0;
        }

        $completedTasks = $this->tasks()->where('status', 'completed')->count();
        return round(($completedTasks / $totalTasks) * 100);
    }
} 