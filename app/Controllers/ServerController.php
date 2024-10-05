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
            echo json_encode([__('words.error') => __('messages.error.server')]);
        }
    }

    public function show(int $id) {
        try {
            $server = $this->serverService->getServerById($id);

            if ($server) {
                echo json_encode($server);
            } else {
                http_response_code(404);
                echo json_encode([__('words.error') =>  __('messages.http.error.404.server')]);
            }
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([__('words.error') => __('messages.error.server')]);
        }
    }

    public function store() {
        $data = json_decode(file_get_contents('php://input'), true);

        try {
            $serverId = $this->serverService->createServer($data);
            echo json_encode([__('words.message') => __('messages.http.success.created.server'), 'id' => $serverId]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([__('words.error') => __('messages.error.server')]);
        }
    }

    public function update(int $id) {
        $data = json_decode(file_get_contents('php://input'), true);

        try {
            $updated = $this->serverService->updateServer($id, $data);
            if ($updated) {
                echo json_encode([__('words.message') => __('messages.http.success.updated.server')]);
            } else {
                http_response_code(404);
                echo json_encode([__('words.error') =>  __('messages.http.error.404.server')]);
            }
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([__('words.error') => __('messages.error.server')]);
        }
    }

    public function delete(int $id) {
        try {
            $deleted = $this->serverService->deleteServer($id);

            if ($deleted) {
                echo json_encode([__('words.message') => __('messages.http.success.deleted.server')]);
            } else {
                http_response_code(404);
                echo json_encode([__('words.error') =>  __('messages.http.error.404.server')]);
            }
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([__('words.error') => __('messages.error.server')]);
        }
    }
}
