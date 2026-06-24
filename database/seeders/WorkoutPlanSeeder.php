<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\WorkoutPlan;
use Illuminate\Database\Seeder;

class WorkoutPlanSeeder extends Seeder
{
  /**
   * Run de database seeds.
   */
  public function run(): void
  {
    // trainer 1: Mark, maakt PPL en Full Body
    $mark = User::factory()->create([
      'name' => 'Mark de Vries',
      'email' => 'mark@gymtracker.nl',
    ]);
    $mark->assignRole('trainer');

    $this->createPplSchema($mark);
    $this->createFullBodySchema($mark);

    // trainer 2: Lisa, maakt Upper/Lower en Bro Split
    $lisa = User::factory()->create([
      'name' => 'Lisa Jansen',
      'email' => 'lisa@gymtracker.nl',
    ]);
    $lisa->assignRole('trainer');

    $this->createUpperLowerSchema($lisa);
    $this->createBroSplitSchema($lisa);

    // user 1: Tom, heeft al een schema geimporteerd
    $tom = User::factory()->create([
      'name' => 'Tom Bakker',
      'email' => 'tom@gymtracker.nl',
    ]);
    $tom->assignRole('user');

    $pplSchema = WorkoutPlan::where('name', 'Push Pull Legs')->first();
    foreach ($pplSchema->planExercises as $planExercise) {
      $tom->exercises()->create([
        'exercise' => $planExercise->exercise,
        'weight' => $planExercise->weight,
        'sets' => $planExercise->sets,
        'reps' => $planExercise->reps,
        'weekday' => $planExercise->weekday,
        'workout_plan_id' => $pplSchema->id,
      ]);
    }

    // user 2: Sanne, nog geen oefeningen (voor live demo)
    $sanne = User::factory()->create([
      'name' => 'Sanne Visser',
      'email' => 'sanne@gymtracker.nl',
    ]);
    $sanne->assignRole('user');
  }

  private function createPplSchema(User $trainer): void
  {
    $plan = WorkoutPlan::factory()->create([
      'name' => 'Push Pull Legs',
      'description' => 'Klassiek 6-daags schema verdeeld in push-, pull- en leg-dagen.',
      'trainer_id' => $trainer->id,
    ]);

    $exercises = [
      ['exercise' => 'Bench press', 'weekday' => 'Maandag', 'weight' => 60, 'sets' => 4, 'reps' => 8],
      ['exercise' => 'Overhead press', 'weekday' => 'Maandag', 'weight' => 35, 'sets' => 3, 'reps' => 10],
      ['exercise' => 'Triceps pushdown', 'weekday' => 'Maandag', 'weight' => 25, 'sets' => 3, 'reps' => 12],
      ['exercise' => 'Pull-ups', 'weekday' => 'Woensdag', 'weight' => 0, 'sets' => 4, 'reps' => 8],
      ['exercise' => 'Barbell row', 'weekday' => 'Woensdag', 'weight' => 50, 'sets' => 4, 'reps' => 10],
      ['exercise' => 'Biceps curl', 'weekday' => 'Woensdag', 'weight' => 14, 'sets' => 3, 'reps' => 12],
      ['exercise' => 'Squat', 'weekday' => 'Vrijdag', 'weight' => 80, 'sets' => 4, 'reps' => 8],
      ['exercise' => 'Romanian deadlift', 'weekday' => 'Vrijdag', 'weight' => 60, 'sets' => 3, 'reps' => 10],
      ['exercise' => 'Calf raise', 'weekday' => 'Vrijdag', 'weight' => 40, 'sets' => 4, 'reps' => 15],
    ];

    foreach ($exercises as $exercise) {
      $plan->planExercises()->create($exercise);
    }
  }

  private function createFullBodySchema(User $trainer): void
  {
    $plan = WorkoutPlan::factory()->create([
      'name' => 'Full Body Basis',
      'description' => 'Drie keer per week het hele lichaam trainen, ideaal voor beginners.',
      'trainer_id' => $trainer->id,
    ]);

    $exercises = [
      ['exercise' => 'Squat', 'weekday' => 'Maandag', 'weight' => 50, 'sets' => 3, 'reps' => 10],
      ['exercise' => 'Bench press', 'weekday' => 'Maandag', 'weight' => 40, 'sets' => 3, 'reps' => 10],
      ['exercise' => 'Lat pulldown', 'weekday' => 'Maandag', 'weight' => 45, 'sets' => 3, 'reps' => 10],
      ['exercise' => 'Deadlift', 'weekday' => 'Woensdag', 'weight' => 70, 'sets' => 3, 'reps' => 8],
      ['exercise' => 'Shoulder press', 'weekday' => 'Woensdag', 'weight' => 25, 'sets' => 3, 'reps' => 10],
      ['exercise' => 'Plank', 'weekday' => 'Woensdag', 'weight' => 0, 'sets' => 3, 'reps' => 1],
      ['exercise' => 'Leg press', 'weekday' => 'Vrijdag', 'weight' => 90, 'sets' => 3, 'reps' => 10],
      ['exercise' => 'Seated row', 'weekday' => 'Vrijdag', 'weight' => 40, 'sets' => 3, 'reps' => 10],
      ['exercise' => 'Dumbbell curl', 'weekday' => 'Vrijdag', 'weight' => 10, 'sets' => 3, 'reps' => 12],
    ];

    foreach ($exercises as $exercise) {
      $plan->planExercises()->create($exercise);
    }
  }

