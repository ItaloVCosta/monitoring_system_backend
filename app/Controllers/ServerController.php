<?php

namespace App\Controllers;

use App\Services\ServerService;
use Exception;

class ServerController {
    private ServerService $serverService;

    public function __construct() {
        $this->serverService = new ServerService();
    }

    public function index() {
        try {
            $servers = $this->serverService->getAllServers();
            echo json_encode($servers);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'An error occurred while fetching servers.']);
        }
    }

    public function show(int $id) {
        try {
            $server = $this->serverService->getServerById($id);

            if ($server) {
                echo json_encode($server);
            } else {
                http_response_code(404);
                echo json_encode(['error' => 'Server not found']);
            }
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'An error occurred while fetching server details.']);
        }
    }

    public function store() {
        $data = json_decode(file_get_contents('php://input'), true);

        try {
            $serverId = $this->serverService->createServer($data);
            echo json_encode(['message' => 'Server created successfully', 'id' => $serverId]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'An error occurred while creating the server.']);
        }
    }

    public function update(int $id) {
        $data = json_decode(file_get_contents('php://input'), true);

        try {
            $updated = $this->serverService->updateServer($id, $data);
            if ($updated) {
                echo json_encode(['message' => 'Server updated successfully']);
            } else {
                http_response_code(404);
                echo json_encode(['error' => 'Server not found']);
            }
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'An error occurred while updating the server.']);
        }
    }

    public function delete(int $id) {
        try {
            $deleted = $this->serverService->deleteServer($id);

            if ($deleted) {
                echo json_encode(['message' => 'Server deleted successfully']);
            } else {
                http_response_code(404);
                echo json_encode(['error' => 'Server not found']);
            }
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'An error occurred while deleting the server.']);
        }
    }
}
