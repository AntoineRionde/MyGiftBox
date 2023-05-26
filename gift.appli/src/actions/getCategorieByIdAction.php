<?php

namespace gift\app\actions;

use gift\app\services\prestations\PrestationsServices;
use gift\app\services\prestations\PrestationsServicesException;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\Twig;

class getCategorieByIdAction extends AbstractAction
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        if (!isset($args['id'])) {
            throw new PrestationsServicesException("Categorie id is null", 400, null);
        }
        $id = (int) $args['id'];
        $prestationsServices = new PrestationsServices();
        $cat = $prestationsServices->getCategorieById($id);
        $prestations = $prestationsServices->getPrestationsByCategorie($id);
        $view = Twig::fromRequest($request);
        $data = [
            'cat' => $cat,
            'prestations' => $prestations
        ];
        return $view->render($response, 'categorie.twig', $data);
    }
}