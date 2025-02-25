<?php

namespace App\Controllers;

abstract class Controller
{
    protected function render(string $view, array $data = []): void
    {
        try {
            extract($data, EXTR_SKIP);
            $viewFile = __DIR__ . "/../../views/blade/$view.blade.php";

            if (is_file($viewFile)) {
                require_once $viewFile;
            } else {
                throw new \RuntimeException("View $view not found");
            }
        } catch (\Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    protected function view(string $view, array $data = []): void
    {
        $this->render($view, $data);
    }
}
