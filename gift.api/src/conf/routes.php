<?php
declare(strict_types=1);

use Slim\App;
use gift\api\actions\getApiBoxActions;
return function (App $app) {

    $app->get('/api/prestations', gift\api\actions\GetApiPrestationsActions::class)->setName('prestations');

    $app->get('/api/categories', gift\api\actions\GetApiCategoriesAction::class)->setName('categories');

    $app->get('/api/categories/{id}/prestation', gift\api\actions\GetApiPrestationByCategorieAction::class)->setName('prestationByCategorie');

    $app->get('/api/coffrets/{id}', GetApiBoxActions::class)->setName('boxById');

};