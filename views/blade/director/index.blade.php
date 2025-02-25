@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Список режиссёров</h1>
        <a href="/directors/add" class="btn btn-primary mb-3">Добавить режиссёра</a>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Имя</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($directors as $director)
                <tr>
                    <td>{{ $director['id'] }}</td>
                    <td>{{ $director['name'] }}</td>
                    <td>
                        <a href="/directors/edit?id={{ $director['id'] }}" class="btn btn-warning">Редактировать</a>
                        <a href="/directors/delete?id={{ $director['id'] }}" class="btn btn-danger">Удалить</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
