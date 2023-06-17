<?php

namespace gift\app\services\utils;

class CsrfService
{
    public static function generate() : string
    {
        $token = base64_encode(random_bytes(32));
        $_SESSION['csrf_token'] = $token;
        return $token;
    }

    public static function check(string $token) : bool
    {
        if (isset($_SESSION['csrf_token']) && $token === $_SESSION['csrf_token']) {
            unset($_SESSION['csrf_token']);
            return true;
        }
        return false;
    }

}