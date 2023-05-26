<?php

use gift\app\Actions\CategorieCreateAction;
use gift\app\Actions\PrestationIdAction;
use gift\app\Actions\PrestationsAction;
use gift\app\models\Categorie;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use gift\app\Actions\CategoriesAction as CategoriesAction;
use gift\app\Actions\CategoriesIdAction as CategoriesIdAction;
use Slim\App as App;

define("CATEGS", [
    1 =>['libelle'=>'restauration', 'description'=>'les restos quoa'],
    2 =>['libelle'=>'hébergement', 'description'=>'les hotels, chambres quoa'],
    3 =>['libelle'=>'attention', 'description'=>'les trucs qui font plaizz'],
    4 =>['libelle'=>'activité', 'description'=>'les trucs à faire']
]);
define("PRESTA", [
    "ABCD"=>['libelle'=>'diner', 'description'=>'diner de gala', 'tarif'=>100, 'unite'=>'par personne'],
    "EFGH"=>['libelle'=>'déjeuner', 'description'=>'déjeuner de gala', 'tarif'=>50, 'unite'=>'par personne'],
    "IJKL"=>['libelle'=>'saut parachute', 'description'=>'un saut en parachute filmé', 'tarif'=>400, 'unite'=>'par personne'],
    "MNOP"=>['libelle'=>'massage', 'description'=>'un massage de 1h', 'tarif'=>100, 'unite'=>'par personne'],
]);

return function (App $app) {
    $app->addErrorMiddleware(true, false, false);

    $app->get('/', function (Request $request, Response $response, array $args) {
        $response->getBody()->write("Hello world!");
        return $response;
    });


    $app->get('/categories', CategoriesAction::class)
    ->setName('categories');

    $app->get('/categorie/{id}', CategoriesIdAction::class)
    ->setName('categorie');

    $app->get('/prestation/{id}', PrestationIdAction::class)
    ->setName('prestationId');

    $app->get('/prestations', PrestationsAction::class)
    ->setName('prestations');

    $app->get('/categories/create', CategorieCreateAction::class)
    ->setName('categorieCreate');

    $app->post('/categories/create', CategorieCreateAction::class)
        ->setName('categorieCreatePost');

};