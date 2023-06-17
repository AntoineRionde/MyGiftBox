<?php

namespace gift\app\models;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $keyType = 'string';
    public $timestamps = false;
    public $fillable = ['id', 'nom', 'prenom', 'username', 'password', 'role', 'active', 'activation_token', 'activation_expires', 'renew_token', 'renew_expires'];
}