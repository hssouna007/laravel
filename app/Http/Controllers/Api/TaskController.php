<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $query = Auth::user()->tasks()->with('focusArea');

        if ($request->has('focus_area_id')) {
            $query->where('focus_area_id', $request->focus_area_id);
        }

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $tasks = $query->orderBy('order')->get();
        return response()->json($tasks);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'priority' => 'required|in:low,medium,high',
            'focus_area_id' => 'required|exists:focus_areas,id',
        ]);

        $task = Auth::user()->tasks()->create($validated);
        return response()->json($task, 201);
    }

    public function show(Task $task)
    {
        $this->authorize('view', $task);
        return response()->json($task->load('focusArea'));
    }

    public function update(Request $request, Task $task)
    {
        $this->authorize('update', $task);

        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'priority' => 'sometimes|in:low,medium,high',
            'status' => 'sometimes|in:todo,in_progress,completed',
            'focus_area_id' => 'sometimes|exists:focus_areas,id',
            'order' => 'sometimes|integer',
        ]);

        $task->update($validated);
        return response()->json($task->load('focusArea'));
    }

    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);
        $task->delete();
        return response()->json(null, 204);
    }

    public function reorder(Request $request)
    {
        $request->validate([
            'tasks' => 'required|array',
            'tasks.*.id' => 'required|exists:tasks,id',
            'tasks.*.order' => 'required|integer',
        ]);

        foreach ($request->tasks as $task) {
            Auth::user()->tasks()
                ->where('id', $task['id'])
                ->update(['order' => $task['order']]);
        }

        return response()->json(['message' => 'Tasks reordered successfully']);
    }
} 