  private function createUpperLowerSchema(User $trainer): void
  {
    $plan = WorkoutPlan::factory()->create([
      'name' => 'Upper Lower Split',
      'description' => 'Vier dagen per week, afwisselend boven- en onderlichaam.',
      'trainer_id' => $trainer->id,
    ]);

    $exercises = [
      ['exercise' => 'Bench press', 'weekday' => 'Maandag', 'weight' => 55, 'sets' => 4, 'reps' => 8],
      ['exercise' => 'Barbell row', 'weekday' => 'Maandag', 'weight' => 45, 'sets' => 4, 'reps' => 10],
      ['exercise' => 'Shoulder press', 'weekday' => 'Maandag', 'weight' => 25, 'sets' => 3, 'reps' => 10],
      ['exercise' => 'Squat', 'weekday' => 'Dinsdag', 'weight' => 70, 'sets' => 4, 'reps' => 8],
      ['exercise' => 'Leg curl', 'weekday' => 'Dinsdag', 'weight' => 30, 'sets' => 3, 'reps' => 12],
      ['exercise' => 'Calf raise', 'weekday' => 'Dinsdag', 'weight' => 40, 'sets' => 4, 'reps' => 15],
      ['exercise' => 'Incline dumbbell press', 'weekday' => 'Donderdag', 'weight' => 22, 'sets' => 4, 'reps' => 10],
      ['exercise' => 'Pull-ups', 'weekday' => 'Donderdag', 'weight' => 0, 'sets' => 3, 'reps' => 8],
      ['exercise' => 'Lateral raise', 'weekday' => 'Donderdag', 'weight' => 8, 'sets' => 3, 'reps' => 15],
      ['exercise' => 'Deadlift', 'weekday' => 'Vrijdag', 'weight' => 90, 'sets' => 4, 'reps' => 6],
      ['exercise' => 'Bulgarian split squat', 'weekday' => 'Vrijdag', 'weight' => 16, 'sets' => 3, 'reps' => 10],
      ['exercise' => 'Hip thrust', 'weekday' => 'Vrijdag', 'weight' => 60, 'sets' => 3, 'reps' => 12],
    ];

    foreach ($exercises as $exercise) {
      $plan->planExercises()->create($exercise);
    }
  }

  private function createBroSplitSchema(User $trainer): void
  {
    $plan = WorkoutPlan::factory()->create([
      'name' => 'Bro Split',
      'description' => 'Vijf dagen per week, elke dag een andere spiergroep.',
      'trainer_id' => $trainer->id,
    ]);

    $exercises = [
      ['exercise' => 'Bench press', 'weekday' => 'Maandag', 'weight' => 65, 'sets' => 4, 'reps' => 8],
      ['exercise' => 'Incline dumbbell press', 'weekday' => 'Maandag', 'weight' => 24, 'sets' => 4, 'reps' => 10],
      ['exercise' => 'Cable fly', 'weekday' => 'Maandag', 'weight' => 15, 'sets' => 3, 'reps' => 12],
      ['exercise' => 'Deadlift', 'weekday' => 'Dinsdag', 'weight' => 100, 'sets' => 4, 'reps' => 6],
      ['exercise' => 'Lat pulldown', 'weekday' => 'Dinsdag', 'weight' => 50, 'sets' => 4, 'reps' => 10],
      ['exercise' => 'Barbell row', 'weekday' => 'Dinsdag', 'weight' => 55, 'sets' => 4, 'reps' => 10],
      ['exercise' => 'Squat', 'weekday' => 'Woensdag', 'weight' => 90, 'sets' => 4, 'reps' => 8],
      ['exercise' => 'Leg press', 'weekday' => 'Woensdag', 'weight' => 100, 'sets' => 4, 'reps' => 10],
      ['exercise' => 'Calf raise', 'weekday' => 'Woensdag', 'weight' => 45, 'sets' => 4, 'reps' => 15],
      ['exercise' => 'Overhead press', 'weekday' => 'Donderdag', 'weight' => 40, 'sets' => 4, 'reps' => 8],
      ['exercise' => 'Lateral raise', 'weekday' => 'Donderdag', 'weight' => 9, 'sets' => 4, 'reps' => 15],
      ['exercise' => 'Face pull', 'weekday' => 'Donderdag', 'weight' => 18, 'sets' => 3, 'reps' => 15],
      ['exercise' => 'Biceps curl', 'weekday' => 'Vrijdag', 'weight' => 16, 'sets' => 4, 'reps' => 10],
      ['exercise' => 'Triceps pushdown', 'weekday' => 'Vrijdag', 'weight' => 28, 'sets' => 4, 'reps' => 12],
      ['exercise' => 'Hammer curl', 'weekday' => 'Vrijdag', 'weight' => 14, 'sets' => 3, 'reps' => 12],
    ];

    foreach ($exercises as $exercise) {
      $plan->planExercises()->create($exercise);
    }
  }
}
