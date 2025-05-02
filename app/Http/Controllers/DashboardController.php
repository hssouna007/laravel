<?php

  namespace App\Http\Controllers;

  use Illuminate\Http\Request;
  use Illuminate\Support\Facades\Auth;
  use Illuminate\Support\Facades\Log;
  use Illuminate\Support\Facades\DB;

  class DashboardController extends Controller
  {
      public function index()
      {
          // Check if user is authenticated
          if (!Auth::check()) {
              Log::error('User not authenticated when accessing dashboard');
              return redirect()->route('login');
          }

          Log::info('Dashboard accessed by user ID: ' . Auth::id());

          // Fetch the latest goal for each category
          $goals = Auth::user()->goals()
              ->get()
              ->unique('category')
              ->sortByDesc('updated_at');

          Log::info('Goals fetched via relationship for user ID ' . Auth::id() . ': ' . $goals->toJson());

          // Fetch goals using raw SQL for comparison
          $rawGoals = DB::select('SELECT * FROM goals WHERE user_id = ?', [Auth::id()]);
          Log::info('Goals fetched via raw SQL for user ID ' . Auth::id() . ': ' . json_encode($rawGoals));

          Log::info('Rendering dashboard view with goals');

          return view('dashboard', compact('goals'));
      }
  }