<?php

namespace App\Http\Controllers;

use App\Models\WorkoutPlan;
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
    ];
  }

  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    //
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    //
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
}
