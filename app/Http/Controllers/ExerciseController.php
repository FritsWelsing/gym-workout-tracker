<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExerciseRequest;
use App\Http\Requests\UpdateExerciseRequest;
use App\Models\Exercise;
use Illuminate\Support\Facades\Auth;

class ExerciseController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $user_id = Auth::id();

    $exercises = Exercise::where('user_id', $user_id)
      ->orderByRaw("
        FIELD(weekday, 'Maandag', 'Dinsdag', 'Woensdag', 'Donderdag', 'Vrijdag', 'Zaterdag', 'Zondag')
      ")
      ->get()
      ->groupBy('weekday');

    return view('exercises.index', compact('exercises'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('exercises.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreExerciseRequest $request)
  {
    Auth::user()->exercises()->create([
      'exercise' => $request->exercise,
      'weight' => $request->weight,
      'sets' => $request->sets,
      'reps' => $request->reps,
      'weekday' => $request->weekday,
    ]);

    return redirect()->route('exercises.index');
  }

  /**
   * Display the specified resource.
   */
  public function show(Exercise $exercise)
  {
    if ($exercise->user_id !== Auth::id()) {
      abort(403);
    }

    return view('exercises.show', compact('exercise'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Exercise $exercise)
  {
    if ($exercise->user_id !== Auth::id()) {
      abort(403);
    }

    return view('exercises.edit', compact('exercise'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateExerciseRequest $request, Exercise $exercise)
  {
    if ($exercise->user_id !== Auth::id()) {
      abort(403);
    }

    $exercise->update([
      'exercise' => $request->exercise,
      'weight' => $request->weight,
      'sets' => $request->sets,
      'reps' => $request->reps,
      'weekday' => $request->weekday,
    ]);

    return redirect()->route('exercises.index');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Exercise $exercise)
  {
    if ($exercise->user_id !== Auth::id()) {
      abort(403);
    }

    $exercise->delete();

    return redirect()->route('exercises.index');
  }

  //* Sets
  // +1 Set
  public function increaseset(Exercise $exercise)
  {
    if ($exercise->user_id !== Auth::id()) {
      abort(403);
    }

    $exercise->sets++;
    $exercise->save();

    return redirect()->route('exercises.index');
  }

  // -1 Set
  public function decreaseset(Exercise $exercise)
  {
    if ($exercise->user_id !== Auth::id()) {
      abort(403);
    }

    $exercise->sets = max($exercise->sets - 1, 1);
    $exercise->save();

    return redirect()->route('exercises.index');
  }

  //* Reps
  // +1 Rep
  public function increasereps(Exercise $exercise)
  {
    if ($exercise->user_id !== Auth::id()) {
      abort(403);
    }

    $exercise->reps++;
    $exercise->save();

    return redirect()->route('exercises.index');
  }

  // -1 Rep
  public function decreasereps(Exercise $exercise)
  {
    if ($exercise->user_id !== Auth::id()) {
      abort(403);
    }

    $exercise->reps = max($exercise->reps - 1, 1);
    $exercise->save();

    return redirect()->route('exercises.index');
  }
}
