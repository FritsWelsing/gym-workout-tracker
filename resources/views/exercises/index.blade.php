@extends('layouts.main')

@section('title', 'Overzicht | Gym Workout Tracker')

@section('styles')
  <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
  <div class="page-top">
    <p class="page-title">Workout overzicht van {{ Auth::user()->name }}</p>

    <a href="{{ route('exercises.create') }}" class="add-exercise-button">
      <i class="bi bi-plus-circle-fill"></i>
      Oefening toevoegen
    </a>
  </div>

  @foreach ($exercises as $day => $dayExercises)
    <div class="day">
      <div class="day-indicator">
        {{ $day }}
        <div class="line"></div>
      </div>

      <div class="exercises">
        @foreach ($dayExercises as $exercise)
          <div class="exercise-card">
            <div class="top">
              <p class="exercise-name">{{ $exercise->exercise }}</p>

              <a href="{{ route('exercises.edit', $exercise) }}" class="edit-exercise-button">
                <i class="bi bi-pencil-square"></i>
              </a>

              <form action="{{ route('exercises.destroy', $exercise) }}" method="POST"
                class="delete-exercise-form">
                @csrf
                @method('delete')
                <button type="submit" class="delete-exercise-button">
                  <i class="bi bi-trash3-fill"></i>
                </button>
              </form>
            </div>

            <div class="weight">
              Gewicht
              <div class="weight-amount">{{ $exercise->weight }}</div>
              <div class="kg-indicator">kg</div>
            </div>

            <div class="bottom">
              <div class="sets">
                <div class="indicator">sets</div>

                <div class="amount">
                  <form action="{{ route('exercises.decreaseset', $exercise) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit">—</button>
                  </form>

                  <div class="amount-number">{{ $exercise->sets }}</div>

                  <form action="{{ route('exercises.increaseset', $exercise) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit">+</button>
                  </form>
                </div>
              </div>

              <div class="reps">
                <div class="indicator">reps</div>

                <div class="amount">
                  <form action="{{ route('exercises.decreasereps', $exercise) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit">—</button>
                  </form>

                  <div class="amount-number">{{ $exercise->reps }}</div>

                  <form action="{{ route('exercises.increasereps', $exercise) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit">+</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  @endforeach
@endsection
