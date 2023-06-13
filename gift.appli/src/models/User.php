<?php

namespace gift\app\models;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users'; // Nom de la table dans la base de données

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'firstname',
        'email',
        'password'
    ];

    protected $hidden = [
        'password',
        'activation_token',
        'is_active'
    ];

    public function boxes()
    {
        return $this->hasMany(Box::class, 'box_id');
    }

    public function setPassword(string $password): void
    {
        $this->attributes['password'] = password_hash($password, PASSWORD_DEFAULT);
    }

    public function activate(): void
    {
        $this->attributes['is_active'] = true;
        $this->attributes['activation_token'] = null;
    }
}