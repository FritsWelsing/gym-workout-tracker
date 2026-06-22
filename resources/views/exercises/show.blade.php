<h1>{{ $exercise->exercise }}</h1>
<p>{{ $exercise->weight }}</p>
<p>{{ $exercise->sets }}</p>
<p>{{ $exercise->reps }}</p>
<p>{{ $exercise->weekday }}</p>

<a href="{{ route('exercises.edit', $exercise) }}">Oefening Wijzigen</a>

<form action="{{ route('exercises.destroy', $exercise) }}" method="POST">
  @csrf
  @method('delete')

  <button type="submit">Verwijder</button>
</form>
