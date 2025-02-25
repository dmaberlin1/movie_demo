@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>{{ isset($movie) ? 'Редактировать фильм' : 'Добавить фильм' }}</h2>
        <form method="POST" action="{{ isset($movie) ? '/movies/edit?id=' . $movie['id'] : '/movies/add' }}">
            <div class="mb-3">
                <label class="form-label">Название</label>
                <input type="text" name="name" class="form-control" value="{{ $movie['name'] ?? '' }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Описание</label>
                <textarea name="description" class="form-control" required>{{ $movie['description'] ?? '' }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Дата выхода</label>
                <input type="date" name="release_date" class="form-control" value="{{ $movie['release_date'] ?? '' }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Режиссёр</label>
                <select name="director_id" class="form-control" required>
                    @foreach($directors as $director)
                        <option value="{{ $director['id'] }}" {{ isset($movie) && $movie['director_id'] == $director['id'] ? 'selected' : '' }}>
                            {{ $director['name'] }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-success">Сохранить</button>
        </form>
    </div>
@endsection
