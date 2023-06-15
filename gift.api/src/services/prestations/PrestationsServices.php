<?php

use gift\api\models\Categorie;
use gift\api\models\Prestation;
use gift\api\services\prestations\PrestationsServicesException;

class PrestationsServices
{
    public function getCategories(): array
    {
        $categories = Categorie::all();
        $categoriesArray = [];
        foreach ($categories as $categorie) {
            $categoriesArray[] = [
                'id' => $categorie->id,
                'libelle' => $categorie->libelle,
                'description' => $categorie->description,
            ];
        }
        return $categoriesArray;
    }

    public function getCategorieById(int $id): array
    {
        try {
            $categorie = Categorie::findOrFail($id);
        } catch (Throwable $e) {
            throw new PrestationsServicesException("Categorie not found", 404, $e);
        }
        return [
            'id' => $categorie->id,
            'libelle' => $categorie->libelle,
            'description' => $categorie->description,
        ];
    }

    public function getPrestations() : array {
        $prestations = Prestation::all();
        $prestationsArray = [];
        foreach ($prestations as $prestation) {
            $prestationsArray[] = [
                'id' => $prestation->id,
                'libelle' => $prestation->libelle,
                'description' => $prestation->description,
                'url' => $prestation->url,
                'unite' => $prestation->unite,
                'tarif' => $prestation->tarif,
                'img' => $prestation->img,
                'cat_id' => $prestation->categorie->id
            ];
        }
        return $prestationsArray;
    }

    public function getPrestationById(string $id): array
    {
        try {
            $pres = Prestation::findOrFail($id);
        } catch (Throwable $e) {
            throw new PrestationsServicesException("Prestation not found", 404, $e);
        }

        return [
            'id' => $pres->id,
            'libelle' => $pres->libelle,
            'description' => $pres->description,
            'url' => $pres->url,
            'unite' => $pres->unite,
            'tarif' => $pres->tarif,
            'img' => $pres->img,
            'cat_id' => $pres->categorie->id
        ];
    }

    public function getPrestationsByCategorie(int $cat_id): array
    {
        $prestations = Prestation::where('cat_id', '=', $cat_id)->get();
        $prestationsArray = [];
        foreach ($prestations as $prestation) {
            $prestationsArray[] = [
                'id' => $prestation->id,
                'libelle' => $prestation->libelle,
                'description' => $prestation->description,
                'url' => $prestation->url,
                'unite' => $prestation->unite,
                'tarif' => $prestation->prix,
                'img' => $prestation->img,
                'cat_id' => $prestation->categorie_id
            ];
        }
        return $prestationsArray;
    }

    public function updatePrestationById(string $id, array $data)
    {
        try {
            $prestation = Prestation::findOrFail($id);
        } catch (Throwable $e) {
            throw new PrestationsServicesException("Prestation not found", 404, $e);
        }
        $prestation->libelle = $data['libelle']?? null;
        $prestation->description = $data['description']?? null;
        $prestation->url = $data['url'] ?? null;
        $prestation->unite = $data['unite']?? null;
        $prestation->tarif = $data['tarif']?? null;
        $prestation->img = $data['img']?? null;
        $prestation->save();
    }

    public function updateCategorieOfPrestationById(string $id, int $cat_id){
        try {
            $prestation = Prestation::findOrFail($id);
            $categorie = Categorie::findOrFail($cat_id);
        } catch (Throwable $e) {
            throw new PrestationsServicesException("Prestation or Categorie id not found", 404, $e);
        }
        $prestation->categorie()->associate($cat_id);
        $prestation->save();
    }

    public function createCategorie(array $data): int
    {
        if ($data['libelle'] != filter_var($data['libelle'], FILTER_SANITIZE_SPECIAL_CHARS)) {
            throw new PrestationsServicesException("Invalid libelle");
        }
        if ($data['description'] != filter_var($data['description'], FILTER_SANITIZE_SPECIAL_CHARS)) {
            throw new PrestationsServicesException("Invalid description");
        }
        $categorie = new Categorie();
        $categorie->libelle = $data['libelle']?? null;
        $categorie->description = $data['description']?? null;
        $categorie->save();
        return $categorie->id;
    }

    public function deleteCategorie(int $id)
    {
        try {
            $categorie = Categorie::findOrFail($id);
        } catch (Throwable $e) {
            throw new PrestationsServicesException("Categorie not found", 404, $e);
        }
        $categorie->delete();
    }
}