<?php

namespace gift\app\services\utils;

class CsrfService
{
    /**
     * @throws \Exception
     */
    static function generate(): string
    {
        $token = bin2hex(random_bytes(32));
        $_SESSION['csrf'] = $token;
        return $token;
    }

    // compare le token recu à celui stocké en session et lève une exception en cas d'échec, et supprime le token en session
    static function check(string $token): void
    {
        if (!isset($_SESSION['csrf']) || $_SESSION['csrf'] !== $token) {
            throw new \Exception("CSRF token verification failed");
        }
        unset($_SESSION['csrf']);
    }
}