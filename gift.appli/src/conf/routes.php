<?php
declare(strict_types=1);


use gift\app\actions\AddPrestaToBoxAction;
use gift\app\actions\BoxCreateFormAction;
use gift\app\actions\BoxCreateProcessAction;
use gift\app\actions\CreateCategorieAction;
use gift\api\actions\getApiCategoriesAction;
use gift\api\actions\getApiPrestationsActions;
use gift\app\actions\GetBoxByIdAction;
use gift\app\actions\GetCategorieByIdAction;
use gift\app\actions\GetCategoriesAction;
use gift\app\actions\GetHomeAction;
use gift\app\actions\GetPrestationByIdAction;
use gift\app\actions\GetPrestationsAction;
use gift\app\actions\GetProfile;
use gift\app\actions\LoginAction;
use gift\app\actions\LogoutAction;
use gift\app\actions\PayBoxAction;
use gift\app\actions\PayBoxProcessAction;
use gift\app\actions\ProcessLoginAction;
use gift\app\actions\ProcessRegisterAction;
use gift\app\actions\RegisterAction;
use gift\app\actions\UpdatePrestationByIdAction;
use Slim\App;
return function (App $app) {

    $app->get('/', GetHomeAction::class)->setName('home');

    $app->get('/categories', GetCategoriesAction::class)->setName('categories');

    $app->get('/categorie/{id}', GetCategorieByIdAction::class)->setName('categorie');

    $app->get('/categories/create', CreateCategorieAction::class)->setName('createCategorieGet');

    $app->post('/categories/create', CreateCategorieAction::class)->setName('createCategoriePost');

    $app->get('/prestations', GetPrestationsAction::class)->setName('prestations');

    $app->get('/prestation/{id}', GetPrestationByIdAction::class)->setName('prestation');

    $app->get('/prestation/{id}/update', UpdatePrestationByIdAction::class)->setName('updatePrestationGet');

    $app->post('/prestation/{id}/update', UpdatePrestationByIdAction::class)->setName('updatePrestationPost');

    $app->get('/box/create', BoxCreateFormAction::class)->setName('boxCreateForm');

    $app->post('/box/create', BoxCreateProcessAction::class)->setName('boxCreatePost');

    $app->get('/box/pay[/]', PayBoxAction::class)->setName('payBoxForm');

    $app->post('/box/pay[/]', PayBoxProcessAction::class)->setName('payBoxPost');

    $app->get('/box/{box_id}', GetBoxByIdAction::class)->setName('box');

    $app->get('/box/add/{presta_id}', AddPrestaToBoxAction::class)->setName('boxAddPresta');

    $app->get('/register', RegisterAction::class)->setName("register");
    $app->post('/register', ProcessRegisterAction::class)->setName("registerAction");

    $app->get('/login', LoginAction::class)->setName("login");
    $app->post('/login-action', ProcessLoginAction::class)->setName("loginAction");

    $app->get('/logout', LogoutAction::class)->setName("logout");
    $app->get('/profile', GetProfile::class)->setName("profile");

    $app->get('/api/prestations', getApiPrestationsActions::class)->setName('prestations');

    $app->get('/api/categories', getApiCategoriesAction::class)->setName('categories');

};