<?php

namespace App\Repositories;


use App\Core\Database;
use App\Models\Movie;
use PDO;

final class MovieRepository
{
    private PDO $db;

    public function __construct(Database $database)
    {
        $this->db = $database->getConnection();
    }

    public function getAll(int $limit = 10, int $offset = 0): array
    {
        $stmt = $this->db->prepare("SELECT * FROM movie LIMIT :limit OFFSET :offset");
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById(int $id): ?Movie
    {
        $stmt = $this->db->prepare("SELECT * FROM movie WHERE movieId = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $movie = $stmt->fetch(PDO::FETCH_ASSOC);
        return $movie ? new Movie($movie) : null;
    }

    public function create(Movie $movie): bool
    {
        $stmt = $this->db->prepare("
        INSERT INTO movie (directorId, name, description, releaseData)
        VALUES  (:directorId, :name, :description, :releaseDate)
        ");
        return $stmt->execute([
            ':directorId' => $movie->getDirectorId(),
            ':name' => $movie->getName(),
            ':description' => $movie->getDescription(),
            ':releaseDate' => $movie->getReleaseDate(),
        ]);
    }

    public function update(Movie $movie): bool
    {
        $stmt = $this->db->prepare("
        UPDATE movie SET directorId = :directorId, name= :name,
        description =:description,releaseDate= :releaseDate
        WHERE movieId = :id
        ");
        return $stmt->execute([
            ':id' => $movie->getMovieId(),
            ':directorId' => $movie->getDirectorId(),
            ':name' => $movie->getName(),
            ':description' => $movie->getDescription(),
            ':releaseDate' => $movie->getReleaseDate(),

        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM movie WHERE movieId = :id");
        $stmt->bindValue(':id', PDO::PARAM_INT);
        return $stmt->execute();
    }
}