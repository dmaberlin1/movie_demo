<?php

namespace App\Services;

use App\Models\Director;
use App\Repositories\DirectorRepository;

class DirectorService
{
    private DirectorRepository $directorRepository;

    public function __construct(DirectorRepository $directorRepository)
    {
        $this->directorRepository = $directorRepository;
    }

    public function getAllDirectors(): array
    {
        return $this->directorRepository->getAll();
    }

    public function getDirectorById(int $id): ?Director
    {
        return $this->directorRepository->findById($id);
    }

    public function createDirector(array $data): void
    {
        $this->directorRepository->add($data);
    }

    public function updateDirector(int $id, array $data): void
    {
        $this->directorRepository->update($id, $data);
    }

    public function deleteDirector(int $id): void
    {
        $this->directorRepository->delete($id);
    }
}
