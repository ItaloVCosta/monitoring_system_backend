<?php

use App\Controllers\ServerController;

return [
    'GET' => [
        '/api/servers' => [ServerController::class, 'index'],
        '/api/servers/{id}' => [ServerController::class, 'show'],
    ],
    'POST' => [
        '/api/servers' => [ServerController::class, 'store'],
    ],
    'PUT' => [
        '/api/servers/{id}' => [ServerController::class, 'update'],
    ],
    'DELETE' => [
        '/api/servers/{id}' => [ServerController::class, 'delete'],
    ],
];
