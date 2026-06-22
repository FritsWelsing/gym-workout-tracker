<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Oefening Bewerken | Gym Workout Tracker</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="{{ asset('css/create&edit.css') }}">
</head>

<body>
  <header>
    <div class="container">
      <form>
        <button type="submit">
          <i class="bi bi-box-arrow-right"></i>
          Uitloggen
        </button>
      </form>
    </div>
  </header>

  <main>
    <div class="container">
      <p class="pretitle">
        <i class="bi bi-pencil-fill"></i>
        Oefening management
      </p>

      <h1 class="page-title">Oefening <span>wijzigen</span></h1>

      <p class="subtitle">Pas de details aan voor je huidige oefening om je progressie nauwkeurig bij te houden.</p>

      <form action="{{ route('exercises.update', $exercise) }}" method="POST" class="input-fields">
        @csrf
        @method('PUT')

        <div class="name">
          <label>
            Naam
            <div class="input-wrapper">
              <i class="bi bi-activity"></i>
              <input type="text" name="exercise" value="{{ $exercise->exercise }}" required>
            </div>
          </label>
        </div>

        <div class="weight">
          <label>
            Gewicht (kg)
            <div class="input-wrapper">
              <i class="bi bi-speedometer"></i>
              <input type="number" name="weight" value="{{ $exercise->weight }}" step="0.1" min="1" required>
            </div>
          </label>
        </div>

        <div class="day">
          <label>
            Dag
            <div class="input-wrapper">
              <i class="bi bi-calendar-week"></i>

              <select name="weekday" required>
                <optgroup label="werkdagen">
                  <option value="Maandag" {{ $exercise->weekday == "Maandag" ? "selected" : "" }}>Maandag</option>
                  <option value="Dinsdag"{{ $exercise->weekday == "Dinsdag" ? "selected" : "" }}>Dinsdag</option>
                  <option value="Woensdag"{{ $exercise->weekday == "Woensdag" ? "selected" : "" }}>Woensdag</option>
                  <option value="Donderdag"{{ $exercise->weekday == "Donderdag" ? "selected" : "" }}>Donderdag</option>
                  <option value="Vrijdag"{{ $exercise->weekday == "Vrijdag" ? "selected" : "" }}>Vrijdag</option>
                </optgroup>
                <optgroup label="weekend">
                  <option value="Zaterdag"{{ $exercise->weekday == "Zaterdag" ? "selected" : "" }}>Zaterdag</option>
                  <option value="Zondag"{{ $exercise->weekday == "Zondag" ? "selected" : "" }}>Zondag</option>
                </optgroup>
              </select>
            </div>
          </label>
        </div>

        <div class="sets">
          <label>
            Sets
            <div class="input-wrapper">
              <i class="bi bi-stack"></i>
              <input type="number" name="sets" value="{{ $exercise->sets }}" step="1" min="1" required>
            </div>
          </label>
        </div>

        <div class="reps">
          <label>
            Reps
            <div class="input-wrapper">
              <i class="bi bi-repeat"></i>
              <input type="number" name="reps" value="{{ $exercise->reps }}" step="1" min="1">
            </div>
          </label>
        </div>

        <button type="submit" class="submit-button">
          Opslaan
          <i class="bi bi-lightning-charge-fill"></i>
        </button>
      </form>
    </div>
  </main>
</body>

</html>
