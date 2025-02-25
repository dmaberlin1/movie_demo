<?php

namespace App\Controllers;

use App\Services\DirectorService;

final class DirectorController extends Controller
{
    private DirectorService $directorService;

    public function __construct(DirectorService $directorService)
    {
        $this->directorService = $directorService;
    }

    public function index(): void
    {
        $directors = $this->directorService->getAllDirectors();
        $this->view('director.index', ['directors' => $directors]);
    }

    public function show($id): void
    {
        $director = $this->directorService->getDirectorById($id);
        $this->view('director.show', ['director' => $director]);
    }

    public function create(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handleCreateDirector($_POST);
        }

        $this->view('director.form');
    }

    private function handleCreateDirector(array $data): void
    {
        $this->directorService->createDirector($data);
        header('Location: /directors');
        exit;
    }

    public function edit($id): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->directorService->updateDirector($id, $_POST);
            header('Location: /directors');
            exit;
        }

        $director = $this->directorService->getDirectorById($id);
        $this->view('director.form', ['director' => $director]);
    }

    public function update($id): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->directorService->updateDirector($id, $_POST);
            header('Location: /directors');
            exit;
        }

        $director = $this->directorService->getDirectorById($id);
        $this->view('director.form', ['director' => $director]);
    }

    public function delete($id): void
    {
        if ($id) {
            $this->directorService->deleteDirector($id);
            header('Location: /directors');
            exit;
        }
    }
}
