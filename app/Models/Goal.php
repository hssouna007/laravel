<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    use HasFactory;

    protected $fillable = [
        'category',
        'description',
        'latitude',
        'longitude',
        'progress',
        'deadline',
        'visibility',
        'status',
        'current_level',
        'target_level',
        'start_date',
        'last_activity_at',
    ];

    protected $casts = [
        'progress' => 'integer',
        'deadline' => 'date',
        'start_date' => 'date',
        'last_activity_at' => 'datetime',
        'latitude' => 'decimal:6',
        'longitude' => 'decimal:6'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function tests()
    {
        return $this->hasMany(Test::class);
    }

    public function achievements()
    {
        return $this->hasMany(Achievement::class);
    }

    public function updateProgress()
    {
        $totalTasks = $this->tasks()->count();
        $completedTasks = $this->tasks()->where('status', 'completed')->count();
        
        if ($totalTasks > 0) {
            $this->progress = round(($completedTasks / $totalTasks) * 100);
            $this->save();
        }
    }

    /**
     * Get the users that belong to the goal.
     */
    public function users()
    {
        return $this->belongsToMany(User::class)
            ->withPivot('status', 'progress', 'current_level', 'start_date', 'last_activity_at')
            ->withTimestamps();
    }
} 