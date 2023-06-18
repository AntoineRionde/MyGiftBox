<?php

namespace gift\api\services\prestations;
use Exception;
use Throwable;

class PrestationsServicesException extends Exception
{
    public function __construct(string $message = "invalidData", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}