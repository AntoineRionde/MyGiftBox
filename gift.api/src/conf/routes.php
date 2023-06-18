<?php
declare(strict_types=1);

use Slim\App;
use gift\api\actions\getApiBoxActions;
use gift\api\actions\getApiPrestationsActions;
use gift\api\actions\getApiCategoriesAction;
use gift\api\actions\getApiPrestationByCategorieAction;
return function (App $app) {

    $app->get('/api/prestations', GetApiPrestationsActions::class)->setName('prestations');

    $app->get('/api/categories', GetApiCategoriesAction::class)->setName('categories');

    $app->get('/api/categories/{id}/prestation', GetApiPrestationByCategorieAction::class)->setName('prestationsByCategorie');

    $app->get('/api/coffrets/{id}', GetApiBoxActions::class)->setName('boxById');

};