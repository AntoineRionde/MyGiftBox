<?php

namespace gift\api\services\auth;

use Exception;
use gift\api\models\User;

class AuthService
{

    //connexion
    /**
     * @param string $email
     * @param string $passwd2check
     * @return void
     * gère la connexion d'un user
     * @throws Exception
     */
    public function authenticate(string $email, string $passwd2check): void {

        $hash = User::where('email', $email)->pluck('password')->first();

        $passhash = password_hash($hash, PASSWORD_DEFAULT, ['cost'=> 12]);

        if (!password_verify($passwd2check, $passhash))
            throw new \Exception("Auth error : invalid credentials");

    }


    //Inscription
    /**
     * @param string $email
     * @param string $pass
     * @param string $confirmPass
     * @return void
     * permet de s'inscire sur le site
     * @throws Exception
     */
    public function register(string $email, string $pass): void {


    }


    /**
     * @param string $pass le mdp entré pas l'utilisateur
     * @param int $min taille minimale du mdp
     * @return bool True ou False si les condtions du mdp sont remplies ou pas
     */
    public function checkPasswordStrength(string $pass,
                                          int $min): bool {
        $length = (strlen($pass) < $min); // longueur minimale
        $digit = preg_match("#[\d]#", $pass); // au moins un digit
        $special = preg_match("#[\W]#", $pass); // au moins un car. spécial
        $lower = preg_match("#[a-z]#", $pass); // au moins une minuscule
        $upper = preg_match("#[A-Z]#", $pass); // au moins une majuscule
        if (!$length || !$digit || !$special || !$lower || !$upper)return false;
        return true;
    }

    //Activation
    /**
     * @param string $email
     * @return string
     * @throws Exception
     * génère une token d'activation
     */
    private function generateActivitionToken(string $email): string {
        $token = bin2hex(random_bytes(64));
        return 'https://'.$_SERVER['HTTP_HOST'].'activate.php'."?token=$token";
    }

    /**
     * @param string $token
     * @return bool
     * active un compte utilisateur
     */
    public static function activate(string $token): bool {
        $isActivate = false;

        return $isActivate;
    }


}