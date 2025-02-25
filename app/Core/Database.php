<?php

namespace App\Core;

use PDO;
use PDOException;

final class Database
{
    private static ?Database $instance = null;
    private PDO $connection;

    private function __construct()
    {
        $config = require __DIR__ . '/../../config/config.php';

        try {
            $dsn = "pgsql:host=" . $config['DB_HOST'] . ";dbname=" . $config['DB_NAME'];
            $this->connection = new PDO($dsn, $config['db']['user'], $config['db']['pass'], [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]);
        } catch (PDOException $e) {
            error_log("Database connection failed: " . $e->getMessage());
            throw new PDOException("Ошибка соединения с базой данных.");
        }
    }

    public static function getInstance(): Database
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection(): PDO
    {
        return $this->connection;
    }

    private function __clone()
    {
    }
}
