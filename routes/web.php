<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GoalRoadmapController;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [UserController::class, 'profile'])->name('profile.show');
    Route::get('/profile/edit', [UserController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [UserController::class, 'update'])->name('profile.update');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit'); // Remove or adjust to avoid conflict
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update'); // Remove or adjust
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy'); // Remove if not needed

    // Goals Routes
    Route::get('/goals', [GoalController::class, 'index'])->name('goals.index');
    Route::get('/goals/create', [GoalController::class, 'create'])->name('goals.create');
    Route::post('/goals', [GoalController::class, 'store'])->name('goals.store');
    Route::get('/goals/{category}', [GoalController::class, 'show'])->name('goals.show');
    Route::get('/goals/{category}/edit', [GoalController::class, 'edit'])->name('goals.edit');
    Route::put('/goals/{category}', [GoalController::class, 'update'])->name('goals.update');
    Route::delete('/goals/{category}', [GoalController::class, 'destroy'])->name('goals.destroy');
    Route::get('/goals/{category}/roadmap', [GoalRoadmapController::class, 'show'])->name('goals.roadmap');

    // New route for running roadmap
    Route::get('/goals/running', function () {
        return view('running');
    })->name('running.roadmap')->middleware('auth');
});

require __DIR__.'/auth.php';