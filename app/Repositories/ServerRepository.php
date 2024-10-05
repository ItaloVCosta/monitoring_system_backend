<?php

namespace App\Repositories;

use App\Models\Server;
use PDO;
use PDOException;
use RuntimeException;

class ServerRepository extends BaseRepository {

    public function __construct() {
        parent::__construct();
        $model = new Server();
        $this->setTable($model->table);
    }
    

    public function getAllServers(): array {
        try {
            $stmt = $this->pdo->query("SELECT * FROM {$this->table}");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new RuntimeException("Failed to retrieve servers.", 0, $e);
        }
    }

    public function getServerById(int $id): array|false {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id = :id");
            $stmt->execute(['id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new RuntimeException("Failed to retrieve server with ID $id.", 0, $e);
        }
    }

    public function createServer(Server $server): int {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO {$this->table} 
                (name, ip_address, status, cpu_usage, memory_usage, last_checked, is_monitored) 
                VALUES (:name, :ip_address, :status, :cpu_usage, :memory_usage, :last_checked, :is_monitored)");

            $stmt->execute([
                'name' => $server->getName(),
                'ip_address' => $server->getIpAddress(),
                'status' => $server->getStatus(),
                'cpu_usage' => $server->getCpuUsage(),
                'memory_usage' => $server->getMemoryUsage(),
                'last_checked' => $server->getLastChecked(),
                'is_monitored' => $server->getIsMonitored(),
            ]);
            
            return (int) $this->pdo->lastInsertId();
        } catch (PDOException $e) {
            echo($e);
            throw new RuntimeException("Failed to create server.", 0, $e);
        }
    }

    public function updateServer(Server $server): bool {
        try {
            $stmt = $this->pdo->prepare("UPDATE {$this->table} SET 
                name = :name,
                ip_address = :ip_address,
                status = :status,
                cpu_usage = :cpu_usage,
                memory_usage = :memory_usage,
                last_checked = :last_checked,
                is_monitored = :is_monitored
                WHERE id = :id");

            return $stmt->execute([
                'name' => $server->getName(),
                'ip_address' => $server->getIpAddress(),
                'status' => $server->getStatus(),
                'cpu_usage' => $server->getCpuUsage(),
                'memory_usage' => $server->getMemoryUsage(),
                'last_checked' => $server->getLastChecked(),
                'is_monitored' => $server->getIsMonitored(),
                'id' => $server->getId(),
            ]);
        } catch (PDOException $e) {
            echo($e);
            throw new \RuntimeException("Failed to update server with ID {$server->getId()}.", 0, $e);
        }
    }

    public function deleteServer(int $id): bool {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = :id");
            return $stmt->execute(['id' => $id]);
        } catch (PDOException $e) {
            throw new RuntimeException("Failed to delete server with ID $id.", 0, $e);
        }
    }
}
