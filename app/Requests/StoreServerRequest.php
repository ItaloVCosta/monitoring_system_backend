<?php

namespace App\Requests;

use App\Exceptions\ValidationException;

class StoreServerRequest
{
    private array $data;

    public function __construct(array $data)
    {
        $this->validate($data);
        $this->data = $data;
    }

    public function getData(): array
    {
        return $this->data;
    }

    private function validate(array $data): void
    {
        $errors = [];

        if (!isset($data['name']) || !is_string($data['name']) || empty($data['name'])) {
            $errors['name'] = __('validation.errors.required_string', ['field' => 'name']);
        }

        if (!isset($data['ip_address']) || !is_string($data['ip_address']) || empty($data['ip_address'])) {
            $errors['ip_address'] = __('validation.errors.required_string', ['field' => 'ip_address']);
        }

        if (!isset($data['status']) || !is_bool($data['status'])) {
            $errors['status'] = __('validation.errors.required_integer', ['field' => 'status']);
        }

        if (!isset($data['cpu_usage']) || !is_float($data['cpu_usage'])) {
            $errors['cpu_usage'] = __('validation.errors.required_float', ['field' => 'cpu_usage']);
        }

        if (!isset($data['memory_usage']) || !is_float($data['memory_usage'])) {
            $errors['memory_usage'] = __('validation.errors.required_float', ['field' => 'memory_usage']);
        }

        if (!isset($data['last_checked']) || !is_string($data['last_checked']) || empty($data['last_checked'])) {
            $errors['last_checked'] = __('validation.errors.required_date', ['field' => 'last_checked']);
        }

        if (!isset($data['is_monitored']) || !is_bool($data['is_monitored'])) {
            $errors['is_monitored'] = __('validation.errors.required_boolean', ['field' => 'is_monitored']);
        }
        
        if (!empty($errors)) {
            throw new ValidationException(__('validation.errors.invalid_data'), $errors);
        }
    }
}
