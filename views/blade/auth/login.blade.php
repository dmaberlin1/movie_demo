@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Авторизация</h2>
        @if(isset($error))
            <div class="alert alert-danger">{{ $error }}</div>
        @endif
        <form method="POST" action="/login">
            <div class="mb-3">
                <label class="form-label">Логин</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Пароль</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Войти</button>
        </form>
    </div>
@endsection
