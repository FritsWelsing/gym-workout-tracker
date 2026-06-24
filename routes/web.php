<?php

use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WorkoutPlanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
  return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//* Stuur gebruikers naar juiste pagina
Route::get('/dashboard', function () {
  if (auth()->user()->hasRole('trainer')) {
    return redirect()->route('workout-plans.index');
  }

  return redirect()->route('exercises.index');
})->middleware(['auth'])->name('dashboard');

Route::resource('exercises', ExerciseController::class)->middleware(['auth', 'permission:manage own exercises']);

Route::middleware(['auth', 'permission:manage own exercises'])->group(function () {
  Route::put('/exercises/{exercise}/increaseset', [ExerciseController::class, 'increaseset'])->name('exercises.increaseset');
  Route::put('/exercises/{exercise}/decreaseset', [ExerciseController::class, 'decreaseset'])->name('exercises.decreaseset');
  Route::put('/exercises/{exercise}/increasereps', [ExerciseController::class, 'increasereps'])->name('exercises.increasereps');
  Route::put('/exercises/{exercise}/decreasereps', [ExerciseController::class, 'decreasereps'])->name('exercises.decreasereps');
});

//* Workout plans (schema's)
Route::resource('workout-plans', WorkoutPlanController::class)->middleware('auth');
Route::post('/workout-plans/{workoutPlan}/import', [WorkoutPlanController::class, 'import'])->name('workout-plans.import')->middleware('auth');

require __DIR__ . '/auth.php';
