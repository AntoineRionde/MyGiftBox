<?php

namespace gift\app\services\prestations;

class PrestationsServicesException extends \Exception
{
    public function __construct($message = "", $code = 0, \Throwable $previous = null)
    {
        $message = "PrestationsServicesException : " . $message;
        parent::__construct($message, $code, $previous);
    }
}