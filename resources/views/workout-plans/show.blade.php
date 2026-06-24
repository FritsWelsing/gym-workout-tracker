@extends('layouts.main')

@section('title', $workoutPlan->name . ' | Gym Workout Tracker')

@section('styles')
  <link rel="stylesheet" href="{{ asset('css/workout-plan-show.css') }}">
@endsection

@section('content')
  <div class="page-top">
    <div>
      <p class="pretitle">
        <i class="bi bi-clipboard2-pulse-fill"></i>
        Schema van {{ $workoutPlan->trainer->name }}
      </p>

      <h1 class="page-title">{{ $workoutPlan->name }}</h1>

      @if ($workoutPlan->description)
        <p class="subtitle">{{ $workoutPlan->description }}</p>
      @endif
    </div>

    <div class="actions">
      @can('import workout plan')
        <form action="{{ route('workout-plans.import', $workoutPlan) }}" method="POST">
          @csrf
          <button type="submit" class="import-button">
            <i class="bi bi-download"></i>
            Importeer dit schema
          </button>
        </form>
      @endcan

      @if (auth()->id() === $workoutPlan->trainer_id)
        <a href="{{ route('workout-plans.edit', $workoutPlan) }}" class="edit-button">
          <i class="bi bi-pencil-square"></i>
          Wijzigen
        </a>
      @endif
    </div>
  </div>

  @forelse ($exercisesByDay as $day => $dayExercises)
    <div class="day">
      <div class="day-indicator">
        {{ $day }}
        <div class="line"></div>
      </div>

      <div class="exercises">
        @foreach ($dayExercises as $exercise)
          <div class="exercise-card">
            <p class="exercise-name">{{ $exercise->exercise }}</p>

            <div class="weight">
              Gewicht
              <div class="weight-value">
                <span class="weight-amount">{{ $exercise->weight }}</span>
                <span class="kg-indicator">kg</span>
              </div>
            </div>

            <div class="bottom">
              <div class="sets">
                <div class="indicator">sets</div>
                <div class="amount-number">{{ $exercise->sets }}</div>
              </div>

              <div class="reps">
                <div class="indicator">reps</div>
                <div class="amount-number">{{ $exercise->reps }}</div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  @empty
    <p class="empty-message">Dit schema heeft nog geen oefeningen.</p>
  @endforelse
@endsection
