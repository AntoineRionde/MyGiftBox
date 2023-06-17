<?php

class Auth
{
    // Authentification
    public static function authenticate(string $email, string $pass) : void {
        // TODO: ajouter une classe User dans models
        $user = User::where('email', $email)->first();
        if ($user == null) {
            throw new AuthException("User not found");
        }
        if (!password_verify($pass, $user->password)) {
            throw new AuthException("Bad password");
        }
        $_SESSION['user'] = $user;
    }

    public static function loadProfile(string $email) : void {
        $user = User::where('email', $email)->first();
        if ($user == null) {
            throw new AuthException("User not found");
        }
        $_SESSION['user'] = $user;
    }

    // Inscription
    private static function checkPassStrength(string $pass, int $minLength) : bool {
        return strlen($pass) >= $minLength;
    }

    public static function register(string $email, string $pass) : void {
        if (!self::checkPassStrength($pass, 8)) {
            throw new AuthException("Password too weak");
        }
        $user = User::where('email', $email)->first();
        if ($user != null) {
            throw new AuthException("User already exists");
        }
        $user = new User();
        $user->email = $email;
        $user->password = password_hash($pass, PASSWORD_DEFAULT);
        $user->save();
        $_SESSION['user'] = $user;
    }

    // Controle d'accès
    public static function checkAccessLevel(int $required): void{
        if (!isset($_SESSION['user'])) {
            throw new AuthException("User not logged in");
        }
        $user = $_SESSION['user'];
        if ($user->access_level < $required) {
            throw new AuthException("Access level too low");
        }
    }

    public static function checkOwner(int $oId): void {
        if (!isset($_SESSION['user'])) {
            throw new AuthException("User not logged in");
        }
        $user = $_SESSION['user'];
        if ($user->id != $oId) {
            throw new AuthException("Not owner");
        }
    }

    // Activation
    private static function generateActivationToken(string $email): string {
        return hash('sha256', $email . time());
    }

    public static function activate(string $token): bool {
        $user = User::where('activation_token', $token)->first();
        if ($user == null) {
            return false;
        }
        $user->activation_token = null;
        $user->save();
        return true;
    }

}