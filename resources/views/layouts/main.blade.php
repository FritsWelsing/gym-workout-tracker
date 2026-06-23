<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Gym Workout Tracker')</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
  @yield('styles')
</head>

<body>
  <header class="navbar">
    <div class="container navbar-content">
      <a href="{{ route('dashboard') }}" class="navbar-brand">Gym Workout Tracker</a>

      <nav class="navbar-links">
        @auth
          @hasrole('user')
            <a href="{{ route('exercises.index') }}">Mijn oefeningen</a>
            <a href="{{ route('workout-plans.index') }}">Schema's</a>
          @endhasrole

          @hasrole('trainer')
            <a href="{{ route('workout-plans.index') }}">Schema's</a>
          @endhasrole
        @endauth
      </nav>

      <form method="POST" action="{{ route('logout') }}" class="navbar-logout">
        @csrf
        <button type="submit">
          <i class="bi bi-box-arrow-right"></i>
          Uitloggen
        </button>
      </form>
    </div>
  </header>

  <main>
    <div class="container">
      @yield('content')
    </div>
  </main>
</body>

</html>
