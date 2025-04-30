<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GoalRoadmapController;
use App\Http\Controllers\GoalController;

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Goals Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/goals', [GoalController::class, 'index'])->name('goals.index');
    Route::get('/goals/create', [GoalController::class, 'create'])->name('goals.create');
    Route::post('/goals', [GoalController::class, 'store'])->name('goals.store');
    Route::get('/goals/{category}', [GoalController::class, 'show'])->name('goals.show');
    Route::get('/goals/{category}/edit', [GoalController::class, 'edit'])->name('goals.edit');
    Route::put('/goals/{category}', [GoalController::class, 'update'])->name('goals.update');
    Route::delete('/goals/{category}', [GoalController::class, 'destroy'])->name('goals.destroy');
    Route::get('/goals/{category}/roadmap', [GoalRoadmapController::class, 'show'])->name('goals.roadmap');
});

require __DIR__.'/auth.php';
