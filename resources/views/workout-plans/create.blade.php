@extends('layouts.main')

@section('title', 'Schema Aanmaken | Gym Workout Tracker')

@section('styles')
  <link rel="stylesheet" href="{{ asset('css/workout-plan-form.css') }}">
@endsection

@section('content')
  <p class="pretitle">
    <i class="bi bi-pencil-fill"></i>
    Schema management
  </p>

  <h1 class="page-title">Schema <span>aanmaken</span></h1>

  <p class="subtitle">Stel een nieuw workout schema samen met de oefeningen die erbij horen.</p>

  <form action="{{ route('workout-plans.store') }}" method="POST" id="plan-form">
    @csrf

    <div class="plan-details">
      <div class="name">
        <label>
          Naam van het schema
          <div class="input-wrapper">
            <i class="bi bi-card-heading"></i>
            <input type="text" name="name" required>
          </div>
        </label>
      </div>

      <div class="description">
        <label>
          Beschrijving
          <div class="input-wrapper">
            <i class="bi bi-card-text"></i>
            <input type="text" name="description">
          </div>
        </label>
      </div>
    </div>

    <div class="add-day-row">
      <select id="day-picker">
        <option value="Maandag">Maandag</option>
        <option value="Dinsdag">Dinsdag</option>
        <option value="Woensdag">Woensdag</option>
        <option value="Donderdag">Donderdag</option>
        <option value="Vrijdag">Vrijdag</option>
        <option value="Zaterdag">Zaterdag</option>
        <option value="Zondag">Zondag</option>
      </select>

      <button type="button" id="add-day-button" class="add-row-button">
        <i class="bi bi-plus-circle-fill"></i>
        Dag toevoegen
      </button>
    </div>

    <div id="day-sections"></div>

    <button type="submit" class="submit-button">
      Schema opslaan
      <i class="bi bi-lightning-charge-fill"></i>
    </button>
  </form>

  <template id="day-section-template">
    <div class="day-section">
      <div class="day-indicator">
        <span class="day-name">__DAY__</span>
        <div class="line"></div>
        <button type="button" class="remove-day-button">
          <i class="bi bi-trash3-fill"></i>
        </button>
      </div>

      <div class="exercise-rows"></div>

      <button type="button" class="add-exercise-button">
        <i class="bi bi-plus-circle-fill"></i>
        Oefening toevoegen
      </button>
    </div>
  </template>

  <template id="exercise-row-template">
    <div class="exercise-row">
      <div class="name">
        <label>
          Naam
          <div class="input-wrapper">
            <i class="bi bi-activity"></i>
            <input type="text" name="exercises[__INDEX__][exercise]" required>
          </div>
        </label>
      </div>

      <div class="weight">
        <label>
          Gewicht (kg)
          <div class="input-wrapper">
            <i class="bi bi-speedometer"></i>
            <input type="number" name="exercises[__INDEX__][weight]" step="0.1" min="1" required>
          </div>
        </label>
      </div>

      <div class="sets">
        <label>
          Sets
          <div class="input-wrapper">
            <i class="bi bi-stack"></i>
            <input type="number" name="exercises[__INDEX__][sets]" step="1" min="1" required>
          </div>
        </label>
      </div>

      <div class="reps">
        <label>
          Reps
          <div class="input-wrapper">
            <i class="bi bi-repeat"></i>
            <input type="number" name="exercises[__INDEX__][reps]" step="1" min="1" required>
          </div>
        </label>
      </div>

      <input type="hidden" name="exercises[__INDEX__][weekday]" value="__DAY__">

      <button type="button" class="remove-row-button">
        <i class="bi bi-trash3-fill"></i>
      </button>
    </div>
  </template>

  <script>
    let exerciseIndex = 0;
    const daySectionsContainer = document.getElementById('day-sections');
    const daySectionTemplate = document.getElementById('day-section-template');
    const exerciseRowTemplate = document.getElementById('exercise-row-template');
    const dayPicker = document.getElementById('day-picker');
    const addedDays = new Set();

    function refreshDayPickerOptions() {
      [...dayPicker.options].forEach(option => {
        option.disabled = addedDays.has(option.value);
      });

      const firstAvailable = [...dayPicker.options].find(option => !option.disabled);
      if (firstAvailable) {
        dayPicker.value = firstAvailable.value;
      }
    }

    function addExerciseRow(section, day) {
      const clone = exerciseRowTemplate.content.cloneNode(true);
      const html = clone.querySelector('.exercise-row').outerHTML
        .replaceAll('__INDEX__', exerciseIndex)
        .replaceAll('__DAY__', day);

      const wrapper = document.createElement('div');
      wrapper.innerHTML = html;
      const row = wrapper.firstElementChild;

      row.querySelector('.remove-row-button').addEventListener('click', () => row.remove());

      section.querySelector('.exercise-rows').appendChild(row);
      exerciseIndex++;
    }

    function addDaySection(day) {
      if (addedDays.has(day)) return;
      addedDays.add(day);
      refreshDayPickerOptions();

      const clone = daySectionTemplate.content.cloneNode(true);
      const html = clone.querySelector('.day-section').outerHTML.replaceAll('__DAY__', day);

      const wrapper = document.createElement('div');
      wrapper.innerHTML = html;
      const section = wrapper.firstElementChild;

      section.querySelector('.remove-day-button').addEventListener('click', () => {
        section.remove();
        addedDays.delete(day);
        refreshDayPickerOptions();
      });

      section.querySelector('.add-exercise-button').addEventListener('click', () => {
        addExerciseRow(section, day);
      });

      daySectionsContainer.appendChild(section);

      // begin met 1 lege oefening-rij voor deze dag
      addExerciseRow(section, day);
    }

    document.getElementById('add-day-button').addEventListener('click', () => {
      if (dayPicker.value) {
        addDaySection(dayPicker.value);
      }
    });

    refreshDayPickerOptions();
  </script>
@endsection
