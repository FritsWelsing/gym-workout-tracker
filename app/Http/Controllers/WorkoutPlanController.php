<?php

namespace App\Http\Controllers;

use App\Models\WorkoutPlan;
use App\Http\Requests\StoreWorkoutPlanRequest;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Spatie\Permission\Middleware\PermissionMiddleware;

class WorkoutPlanController extends Controller implements HasMiddleware
{
  /**
   * Permissies koppelen aan de methodes.
   */
  public static function middleware(): array
  {
    return [
      new Middleware(PermissionMiddleware::using('index workout plans'), only: ['index']),
      new Middleware(PermissionMiddleware::using('show workout plans'), only: ['show']),
      new Middleware(PermissionMiddleware::using('create workout plans'), only: ['create', 'store']),
      new Middleware(PermissionMiddleware::using('edit workout plans'), only: ['edit', 'update']),
      new Middleware(PermissionMiddleware::using('delete workout plans'), only: ['destroy']),
      new Middleware(PermissionMiddleware::using('import workout plan'), only: ['import']),
    ];
  }

  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $workoutPlans = WorkoutPlan::with('trainer', 'planExercises')
      ->get()
      ->groupBy('trainer_id');

    $ownWorkoutPlans = null;

    if (auth()->user()->hasRole('trainer')) {
      $ownWorkoutPlans = $workoutPlans->pull(auth()->id());
    }

    return view('workout-plans.index', [
      'ownWorkoutPlans' => $ownWorkoutPlans,
      'workoutPlans' => $workoutPlans,
    ]);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('workout-plans.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreWorkoutPlanRequest $request)
  {
    $workoutPlan = WorkoutPlan::create([
      'name' => $request->name,
      'description' => $request->description,
      'trainer_id' => auth()->id(),
    ]);

    foreach ($request->exercises as $exercise) {
      $workoutPlan->planExercises()->create([
        'exercise' => $exercise['exercise'],
        'weight' => $exercise['weight'],
        'sets' => $exercise['sets'],
        'reps' => $exercise['reps'],
        'weekday' => $exercise['weekday'],
      ]);
    }

    return redirect()->route('workout-plans.index');
  }

  /**
   * Display the specified resource.
   */
  public function show(WorkoutPlan $workoutPlan)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(WorkoutPlan $workoutPlan)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, WorkoutPlan $workoutPlan)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(WorkoutPlan $workoutPlan)
  {
    //
  }

  /**
   * Importeer de oefeningen van een schema naar de eigen oefeningen van de gebruiker.
   */
  public function import(WorkoutPlan $workoutPlan)
  {
    foreach ($workoutPlan->planExercises as $planExercise) {
      auth()->user()->exercises()->create([
        'exercise' => $planExercise->exercise,
        'weight' => $planExercise->weight,
        'sets' => $planExercise->sets,
        'reps' => $planExercise->reps,
        'weekday' => $planExercise->weekday,
        'workout_plan_id' => $workoutPlan->id,
      ]);
    }

    return redirect()->route('exercises.index');
  }
}
