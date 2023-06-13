<?php
declare(strict_types=1);

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

return function (\Slim\App $app):void {
    /* home */
    /* consulter les prestations */

    $app->get('/categories[/]', \gift\api\actions\GetCatgoriesAction::class)->setName('categories');

    $app->get('/categories/{id:\d+}/prestations', \gift\api\actions\GetPrestationsByCategorieAction::class)->setName('categ2prestas');

    $app->get('/prestations[/]', \gift\api\actions\GetPrestationsAction::class)->setName('prestations');

    $app->get('/categories/{id:\d+}[/]', \gift\api\actions\GetCategorieByIdAction::class)->setName('categ');

    $app->get('/boxes/{id}[/]', \gift\api\actions\GetBoxByIdAction::class)->setName('box');

};