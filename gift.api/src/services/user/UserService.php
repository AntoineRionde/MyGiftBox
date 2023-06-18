<?php

namespace gift\api\services\user;

use Exception;
use gift\api\models\Categorie;
use gift\api\models\User;

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