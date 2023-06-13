<?php
declare(strict_types=1);

use gift\api\actions\GetBoxByIdAction;
use gift\api\actions\GetCategorieByIdAction;
use gift\api\actions\GetCatgoriesAction;
use gift\api\actions\GetPrestationsAction;
use gift\api\actions\GetPrestationsByCategorieAction;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\App;

return function (App $app):void {
    /* home */
    /* consulter les prestations */

    $app->get('/categories[/]', GetCatgoriesAction::class)->setName('categories');

    $app->get('/categories/{id:\d+}/prestations', GetPrestationsByCategorieAction::class)->setName('categ2prestas');

    $app->get('/prestations[/]', GetPrestationsAction::class)->setName('prestations');

    $app->get('/categories/{id:\d+}[/]', GetCategorieByIdAction::class)->setName('categ');

    $app->get('/boxes/{id}[/]', GetBoxByIdAction::class)->setName('box');

};