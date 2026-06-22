<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Oefening Aanmaken | Gym Workout Tracker</title>
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

      <h1 class="page-title">Oefening <span>aanmaken</span></h1>

      <p class="subtitle">Pas de details aan voor je huidige oefening om je progressie nauwkeurig bij te houden.</p>

      <form action="{{ route('exercises.store') }}" method="POST" class="input-fields">
        @csrf

        <div class="name">
          <label>
            Naam
            <div class="input-wrapper">
              <i class="bi bi-activity"></i>
              <input type="text" name="exercise" required>
            </div>
          </label>
        </div>

        <div class="weight">
          <label>
            Gewicht (kg)
            <div class="input-wrapper">
              <i class="bi bi-speedometer"></i>
              <input type="number" name="weight" step="0.1" min="1" required>
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
                  <option value="Maandag">Maandag</option>
                  <option value="Dinsdag">Dinsdag</option>
                  <option value="Woensdag">Woensdag</option>
                  <option value="Donderdag">Donderdag</option>
                  <option value="Vrijdag">Vrijdag</option>
                </optgroup>
                <optgroup label="weekend">
                  <option value="Zaterdag">Zaterdag</option>
                  <option value="Zondag">Zondag</option>
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
              <input type="number" name="sets" step="1" min="1" required>
            </div>
          </label>
        </div>

        <div class="reps">
          <label>
            Reps
            <div class="input-wrapper">
              <i class="bi bi-repeat"></i>
              <input type="number" name="reps" step="1" min="1" required>
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
