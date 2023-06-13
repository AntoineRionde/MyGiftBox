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
    /**
     * @param string $pass le mdp entré pas l'utilisateur
     * @param int $min taille minimale du mdp
     * @return bool True ou False si les condtions du mdp sont remplies ou pas
     */
    private static function checkPassStrength(string $pass, int $min):bool {

        $errors = []; // Tableau pour stocker les messages d'erreur

        // Vérifiez la force du mot de passe en utilisant des expressions régulières
        $uppercase = preg_match('/[A-Z]/', $pass); // Vérifie la présence d'au moins une majuscule
        $lowercase = preg_match('/[a-z]/', $pass); // Vérifie la présence d'au moins une minuscule
        $number = preg_match('/[0-9]/', $pass); // Vérifie la présence d'au moins un chiffre
        $specialChars = preg_match('/[^a-zA-Z0-9]/', $pass); // Vérifie la présence d'au moins un caractère spécial
        $length = strlen($pass) >= 8; // Vérifie que le mot de passe a au moins 8 caractères de longueur

        if (!$uppercase) {
            $errors[] = "Le mot de passe doit contenir au moins une majuscule.";
        }

        if (!$lowercase) {
            $errors[] = "Le mot de passe doit contenir au moins une minuscule.";
        }

        if (!$number) {
            $errors[] = "Le mot de passe doit contenir au moins un chiffre.";
        }

        if (!$specialChars) {
            $errors[] = "Le mot de passe doit contenir au moins un caractère spécial.";
        }

        if (!$length) {
            $errors[] = "Le mot de passe doit avoir une longueur d'au moins 8 caractères.";
        }

        if (!empty($errors)) {
            // Afficher tous les messages d'erreur
            foreach ($errors as $error) {
                echo $error;
            }
            return false;
        }

        return true;
    }

    /**
     * @param string $email
     * @param string $pass
     * @return void
     * permet de s'inscire sur le site
     * penser à checker l'unicité de mail dans la table User de la BD
     * pernser à checker la robustesse du mdp avec la méthode CheckPassStrength
     */
    public static function register(string $email, string $pass): void {

    }

    //contrôle d'accès
    public static function checkAccessLevel(int $required): void {

    }

    public static function checkOwner(int $oId): void {

    }

    //Activation
    private static function generateActivitionToken(string $email): string {
        $token = bin2hex(random_bytes(32));
        return 'https://'.$_SERVER['HTTP_HOST'].'activate.php'."?token=$token";
    }

    public static function activate(string $token): bool {
        $isActivate = false;

        return $isActivate;
    }

}