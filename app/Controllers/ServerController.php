<?php

namespace App\Controllers;

use App\Services\ServerService;
use App\Requests\DeleteServerRequest;
use App\Requests\UpdateServerRequest;
use App\Requests\StoreServerRequest;
use App\Repositories\ServerRepository;
use App\Exceptions\ValidationException;
use Exception;

class ServerController {
    private ServerService $serverService;
    private ServerRepository $serverRepository;

    public function __construct() {
        $this->serverService = new ServerService();
        $this->serverRepository = new ServerRepository();
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
            $request = new StoreServerRequest($data);
            $serverId = $this->serverService->createServer($request->getData());
            echo json_encode([__('words.message') => __('messages.http.success.created.server'), 'id' => $serverId]);
        } catch (ValidationException $e) {
            http_response_code(422);
            echo json_encode([
                __('words.error') => $e->getMessage(),
                __('words.details') => $e->getErrors()
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([__('words.error') => __('messages.error.server')]);
        }
    }

    public function update(int $id) {
        $data = json_decode(file_get_contents('php://input'), true);

        try {
            $request = new UpdateServerRequest($id,$data, $this->serverRepository);
            $updated = $this->serverService->updateServer($request->getId(), $data);
            if ($updated) {
                echo json_encode([__('words.message') => __('messages.http.success.updated.server')]);
            } else {
                http_response_code(404);
                echo json_encode([__('words.error') =>  __('messages.http.error.404.server')]);
            }
        } catch (ValidationException $e) {
            http_response_code(422);
            echo json_encode([
                __('words.error') => $e->getMessage(),
                __('words.details') => $e->getErrors()
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([__('words.error') => __('messages.error.server')]);
        }
    }

    public function delete(int $id) {
        try {
            $request = new DeleteServerRequest($id, $this->serverRepository);
            $deleted = $this->serverService->deleteServer($request->getId());

            if ($deleted) {
                echo json_encode([__('words.message') => __('messages.http.success.deleted.server')]);
            } else {
                http_response_code(404);
                echo json_encode([__('words.error') =>  __('messages.http.error.404.server')]);
            }
        } catch (ValidationException $e) {
            http_response_code(422);
            echo json_encode([
                __('words.error') => $e->getMessage(),
                __('words.details') => $e->getErrors()
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([__('words.error') => __('messages.error.server')]);
        }
    }
}
