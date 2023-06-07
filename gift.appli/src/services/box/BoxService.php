<?php
namespace gift\app\services\box;
use gift\app\models\Box;
use gift\app\services\utils\CsrfService;
use Ramsey\Uuid\Uuid;

class BoxService
{
    function CreateBoxEmpty(array $data)
    {
        $libelle = $data['libelle'];
        $description = $data['description'];
        $kdo = $data['kdo'];
        $message_kdo = $data['message_kdo'];
        $url = $data['url'];
        $box = new Box();
        $box->libelle = $libelle;
        $box->description = $description;
        $box->kdo = $kdo;
        $box->message_kdo = $message_kdo;
        $box->url = $url;
        $box->token = CsrfService::generate();
        $box->status = Box::CREATED;
        $box->id = Uuid::uuid4()->toString();
        $_SESSION['box_id'] = $box->id;
        $box->save();
        return $box;
    }

    function addPrestaToBox(string $box_id, string $presta_id)
    {
        $box = Box::find($box_id);
        $box->prestations()->attach($presta_id);
        $box->save();
        return $box;
    }
}