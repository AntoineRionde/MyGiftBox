<?php
declare(strict_types=1);


use gift\api\actions\getApiCategoriesAction;
use gift\api\actions\getApiPrestationsActions;
use Slim\App;
return function (App $app) {

    $app->get('/api/categories[/]', getApiCategoriesAction::class)->setName('categories');

    $app->get('/api/categorie/{id}/prestation', getApiPrestationCategorieByIdAction::class)->setName('prestations-catgeorie');

    $app->get('/api/prestations[/]', getApiPrestationsActions::class)->setName('prestations');

    $app->get('/api/coffrets/{id}', getApiBoxActions::class)->setName('coffret');

};