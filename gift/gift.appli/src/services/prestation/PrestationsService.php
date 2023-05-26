<?php
namespace gift\app\services\prestation;

use gift\app\models\Categorie;
use gift\app\models\Prestation;
use gift\app\services\utils\Eloquent;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Slim\Exception\HttpBadRequestException;

class PrestationsService
{
    public function __construct()
    {
        Eloquent::init('conf.ini');
    }

    public function getCategories() : array
    {
        $categories = Categorie::all();
        $tab = [];
        foreach ($categories as $categorie) {
            $tab[] = $categorie->toArray();
        }
        return $tab;
    }

    public function getPrestations(): array
    {
        $prestations = Prestation::all();
        $tab = [];
        foreach ($prestations as $prestation) {
            $tab[] = $prestation->toArray();
        }
        return $tab;
    }

    public function getCategorieById(int $id): array
    {
        try {
            return Categorie::findOrFail($id)->toArray();
        } catch (ModelNotFoundException $e) {
            throw new PrestationServiceNotFoundException("Categorie $id inconnu");
        }
    }

    public function getPrestationById(string $id): array
    {
        try {
            return Prestation::findOrFail($id)->toArray();
        }
        catch (ModelNotFoundException $e) {
            throw new PrestationServiceNotFoundException("Prestation $id inconnu");
        }
    }

    public function getPrestationsbyCategorie(int $categ_id):array
    {
        try {
            $prestations = Prestation::where('cat_id', $categ_id)->get();
            $tab = [];
            foreach ($prestations as $prestation) {
                $tab[] = $prestation->toArray();
            }
            return $tab;
        }
        catch (ModelNotFoundException $e) {
            throw new PrestationServiceNotFoundException("Categorie $categ_id inconnu");
        }
    }

//    public function getPrestationsbyCategorieId(int $id):array
//    {
//        try {
//            return Categorie::findOrFail($id)->prestations()->toArray();
//        }
//        catch (ModelNotFoundException $e) {
//            throw new PrestationServiceNotFoundException("Prestation $id inconnu");
//        }
//    }



    public function updatePrestationsById(string $id, array $attributs) : array
    {
        try {
            $prestation = Prestation::findOrFail($id);
            $prestation->libelle = $attributs['libelle'];
            $prestation->description = $attributs['description'];
            $prestation->prix = $attributs['prix'];
            $prestation->save();
            return $prestation->toArray();
        }
        catch (ModelNotFoundException $e) {
            throw new PrestationServiceNotFoundException("Prestation $id inconnu");
        }
    }

    // définir ou modifier la catégorie d'une prestation. La méthode reçoit l'ID de la
    //prestation et l'ID de sa catégorie. On prendra soin d'utiliser les méthodes
    //d'association définies sur les modèles Eloquent.
    public function updatePrestationCategorie(string $id, int $categ_id) : array
    {
        try {
            $prestation = Prestation::findOrFail($id);
            $prestation->categorie()->associate($categ_id);
            $prestation->save();
            return $prestation->toArray();
        }
        catch (ModelNotFoundException $e) {
            throw new PrestationServiceNotFoundException("Prestation $id inconnu");
        }
    }

    // créer une catégorie. la méthode retourne l'ID de la nouvelle catégorie.
    public function createCategorie(array $attributs) : int
    {
        $categorie = new Categorie();
        $categorie->libelle = $attributs['libelle'];
        $categorie->description = $attributs['description'];
        $categorie->save();
        return $categorie->id;
    }

    // supprimer une catégorie
    public function deleteCategorie(int $id) : void
    {
        try {
            $categorie = Categorie::findOrFail($id);
            $categorie->delete();
        }
        catch (ModelNotFoundException $e) {
            throw new PrestationServiceNotFoundException("Categorie $id inconnu");
        }
    }

}