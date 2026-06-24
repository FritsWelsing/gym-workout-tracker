<?php

namespace Database\Factories;

use App\Models\WorkoutPlan;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlanExerciseFactory extends Factory
{
  /*
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    return [
      'exercise' => fake()->words(2, true),
      'weight' => fake()->randomFloat(1, 5, 120),
      'sets' => fake()->numberBetween(3, 5),
      'reps' => fake()->numberBetween(6, 15),
      'weekday' => fake()->randomElement(['Maandag', 'Dinsdag', 'Woensdag', 'Donderdag', 'Vrijdag', 'Zaterdag', 'Zondag']),
      'workout_plan_id' => WorkoutPlan::factory(),
    ];
  }
}
