@extends('layouts.main')

@section('title', 'Geen toegang | Gym Workout Tracker')

@section('styles')
  <link rel="stylesheet" href="{{ asset('css/error.css') }}">
@endsection

@section('content')
  <div class="error-page">
    <p class="error-code">403</p>
    <p class="error-message">{{ $exception->getMessage() ?: 'Je hebt geen toegang tot deze pagina.' }}</p>

    <a href="{{ route('dashboard') }}" class="back-button">
      <i class="bi bi-arrow-left"></i>
      Terug naar overzicht
    </a>
  </div>
@endsection
