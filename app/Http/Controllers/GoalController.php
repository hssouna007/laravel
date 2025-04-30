<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GoalController extends Controller
{
    public function index()
    {
        $goals = Auth::user()->goals;
        return view('goals.index', compact('goals'));
    }

    public function create()
    {
        return view('goals.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required|in:running,english_b2,trading',
            'description' => 'required|string|max:1000',
            'deadline' => 'nullable|date',
            'visibility' => 'required|in:private,friends,public',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        $goal = Auth::user()->goals()->create([
            'category' => $validated['category'],
            'description' => $validated['description'],
            'deadline' => $validated['deadline'],
            'visibility' => $validated['visibility'],
            'latitude' => $validated['latitude'],
            'longitude' => $validated['longitude'],
            'status' => 'not_started',
            'progress' => 0,
        ]);

        return redirect()->route('goals.show', $goal->category)
            ->with('success', 'Goal created successfully!');
    }

    public function show($category)
    {
        $goal = Auth::user()->goals()->where('category', $category)->firstOrFail();
        
        if ($category === 'english_b2') {
            return view('goals.english_b2', compact('goal'));
        }
        
        return view('goals.show', compact('goal'));
    }

    public function edit($category)
    {
        $goal = Auth::user()->goals()->where('category', $category)->firstOrFail();
        return view('goals.edit', compact('goal'));
    }

    public function update(Request $request, $category)
    {
        $goal = Auth::user()->goals()->where('category', $category)->firstOrFail();

        $validated = $request->validate([
            'description' => 'required|string|max:1000',
            'deadline' => 'nullable|date',
            'visibility' => 'required|in:private,friends,public',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'status' => 'required|in:not_started,in_progress,completed,paused',
            'progress' => 'required|integer|min:0|max:100',
        ]);

        $goal->update($validated);

        return redirect()->route('goals.show', $goal->category)
            ->with('success', 'Goal updated successfully!');
    }

    public function destroy($category)
    {
        $goal = Auth::user()->goals()->where('category', $category)->firstOrFail();
        $goal->delete();

        return redirect()->route('dashboard')
            ->with('success', 'Goal deleted successfully!');
    }
} 