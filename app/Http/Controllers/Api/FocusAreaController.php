<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FocusArea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FocusAreaController extends Controller
{
    public function index()
    {
        $focusAreas = Auth::user()->focusAreas()->orderBy('order')->get();
        return response()->json($focusAreas);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'color' => 'nullable|string',
        ]);

        $focusArea = Auth::user()->focusAreas()->create($validated);
        return response()->json($focusArea, 201);
    }

    public function show(FocusArea $focusArea)
    {
        $this->authorize('view', $focusArea);
        return response()->json($focusArea);
    }

    public function update(Request $request, FocusArea $focusArea)
    {
        $this->authorize('update', $focusArea);

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'color' => 'nullable|string',
            'order' => 'sometimes|integer',
        ]);

        $focusArea->update($validated);
        return response()->json($focusArea);
    }

    public function destroy(FocusArea $focusArea)
    {
        $this->authorize('delete', $focusArea);
        $focusArea->delete();
        return response()->json(null, 204);
    }

    public function reorder(Request $request)
    {
        $request->validate([
            'focusAreas' => 'required|array',
            'focusAreas.*.id' => 'required|exists:focus_areas,id',
            'focusAreas.*.order' => 'required|integer',
        ]);

        foreach ($request->focusAreas as $focusArea) {
            Auth::user()->focusAreas()
                ->where('id', $focusArea['id'])
                ->update(['order' => $focusArea['order']]);
        }

        return response()->json(['message' => 'Focus areas reordered successfully']);
    }
} 