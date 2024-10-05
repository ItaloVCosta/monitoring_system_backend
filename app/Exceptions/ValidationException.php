<?php

namespace App\Exceptions;

use Exception;

class ValidationException extends Exception
{
    protected $errors;

    public function __construct($message = "validation.error", $errors = [], $code = 422)
    {
        parent::__construct(__($message), $code); 
        $this->errors = array_map(fn($error) => __($error), $errors); 
    }

    public function getErrors()
    {
        return $this->errors;
    }
}