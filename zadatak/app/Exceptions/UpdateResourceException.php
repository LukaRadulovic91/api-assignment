<?php

namespace App\Exceptions;

use Exception;

class UpdateResourceException extends Exception
{
    public function __construct($message = "Failed to update resource", $code = 400, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
