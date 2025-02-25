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

    public function index(): void
    {
        $movies = $this->movieService->getAllMovies();
        $this->view('movie.index', ['movies' => $movies]);
    }

    public function show($id): void
    {
        $movie = $this->movieService->getMovieById($id);
        $this->view('movie.show', ['movie' => $movie]);
    }

    public function create(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handleCreateMovie($_POST);
        }

        $this->view('movie.form');
    }

    private function handleCreateMovie(array $data): void
    {
        $this->movieService->createMovie($data);
        header('Location: /movies');
        exit;
    }

    public function edit($id): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->movieService->updateMovie($id, $_POST);
            header('Location: /movies');
            exit;
        }

        $movie = $this->movieService->getMovieById($id);
        $this->view('movie.form', ['movie' => $movie]);
    }

    public function update($id): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->movieService->updateMovie($id, $_POST);
            header('Location: /movies');
            exit;
        }

        $movie = $this->movieService->getMovieById($id);
        $this->view('movie.form', ['movie' => $movie]);
    }

    public function delete($id): void
    {
        if ($id) {
            $this->movieService->deleteMovie($id);
            header('Location: /movies');
            exit;
        }
    }
}
