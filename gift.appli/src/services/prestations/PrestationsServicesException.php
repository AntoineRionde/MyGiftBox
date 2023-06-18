<?php

namespace gift\app\services\prestations;
use Exception;

class PrestationsServicesException extends Exception
{
    public function __construct(string $message = "invalidData", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}