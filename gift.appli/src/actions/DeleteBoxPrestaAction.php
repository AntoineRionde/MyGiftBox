<?php

namespace gift\app\actions;

use gift\app\services\box\BoxService;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;

class DeleteBoxPrestaAction extends AbstractAction
{

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE)
            session_start();
    }
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $basePath = RouteContext::fromRequest($request)->getBasePath();
        $css_dir = $basePath . "/styles";
        $img_dir = $basePath . "/img";
        $shared_dir = $basePath . "/shared/img";
        $resources = ['css' => $css_dir, 'img' => $img_dir, 'shared' => $shared_dir];

        //TODO à finir
        //comment récupérer l'id de la box courante et l'id de la presteation qu'on veut supprimer
        $boxService = new BoxService();
        $boxService->deletePresta();
    }
}