<?php

namespace App\Repositories;

use PDO;

class BaseRepository {
    protected PDO $pdo;
    protected string $table;

    public function __construct() {
        $config = require __DIR__ . '/../../config/database.php';

        $dsn = "mysql:host={$config['host']};dbname={$config['database']};port={$config['port']};charset=utf8mb4";

        try {
            $this->pdo = new PDO($dsn, $config['username'], $config['password']);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erro ao conectar ao banco de dados: " . $e->getMessage());
        }
    }

    public function setTable(string $table): void {
        $this->table = $table;
    }
}
