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
        $box = Box::where('token', $token)->first();
        if (!$box) {
            throw new BoxServiceNotFoundException("boxNotFound", 400);
        }
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
        $box = Box::where('token', $token)->first();
        if (!$box) {
            throw new BoxServiceNotFoundException("boxNotFound", 400);
        }
        return $box->toArray();
    }

    public function addPresta(string $token, string $presta_id, int $quantity) : void
    {
        $box = Box::where('token', $token)->first();
        if (!$box) {
            throw new BoxServiceNotFoundException("boxNotFound", 400);
        }
        $presta = Prestation::findOrFail($presta_id);

        $boxContent = $box->prestations()->get();

        if ($boxContent->contains($presta_id)) {
            $box->prestations()->updateExistingPivot($presta_id, ['quantite' => $quantity]);
        } else {
            $box->prestations()->attach($presta_id, ['quantite' => $quantity]);
        }
        $box->montant += $presta->tarif * $quantity;
        $box->save();
    }

    public function getBoxsIdByUserId(int $id): array
    {
        $boxs = Box::where('user_id', $id)->get();
        if (!$boxs) {
            throw new BoxServiceNotFoundException("boxsNotFound", 400);
        }
        return $boxs->toArray();
    }

    public function isOwner(string $token, int $user_id) : void
    {
        $box = Box::where('token', $token)->first();
        if (!$box) {
            throw new BoxServiceNotFoundException("boxNotFound", 400);
        }
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
            $box = Box::where('token', $token)->first();
            if (!$box) {
                throw new BoxServiceNotFoundException("boxNotFound", 400);
            }
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
        $box = Box::where('token', $token)->first();
        if (!$box) {
            throw new BoxServiceNotFoundException("boxNotFound", 400);
        }
        return $box->prestations->toArray();
    }

    public function getMostRecentBox(int $user_id) : array
    {
        $box = Box::where('user_id', $user_id)->orderBy('updated_at', 'desc')->first();
        if (!$box) {
            throw new BoxServiceNotFoundException("boxNotFound", 400);
        }
        return $box->toArray();
    }


}