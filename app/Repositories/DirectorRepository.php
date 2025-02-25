<?php

namespace App\Repositories;

use App\Models\Director;
use App\Core\Database;
use PDO;

class DirectorRepository
{
    private PDO $db;

    public function __construct(Database $database)
    {
        $this->db = $database::getInstance()->getConnection();
    }

    public function findById(int $id): ?Director
    {
        $stmt = $this->db->prepare("SELECT * FROM directors WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        return $data ? new Director($data) : null;
    }

    public function getAll(): array
    {
        $stmt = $this->db->query("SELECT * FROM directors");
        $directors = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $directors[] = new Director($row['id'], $row['name']);
        }

        return $directors;
    }

    public function add(array $data): void
    {
        $stmt = $this->db->prepare("INSERT INTO directors (name) VALUES (:name)");
        $stmt->execute(['name' => $data['name']]);
    }

    public function update(int $id, array $data): void
    {
        $stmt = $this->db->prepare("UPDATE directors SET name = :name WHERE id = :id");
        $stmt->execute(['name' => $data['name'], 'id' => $id]);
    }

    public function delete(int $id): void
    {
        $stmt = $this->db->prepare("DELETE FROM directors WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }
}
