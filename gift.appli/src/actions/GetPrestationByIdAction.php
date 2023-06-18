<?php

namespace gift\app\actions;

use gift\app\services\prestations\PrestationsServices;
use gift\app\services\prestations\PrestationsServicesException;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;

class GetPrestationByIdAction extends AbstractAction
{

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        if (!isset($args['id'])) {
            throw new PrestationsServicesException("id is null", 400, null);
        }
        $id = (string)$args['id'];
        $prestations = new PrestationsServices();
        $prestation = $prestations->getPrestationById($id);
        $prestation['cat_libelle'] = $prestations->getCategorieById($prestation['cat_id'])['libelle'];

        $basePath = RouteContext::fromRequest($request)->getBasePath();
        $css_dir = $basePath . "/styles";
        $img_dir = $basePath . "/img";
        $shared_dir = $basePath . "/shared/img";
        $resources = ['css' => $css_dir, 'img' => $img_dir, 'shared' => $shared_dir, 'user' => $_SESSION['user'] ?? null];
        $view = Twig::fromRequest($request);
        $view->render($response, 'prestation.twig', ['presta' => $prestation, 'resources' => $resources]);
        return $response;
    }
}
