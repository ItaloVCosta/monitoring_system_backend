<?php

namespace App\Services;

use App\Repositories\ServerRepository;
use RuntimeException;
use App\Models\Server;

class ServerService {
    private ServerRepository $serverRepository;

    public function __construct() {
        $this->serverRepository = new ServerRepository();
    }

    private function mapDataToServer(array $data): Server
    {
        $server = new Server();
    
        if (isset($data['id'])) {
            $server->setId($data['id']);
        }
    
        if (isset($data['name'])) {
            $server->setName($data['name']);
        }
    
        if (isset($data['ip_address'])) {
            $server->setIpAddress($data['ip_address']);
        }
    
        if (isset($data['status'])) {
            $server->setStatus($data['status']);
        }
    
        if (isset($data['cpu_usage'])) {
            $server->setCpuUsage($data['cpu_usage']);
        }
    
        if (isset($data['memory_usage'])) {
            $server->setMemoryUsage($data['memory_usage']);
        }
    
        if (isset($data['last_checked'])) {
            $server->setLastChecked($data['last_checked']);
        }
    
        if (isset($data['is_monitored'])) {
            $server->setIsMonitored($data['is_monitored']);
        }
    
        return $server;
    }

    public function getAllServers(): array {
        try {
            return $this->serverRepository->getAllServers();
        } catch (RuntimeException $e) {
            throw new RuntimeException("Error while retrieving servers.", 0, $e);
        }
    }

    public function getServerById(int $id): array|false {
        try {
            return $this->serverRepository->getServerById($id);
        } catch (RuntimeException $e) {
            throw new RuntimeException("Error while retrieving server details.", 0, $e);
        }
    }

    public function createServer(array $data): int {
        try {
            $server = $this->mapDataToServer($data);
            return $this->serverRepository->createServer($server);
        } catch (RuntimeException $e) {
            throw new RuntimeException("Error while creating server.", 0, $e);
        }
    }

    public function updateServer(int $id, array $data): bool {
        try {
            $data['id'] = $id;
            $server = $this->mapDataToServer($data);
            return $this->serverRepository->updateServer($server);
        } catch (RuntimeException $e) {
            throw new RuntimeException("Error while updating server.", 0, $e);
        }
    }

    public function deleteServer(int $id): bool {
        try {
            return $this->serverRepository->deleteServer($id);
        } catch (RuntimeException $e) {
            throw new RuntimeException("Error while deleting server.", 0, $e);
        }
    }
}
