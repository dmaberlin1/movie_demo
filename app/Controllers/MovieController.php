<?php

namespace App\Controllers;

use App\Services\MovieService;

final class MovieController extends Controller
{
    private MovieService $movieService;

    public function __construct(MovieService $movieService)
    {
        $this->movieService = $movieService;
    }

    public function index()
    {
        $movies = $this->movieService->getAllMovies();
        require_once __DIR__ . '/../../views/blade/movie/index.blade.php';
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->movieService->createMovie($_POST);
            header('Location: /movies');
        } else {
            require_once __DIR__ . '/../../views/blade/movie/form.blade.php';
        }
    }

    public function edit()
    {
        $id = $_GET['id'] ?? null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->movieService->updateMovie($id, $_POST);
            header('Location: /movies');
        } else {
            $movie = $this->movieService->getMovieById($id);
            require_once __DIR__ . '/../../views/blade/movie/form.blade.php';
        }
    }

    public function delete()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->movieService->deleteMovie($id);
            header('Location: /movies');
        }
    }
}