@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>{{ isset($director) ? 'Редактировать режиссёра' : 'Добавить режиссёра' }}</h2>
        <form method="POST" action="{{ isset($director) ? '/directors/edit?id=' . $director['id'] : '/directors/add' }}">
            <div class="mb-3">
                <label class="form-label">Имя</label>
                <input type="text" name="name" class="form-control" value="{{ $director['name'] ?? '' }}" required>
            </div>
            <button type="submit" class="btn btn-success">Сохранить</button>
        </form>
    </div>
@endsection
