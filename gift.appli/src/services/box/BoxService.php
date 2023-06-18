<?php
namespace gift\app\services\box;
use gift\app\models\Box;
use gift\app\models\Prestation;
use gift\app\services\utils\CsrfService;
use gift\app\services\utils\Eloquent;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use PHPUnit\Exception;
use Ramsey\Uuid\Uuid;

class BoxService
{
    public function deletePresta(string $box_id, string $presta_id)
    {
        $box = Box::find($box_id);
        $box->prestations()->detach($presta_id);
        $box->save();
        return $box;
    }

    public function createEmptyBox(array $data) : array
    {
        if (!isset($data['libelle']))
        {
            throw new BoxServiceInvalidDataException("Libelle is missing", 400);
        }
        $libelle = filter_var($data['libelle'], FILTER_SANITIZE_SPECIAL_CHARS);
        $kdo = $data['cadeau'] ?? 'off';
        $description = filter_var($data['description'] ?? 'pas de description', FILTER_SANITIZE_SPECIAL_CHARS);
        $statut = Box::CREATED;
        $montant = 0;
        $message_kdo = filter_var($data['cadeau'] ? $data['message_kdo'] : '', FILTER_SANITIZE_SPECIAL_CHARS);
        $token = CsrfService::generate();
        $box = new Box();
        $box->id = Uuid::uuid4()->toString();
        $box->libelle = $libelle;
        $box->kdo = $kdo === 'on' ? 1 : 0;
        $box->description = $description;
        $box->montant = $montant;
        $box->message_kdo = $message_kdo;
        $box->token = $token;
        $box->statut = $statut;
        $box->created_at = date_create('now')->format('Y-m-d H:i:s');
        $box->updated_at = date_create('now')->format('Y-m-d H:i:s');
        $box->save();
        $_SESSION['box_id'] = $box->id;
        return $box->toArray();
    }

    public function getBoxById(string $id)
    {
        $box = Box::with('prestations')->findOrFail($id);
        return $box->toArray();
    }

    public function addPresta(string $box_id, string $presta_id, int $quantity)
    {
            $box = Box::with('prestations')->findOrFail($box_id);
            $presta = Prestation::findOrFail($presta_id);
            $boxContent = $box->prestations;
            if ($boxContent->contains($presta)) {
                $box->prestations()->find($presta_id)->pivot->quantite += $quantity;
            } else {
                $box->prestations()->attach($presta_id, ['quantite' => $quantity]);
            }
            $box->montant += $presta->tarif * $quantity;
            $box->save();
    }

    public function getBoxsIdByUserId(int $id) : array
    {
        $boxs = Box::where('user_id', $id)->get();
        return $boxs->toArray();
    }

    public function isOwner(string $box_id, int $user_id) : bool
    {
        $box = Box::findOrFail($box_id);
        if ($box->user_id === $user_id) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param string $box_id
     * @return void
     * payement d'une box
     * @throws BoxServiceNotFoundException
     */
    public function payBox()
    {
        try {
            $box = Box::findOrFail($this);
            $statut = Box::PAYED;
            $box->statut = $statut;
            $box->save();
            $_SESSION['box_id'] = $box->id;
        } catch (Exception $e) {
            throw new BoxServiceNotFoundException("error : box not exist");
        }
    }
}