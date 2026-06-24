<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  use WithoutModelEvents;

  /**
   * Seed de database van de applicatie.
   */
  public function run(): void
  {
    $this->call([
      RoleAndPermissionSeeder::class,
      WorkoutPlanSeeder::class,
    ]);
  }
}
