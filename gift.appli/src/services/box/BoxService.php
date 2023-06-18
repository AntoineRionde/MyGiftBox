<?php

namespace gift\app\services\box;

use gift\app\models\Box;
use gift\app\models\Prestation;
use gift\app\services\utils\CsrfService;
use PHPUnit\Exception;
use Ramsey\Uuid\Uuid;

class BoxService
{
    public function deletePresta(string $token, string $presta_id)
    {
        $box = Box::find($token);
        $box->prestations()->detach($presta_id);
        $box->save();
        return $box;
    }

    public function createEmptyBox(array $data): array
    {
        if (!isset($data['libelle'])) {
            throw new BoxServiceInvalidDataException("missingLibelle", 400);
        }
        $libelle = filter_var($data['libelle'], FILTER_SANITIZE_SPECIAL_CHARS);
        $description = filter_var($data['description'], FILTER_SANITIZE_SPECIAL_CHARS);
        $kdo = 0;
        if (isset($data['kdo'])) {
            $kdo = $data['kdo'] === 'on' ? 1 : 0;
        }
        if (isset($data['message_kdo'])) {
            $message_kdo = filter_var($data['message_kdo'], FILTER_SANITIZE_SPECIAL_CHARS);
        }
        $montant = 0;
        $statut = Box::CREATED;
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
        $box->user_id = $data['user_id'];
        $box->created_at = date('Y-m-d H:i:s');
        $box->updated_at = date('Y-m-d H:i:s');
        $box->save();
        $_SESSION['box_token'] = $box->token;
        return $box->toArray();
    }

    public function getBoxByToken(string $token): array
    {
        $box = Box::with('prestations')->findOrFail($token);
        return $box->toArray();
    }

    public function addPresta(string $token, string $presta_id, int $quantity) : void
    {
        $box = Box::findOrFail($token);
        $presta = Prestation::findOrFail($presta_id);

        $boxContent = $box->prestations()->get();

        if ($boxContent->contains($presta_id)) {
            $box->prestations()->updateExistingPivot($presta_id, ['quantity' => $quantity]);
        } else {
            $box->prestations()->attach($presta_id, ['quantity' => $quantity]);
        }
        $box->montant += $presta->tarif * $quantity;
        $box->save();
    }

    public function getBoxsIdByUserId(int $id): array
    {
        $boxs = Box::where('user_id', $id)->get();
        return $boxs->toArray();
    }

    public function isOwner(string $token, int $user_id) : void
    {
        $box = Box::findOrFail($token);
        if ($box->user_id !== $user_id) {
            throw new BoxServiceInvalidDataException("notOwner", 400);
        }
    }

    /**
     * @param string $token
     * @return void
     * payement d'une box
     * @throws BoxServiceNotFoundException
     */
    public function payBox($token) : void
    {
        try {
            $box = Box::findOrFail($token);
            $statut = Box::PAYED;
            $box->statut = $statut;
            $box->save();
            $_SESSION['box_id'] = $box->id;
        } catch (Exception $e) {
            throw new BoxServiceNotFoundException("error : box not exist");
        }
    }

    public function getPrestationsByBoxToken(string $token) : array
    {
        $box = Box::with('prestations')->findOrFail($token);
        return $box->prestations->toArray();
    }


}