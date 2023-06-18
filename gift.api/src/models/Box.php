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
    public $fillable = ['id', 'token', 'libelle', 'description', 'montant', 'kdo', 'message_kdo', 'statut', 'created_at', 'created_at', 'updated_at', 'user_id'];

    CONST CREATED = 1;
    CONST VALIDATED = 2;
    CONST PAYED = 3;
    CONST DELIVERED = 4;
    CONST USED = 5;

    public function prestations()
    {
        return $this->belongsToMany(Prestation::class, 'box2presta', 'box_id', 'presta_id')
            ->withPivot('quantite')
            ->as('contenu');
    }

    public function user()
    {
        return $this->belongsTo(User::class);//'gift\app\models\User');
    }
}