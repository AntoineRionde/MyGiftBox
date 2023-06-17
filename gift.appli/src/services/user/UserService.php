<?php

namespace gift\app\services\user;

use Exception;
use gift\app\models\Categorie;
use gift\app\models\User;

class UserService
{

    function getUser(){
        $users = Categorie::all();
        return $users;
    }

    public function IsUserExist(string $email)
    {
        $user = User::where('email', $email)->first();
        return (bool)$user;
    }

}