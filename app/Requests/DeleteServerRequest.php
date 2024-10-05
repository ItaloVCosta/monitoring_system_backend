<?php

namespace App\Requests;

use App\Repositories\ServerRepository;
use App\Exceptions\ValidationException;

class DeleteServerRequest
{
    private int $id;

    public function __construct(int $id, ServerRepository $serverRepository)
    {
        $exists = $serverRepository->exists($id);

        if (!$exists) {
            throw new ValidationException("messages.http.error.404.server_not_found", [
                'id' => 'validation.errors.id_not_found'
            ]);
        }

        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
