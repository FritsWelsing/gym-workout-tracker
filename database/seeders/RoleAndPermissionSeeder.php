<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
  /**
   * Run de database seeds.
   */
  public function run(): void
  {
    app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

    // permissies voor workout plan CRUD
    Permission::create(['name' => 'index workout plans']);
    Permission::create(['name' => 'show workout plans']);
    Permission::create(['name' => 'create workout plans']);
    Permission::create(['name' => 'edit workout plans']);
    Permission::create(['name' => 'delete workout plans']);
    Permission::create(['name' => 'import workout plan']);

    // cache opnieuw legen zodat de net aangemaakte permissies gevonden worden
    app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

    // trainer rol
    Role::create(['name' => 'trainer'])
      ->givePermissionTo([
        'index workout plans',
        'show workout plans',
        'create workout plans',
        'edit workout plans',
        'delete workout plans',
      ]);

    // user rol
    Role::create(['name' => 'user'])
      ->givePermissionTo([
        'index workout plans',
        'show workout plans',
        'create workout plans',
        'edit workout plans',
        'delete workout plans',
        'import workout plan',
      ]);
  }
}
