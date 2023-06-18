<?php
declare(strict_types=1);


use Slim\App;
return function (App $app) {

    $app->get(gift\api\actions\getApiPrestationsActions::class, '/api/prestations')->setName('prestations');

    $app->get('/api/categories', gift\api\actions\getApiCategoriesAction::class)->setName('categories');

    $app->get('/api/categories/{id}/prestation', gift\api\actions\getApiPrestationByCategorieAction::class)->setName('prestationByCategorie');

    $app->get('/api/coffrets/{id}', gift\api\actions\getApiBoxActions::class)->setName('boxById');

};