<?php

namespace App\Controllers;

use App\Services\AuthService;

final class AuthController extends Controller
{
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function index(): void
    {
        $this->view('auth.login');
    }

    public function login(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            if (empty($username) || empty($password)) {
                $this->view('auth.login', ['error' => 'Username and password are required']);
                return;
            }

            if ($this->authService->attempt($username, $password)) {
                $_SESSION['user'] = $username;
                header('Location: /movies');
                exit;
            } else {
                $this->view('auth.login', ['error' => 'Invalid credentials']);
            }
        }
    }

    public function logout(): void
    {
        session_destroy();
        header('Location: /');
        exit;
    }
}
