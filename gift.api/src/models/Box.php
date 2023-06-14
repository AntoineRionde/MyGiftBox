<?php
namespace gift\api\models;
use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    protected $table = 'box';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public $incrementing = false;
    public $keyType = 'string';

    CONST CREATED = 1;
    CONST VALIDATED = 2;
    CONST PAYED = 3;
    CONST DELIVERED = 4;
    CONST USED = 5;

    public function prestations()
    {
        //return $this->belongsToMany('gift\models\Prestation', 'box2presta', 'box_id', 'presta_id');
        return $this->belongsToMany(Prestation::class, 'box2presta', 'box_id', 'presta_id')
            ->withPivot('quantite')
            ->as('contenu');
    }
}