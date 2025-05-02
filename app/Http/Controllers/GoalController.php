<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use App\Models\User; // Explicitly import User model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class GoalController extends Controller
{
    public function index()
    {
        $goals = Auth::user()->goals()->get();
        Log::info('Goals index accessed by user ID ' . Auth::id() . ': ' . $goals->toJson());
        return view('goals.index', compact('goals'));
    }

    public function create()
    {
        Log::info('Goal creation form accessed by user ID ' . Auth::id());
        return view('goals.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required|string|in:running,english_b2,trading',
            'description' => 'required|string|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'progress' => 'nullable|integer|min:0|max:100',
            'deadline' => 'nullable|date',
            'visibility' => 'required|string|in:public,friends,private',
            'status' => 'required|string|in:not_started,in_progress,completed',
            'current_level' => 'nullable|string',
            'target_level' => 'nullable|string',
            'start_date' => 'required|date',
            'last_activity_at' => 'nullable|date',
        ]);

        $goal = new Goal($validated);
        $goal->user_id = Auth::id();
        $goal->last_activity_at = now();
        $goal->save();

        Log::info('Goal created by user ID ' . Auth::id() . ': ' . $goal->toJson());

        return redirect()->route('dashboard')->with('success', 'Goal created successfully!');
    }

    public function show($category)
    {
        $goal = Auth::user()->goals()
            ->where('category', $category)
            ->orderBy('updated_at', 'desc')
            ->firstOrFail();

        Log::info('Goal fetched for show (category: ' . $category . ') for user ID ' . Auth::id() . ': ' . $goal->toJson());

        if ($category === 'english_b2') {
            return view('goals.english_b2', compact('goal'));
        }

        return view('goals.show', compact('goal'));
    }

    public function edit($category)
    {
        $goal = Auth::user()->goals()
            ->where('category', $category)
            ->orderBy('updated_at', 'desc')
            ->firstOrFail();

        Log::info('Goal fetched for edit (category: ' . $category . ') for user ID ' . Auth::id() . ': ' . $goal->toJson());

        return view('goals.edit', compact('goal'));
    }

    public function update(Request $request, $category)
    {
        $goal = Auth::user()->goals()
            ->where('category', $category)
            ->orderBy('updated_at', 'desc')
            ->firstOrFail();

        $validated = $request->validate([
            'description' => 'required|string|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'progress' => 'nullable|integer|min:0|max:100',
            'deadline' => 'nullable|date',
            'visibility' => 'required|string|in:public,friends,private',
            'status' => 'required|string|in:not_started,in_progress,completed',
            'current_level' => 'nullable|string',
            'target_level' => 'nullable|string',
            'start_date' => 'required|date',
            'last_activity_at' => 'nullable|date',
        ]);

        $goal->update($validated);
        $goal->last_activity_at = now();
        $goal->save();

        Log::info('Goal updated by user ID ' . Auth::id() . ': ' . $goal->toJson());

        return redirect()->route('goals.show', $category)->with('success', 'Goal updated successfully!');
    }

    public function destroy($category)
    {
        $goal = Auth::user()->goals()
            ->where('category', $category)
            ->orderBy('updated_at', 'desc')
            ->firstOrFail();

        $goal->delete();

        Log::info('Goal deleted by user ID ' . Auth::id() . ': ' . $goal->toJson());

        return redirect()->route('dashboard')->with('success', 'Goal deleted successfully!');
    }
}