<?php

namespace App\Services;

use App\Models\Movie;
use App\Repositories\MovieRepository;

class MovieService
{
    private MovieRepository $movieRepository;

    public function __construct(MovieRepository $movieRepository)
    {
        $this->movieRepository=$movieRepository;
    }

    public function getAllMovies(): array
    {
        return $this->movieRepository->getAll();
    }

    public function getMovieById(int $id): Movie
    {
        return $this->movieRepository->getById($id);
    }

    public function createMovie(array $data): bool
    {
        $movie = new Movie($data);
        return $this->movieRepository->create($movie);
    }

    public function updateMovie(int $id, array $data): bool
    {
        $movie = $this->movieRepository->getById($id);
        if (!$movie) {
            return false;
        }

        $movie->setName($data['name']);
        $movie->setDescription($data['description']);
        $movie->setReleaseDate($data['releaseDate']);
        $movie->setDirectorId($data['directorId']);

        return $this->movieRepository->update($movie);
    }

    public function deleteMovie(int $id): bool
    {
        return $this->movieRepository->delete($id);
    }

}