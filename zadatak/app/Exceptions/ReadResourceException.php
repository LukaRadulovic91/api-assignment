<?php

namespace App\Exceptions;

use Exception;

class ReadResourceException extends Exception
{
    public function __construct($message = "Failed to retrieve resource", $code = 404, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
