<?php

namespace gift\app\models;
use Exception;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users'; // Nom de la table dans la base de données

    protected $primaryKey = 'id'; //int(11) auto-increment

    public $timestamps = false;

    protected $fillable = [
        'name',                 //varchar(256)
        'firstname',            //varchar(256)
        'email',                //varchar(256)
        'password'              //varchar(256)
    ];

    protected $hidden = [
        'password',             //varchar(256)
        'activation_token',     //varchar(128)
        'activation_expires',   //timestamp
        'renew_token',          //varchar(128)
        'renew_expires',        //timestamp
        'is_active',            //tinyint(4) [ 0 ]
        'role',                 //int(4)
        'level'                 //int(4)
    ];

    public function __construct($id, $role, $level)
    {
        //TODO à compléter pour Auth/loadProfile()
    }


    public function boxes()
    {
        return $this->hasMany(Box::class, 'box_id');
    }

    public function setPassword(string $pass)
    {
        $this->attributes['password'] = password_hash($pass, PASSWORD_DEFAULT);
    }

    public function activate(): void
    {
        $this->attributes['is_active'] = true;
        $this->attributes['activation_token'] = null;
    }

    public function hasRole(int $role): bool
    {
        return $this->attributes['role'] === $role;
    }

    public function hasLevel(int $level): bool
    {
        return $this->attributes['level'] >= $level;
    }
}