<?php

namespace gift\app\actions;

use gift\app\services\prestations\PrestationsServices;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\Twig;

class getPrestationsActions
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $prestationsServices = new PrestationsServices();
        $prestations = $prestationsServices->getPrestations();
        $view = Twig::fromRequest($request);
        return $view->render($response, 'prestations.twig', ['prestations' => $prestations]);;
    }

}