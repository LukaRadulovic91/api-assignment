<?php

namespace App\Exceptions;

use Exception;

class DeleteResourceException extends Exception
{
    public function __construct($message = "Failed to delete resource", $code = 400, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
