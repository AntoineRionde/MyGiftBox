<?php

namespace gift\api\models;

use gift\api\models\Prestation;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    protected $table = 'categorie';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $fillable = ['libelle', 'description'];

    public function prestations()
    {
        return $this->hasMany(Prestation::class, 'cat_id');
    }
}