<?php

namespace App\Exceptions;

use Exception;

class CreateResourceException extends Exception
{
    public function __construct($message = "Failed to create resource", $code = 400, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
