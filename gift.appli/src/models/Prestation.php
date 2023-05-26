<?php

namespace gift\app\models;

use Illuminate\Database\Eloquent\Model;

class Prestation extends Model
{
    protected $table = 'prestation';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $incrementing = false;
    public $keyType = 'string';

    public function boxs()
    {
        return $this->belongsToMany(Box::class, 'box2presta', 'presta_id', 'box_id');
    }

    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'cat_id');
    }
}