<?php

namespace App\Models;

class Movie
{
    private ?int $id;
    private string $name;
    private string $description;
    private string $releaseDate;
    private int $directorId;

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? null;
        $this->name = $data['name'];
        $this->description = $data['description'];
        $this->releaseDate = $data['releaseDate'];
        $this->directorId = $data['directorId'];
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getReleaseDate(): string
    {
        return $this->releaseDate;
    }

    public function getDirectorId(): int
    {
        return $this->directorId;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function setReleaseDate(string $releaseDate): void
    {
        $this->releaseDate = $releaseDate;
    }

    public function setDirectorId(int $directorId): void
    {
        $this->directorId = $directorId;
    }
}
