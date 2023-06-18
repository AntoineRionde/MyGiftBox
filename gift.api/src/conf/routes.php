<?php
declare(strict_types=1);

use gift\api\actions\GetApiBoxAction;
use gift\api\actions\GetApiCategoriesAction;
use gift\api\actions\GetApiPrestationByCategorieAction;
use gift\api\actions\GetApiPrestationsAction;

use Slim\App;

return function (App $app) {

    $app->get('/api/categories', GetApiCategoriesAction::class)->setName('apiCategories');
    $app->get('/api/prestations', GetApiPrestationsAction::class)->setName('apiPrestations');
    $app->get('/api/prestations/{cat_id}', GetApiPrestationByCategorieAction::class)->setName('apiPrestationsByCategorieId');
    $app->get('/api/box/{box_id}', GetApiBoxAction::class)->setName('apiBoxById');
};