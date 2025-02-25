<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Система управления фильмами</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="/movies">Фильмы</a>
        <a class="navbar-brand" href="/directors">Режиссеры</a>
        <a class="navbar-brand text-danger" href="/logout">Выход</a>
    </div>
</nav>
<div class="container mt-4">
    @yield('content')
</div>
</body>
</html>
