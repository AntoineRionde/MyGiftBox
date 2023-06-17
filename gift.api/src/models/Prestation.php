<?php

namespace gift\api\models;

use Illuminate\Database\Eloquent\Model;

class Prestation extends Model
{
    protected $table = 'prestation';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $incrementing = false;
    public $keyType = 'string';
    public $fillable = ['id', 'libelle', 'description', 'url', 'unite', 'tarif', 'img', 'cat_id'];

    public function boxs()
    {
        return $this->belongsToMany(Box::class, 'box2presta', 'presta_id', 'box_id');
    }

    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'cat_id');
    }
}