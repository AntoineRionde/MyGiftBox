<?php

class PrestationNotFoundException extends \Exception
{
    public function __construct($message = "", $code = 0, \Throwable $previous = null)
    {
        $message = "PrestationNotFoundException : " . $message;
        parent::__construct($message, $code, $previous);
    }
}