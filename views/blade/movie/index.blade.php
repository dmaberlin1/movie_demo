@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Список фильмов</h1>
        <a href="/movies/add" class="btn btn-primary mb-3">Добавить фильм</a>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Название</th>
                <th>Описание</th>
                <th>Дата выхода</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($movies as $movie)
                <tr>
                    <td>{{ $movie['id'] }}</td>
                    <td>{{ $movie['name'] }}</td>
                    <td>{{ $movie['description'] }}</td>
                    <td>{{ $movie['release_date'] }}</td>
                    <td>
                        <a href="/movies/edit?id={{ $movie['id'] }}" class="btn btn-warning">Редактировать</a>
                        <a href="/movies/delete?id={{ $movie['id'] }}" class="btn btn-danger">Удалить</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
