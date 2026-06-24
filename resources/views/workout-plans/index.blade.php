@extends('layouts.main')

@section('title', 'Schema\'s | Gym Workout Tracker')

@section('styles')
  <link rel="stylesheet" href="{{ asset('css/workout-plans.css') }}">
@endsection

@section('content')
  <div class="page-top">
    <p class="page-title">Workout schema's</p>

    @can('create workout plans')
      <a href="{{ route('workout-plans.create') }}" class="add-plan-button">
        <i class="bi bi-plus-circle-fill"></i>
        Schema toevoegen
      </a>
    @endcan
  </div>

  @if ($ownWorkoutPlans)
    <div class="plan-group">
      <div class="group-indicator">
        Mijn schema's
        <div class="line"></div>
      </div>

      <div class="plans">
        @foreach ($ownWorkoutPlans as $plan)
          <div class="plan-card" onclick="window.location='{{ route('workout-plans.show', $plan) }}'">
            <div class="top">
              <p class="plan-name">{{ $plan->name }}</p>

              <a href="{{ route('workout-plans.show', $plan) }}" class="show-plan-button">
                <i class="bi bi-eye-fill"></i>
              </a>

              @can('edit workout plans')
                <a href="{{ route('workout-plans.edit', $plan) }}" class="edit-plan-button">
                  <i class="bi bi-pencil-square"></i>
                </a>
              @endcan

              @can('delete workout plans')
                <form action="{{ route('workout-plans.destroy', $plan) }}" method="POST"
                  class="delete-plan-form">
                  @csrf
                  @method('delete')
                  <button type="submit" class="delete-plan-button">
                    <i class="bi bi-trash3-fill"></i>
                  </button>
                </form>
              @endcan
            </div>

            <p class="plan-description">{{ $plan->description }}</p>
            <p class="plan-exercise-count">{{ $plan->planExercises->count() }} oefeningen</p>
          </div>
        @endforeach
      </div>
    </div>
  @endif

  @foreach ($workoutPlans as $trainerId => $plans)
    <div class="plan-group">
      <div class="group-indicator">
        {{ $plans->first()->trainer->name }}
        <div class="line"></div>
      </div>

      <div class="plans">
        @foreach ($plans as $plan)
          <div class="plan-card" onclick="window.location='{{ route('workout-plans.show', $plan) }}'">
            <div class="top">
              <p class="plan-name">{{ $plan->name }}</p>

              <a href="{{ route('workout-plans.show', $plan) }}" class="show-plan-button">
                <i class="bi bi-eye-fill"></i>
              </a>

              @can('import workout plan')
                <form action="{{ route('workout-plans.import', $plan) }}" method="POST"
                  class="import-plan-form">
                  @csrf
                  <button type="submit" class="import-plan-button">
                    <i class="bi bi-download"></i>
                  </button>
                </form>
              @endcan
            </div>

            <p class="plan-description">{{ $plan->description }}</p>
            <p class="plan-exercise-count">{{ $plan->planExercises->count() }} oefeningen</p>
          </div>
        @endforeach
      </div>
    </div>
  @endforeach
@endsection

<script>
  document.querySelectorAll('.plan-card a, .plan-card button').forEach(el => {
    el.addEventListener('click', e => e.stopPropagation());
  });
</script>
