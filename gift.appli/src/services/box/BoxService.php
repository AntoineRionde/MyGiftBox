<?php
namespace gift\app\services\box;
use gift\app\models\Box;
use gift\app\services\utils\CsrfService;
use gift\app\services\utils\Eloquent;
use Ramsey\Uuid\Uuid;

class BoxService
{
    public function __construct()
    {
        Eloquent::init('../src/conf/config.ini');
    }

    public function deletePresta(string $box_id, string $presta_id)
    {
        $box = Box::find($box_id);
        $box->prestations()->detach($presta_id);
        $box->save();
        return $box;
    }

    public function CreateBoxEmpty(array $data)
    {
        if (!isset($data['libelle']))
        {
            throw new BoxServiceInvalidDataException("Libelle is missing", 400);
        }
        $libelle = filter_var($data['libelle'], FILTER_SANITIZE_SPECIAL_CHARS);
        $kdo = $data['kdo'] ?? 0;
        $description = filter_var($data['description'] ?? 'pas de description', FILTER_SANITIZE_SPECIAL_CHARS);
        $statut = Box::CREATED;
        $montant = 0;
        $message_kdo = filter_var($data['message_kdo'] ?? 'ceci est un cadeau', FILTER_SANITIZE_SPECIAL_CHARS);
        $token = CsrfService::generate();
        $box = new Box();
        $box->id = Uuid::uuid4()->toString();
        $box->libelle = $libelle;
        $box->kdo = $kdo;
        $box->description = $description;
        $box->montant = $montant;
        $box->message_kdo = $message_kdo;
        $box->token = $token;
        $box->statut = $statut;
        $box->save();
        return $box->toArray();
    }

    public function addPresta(string $box_id, string $presta_id)
    {
        $box = Box::find($box_id);
        $box->prestations()->attach($presta_id);
        $box->save();
        return $box;
    }
}