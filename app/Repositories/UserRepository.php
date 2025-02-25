<?php

namespace App\Repositories;

use App\Core\Database;
use PDO;

class UserRepository
{
    private PDO $db;
    public function __construct(Database $database)
    {
        $this->db = $database::getInstance()->getConnection();
    }

    public function findByUsername(string $username): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = :username LIMIT 1");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user ?: null;
    }

    public function create(array $userData): bool
    {
        $stmt = $this->db->prepare("
            INSERT INTO users (username, password, email) 
            VALUES (:username, :password, :email)
        ");
        return $stmt->execute([
            'username' => $userData['username'],
            'password' => password_hash($userData['password'], PASSWORD_BCRYPT),
            'email'    => $userData['email'],
        ]);
    }
}