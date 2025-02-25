<?php
namespace App\Services;

use App\Repositories\UserRepository;

final class AuthService
{
    private UserRepository $userRepository;


    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function attempt(string $username, string $password): bool
    {
        $user = $this->userRepository->findByUsername($username);
        return $user && password_verify($password, $user['password']);
    }
}