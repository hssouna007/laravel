<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class Goal extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category',
        'description',
        'deadline',
        'visibility',
        'latitude',
        'longitude',
        'status',
        'progress',
        'current_level',
        'target_level',
        'start_date',
        'last_activity_at',
    ];

    protected $casts = [
        'category' => 'string',
        'visibility' => 'string',
        'status' => 'string',
        'deadline' => 'date',
        'start_date' => 'date',
        'last_activity_at' => 'datetime',
        'latitude' => 'decimal:6',
        'longitude' => 'decimal:6',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function focusAreas()
    {
        return $this->hasMany(FocusArea::class);
    }
    public function show($category)
{
      
}}