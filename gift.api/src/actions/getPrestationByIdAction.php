<?php

namespace gift\app\actions;

use gift\app\services\prestations\PrestationsServices;
use gift\app\services\prestations\PrestationsServicesException;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\Twig;

class getPrestationByIdAction extends AbstractAction
{

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        if (!isset($args['id'])) {
            throw new PrestationsServicesException("id is null", 400, null);
        }
        $id = (string)$args['id'];
        $prestations = new PrestationsServices();
        $prestation = $prestations->getPrestationById($id);

        $view = Twig::fromRequest($request);
        $view->render($response, 'prestation.twig', ['presta' => $prestation]);
        return $response;
    }
}
