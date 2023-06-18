<?php

namespace gift\api\services\box;

use Exception;
use Throwable;

class BoxServiceInvalidDataException extends Exception {
    public function __construct(string $message = "invalidData", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}