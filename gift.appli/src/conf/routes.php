<?php
declare(strict_types=1);

use gift\app\actions\addPrestaToBoxAction;
use gift\app\actions\BoxCreateFormAction;
use gift\app\actions\BoxCreateProcessAction;
use gift\app\actions\createCategorieAction;
use gift\app\actions\getCategorieByIdAction;
use gift\app\actions\getCategoriesAction;
use gift\app\actions\getApiCategoriesAction;
use gift\app\actions\getHomeAction;
use gift\app\actions\getPrestationByIdAction;
use gift\app\actions\getPrestationsActions;
use gift\app\actions\getApiPrestationsActions;
use gift\app\actions\loginAction;
use gift\app\actions\updatePrestationByIdAction;
use Slim\App;
return function (App $app) {

    $app->get('/', getHomeAction::class)->setName('home');

    $app->get('/categories', getCategoriesAction::class)->setName('categories');

    $app->get('/categorie/{id}', getCategorieByIdAction::class)->setName('categorie');

    $app->get('/categories/create', createCategorieAction::class)->setName('createCategorieGet');

    $app->post('/categories/create', createCategorieAction::class)->setName('createCategoriePost');

    $app->get('/prestations', getPrestationsActions::class)->setName('prestations');

    $app->get('/prestation/{id}', getPrestationByIdAction::class)->setName('prestation');

    $app->get('/prestation/{id}/update', updatePrestationByIdAction::class)->setName('updatePrestationGet');

    $app->post('/prestation/{id}/update', updatePrestationByIdAction::class)->setName('updatePrestationPost');

    $app->get('/box/create[/]', BoxCreateFormAction::class)->setName('boxCreateForm');
    $app->post('/box/create[/]', BoxCreateProcessAction::class)->setName('boxCreatePost');
    $app->get('/box/add/{presta_id}[/]', addPrestaToBoxAction::class)->setName('boxAddPresta');

    $app->get('/register[/]', RegisterAction::class)->setName("register");
    $app->post('/register-action[/]', ProcessRegisterAction::class)->setName("registerAction");

    $app->get('/login[/]', LoginAction::class)->setName("login");
    $app->post('/login-action[/]', ProcessLoginAction::class)->setName("loginAction");

    $app->get('/api/prestations', getApiPrestationsActions::class)->setName('prestations');

    $app->get('/api/categories', getApiCategoriesAction::class)->setName('categories');

};