<?php
declare(strict_types=1);

use gift\app\actions\BoxCreateFormAction;
use gift\app\actions\BoxCreateProcessAction;
use gift\app\actions\createCategorieAction;
use gift\app\actions\getCategorieByIdAction;
use gift\app\actions\getApiCategoriesAction;
use gift\app\actions\getHomeAction;
use gift\app\actions\getPrestationByIdAction;
use gift\app\actions\getApiPrestationsActions;
use gift\app\actions\updatePrestationByIdAction;
use Slim\App;
return function (App $app) {

    $app->get('/api/categories[/]', getApiCategoriesAction::class)->setName('categories');

    $app->get('/api/categorie/{id}/prestation', getApiPrestationCategorieByIdAction::class)->setName('prestations-catgeorie');

    $app->get('/api/prestations[/]', getApiPrestationsActions::class)->setName('prestations');

    $app->get('/api/coffrets/{id}', getApiBoxActions::class)->setName('coffret');

};