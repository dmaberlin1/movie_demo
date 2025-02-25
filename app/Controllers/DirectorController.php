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

    public function index()
    {
        $directors = $this->directorService->getAllDirectors();
        require_once __DIR__ . '/../../views/blade/director/index.blade.php';
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->directorService->createDirector($_POST);
            header('Location: /directors');
        } else {
            require_once __DIR__ . '/../../views/blade/director/form.blade.php';
        }
    }

    public function edit()
    {
        $id = $_GET['id'] ?? null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->directorService->updateDirector($id, $_POST);
            header('Location: /directors');
        } else {
            $director = $this->directorService->getDirectorById($id);
            require_once __DIR__ . '/../../views/blade/director/form.blade.php';
        }
    }

    public function delete()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->directorService->deleteDirector($id);
            header('Location: /directors');
        }
    }
}
