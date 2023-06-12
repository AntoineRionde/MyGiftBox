<?php

namespace gift\app\services\Auth;

//TODO à compléter
class Auth
{
    //Authentification
    public static function authenticate(string $email, string $pass):void {

    }

    public static function loadProfile(string $email): void {

    }

    //Inscription
    private static function checkPassStrength(string $pass, int $min):bool {
        $status = false;

        return $status;
    }

    public static function register(string $email, string $pass): void {

    }

    //contrôle d'accès
    public static function checkAccessLevel(int $required): void {

    }

    public static function checkOwner(int $oId): void {

    }

    //Activation
    private static function generateActivitionToken(string $email): string {
        $token = '';

        return $token;
    }

    public static function activate(string $token): bool {
        $isActivate = false;

        return $isActivate;
    }

}