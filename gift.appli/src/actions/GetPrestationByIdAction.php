<?php

namespace gift\app\actions;

use gift\app\services\prestations\PrestationsServices;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;

class GetPrestationByIdAction extends AbstractAction
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE)
            session_start();
    }

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $routeContext = RouteContext::fromRequest($request);
        $urlPrestations = $routeContext->getRouteParser()->urlFor('prestations', [], ['error'=> 'prestaNotFound']);
        if (!isset($args['id'])) {
            return $response->withHeader('Location', $urlPrestations)->withStatus(302);
        }
        $id = (string)$args['id'];
        $prestations = new PrestationsServices();
        $prestation = $prestations->getPrestationById($id);
        $prestation['cat_libelle'] = $prestations->getCategorieById($prestation['cat_id'])['libelle'];

        $basePath = RouteContext::fromRequest($request)->getBasePath();
        $css_dir = $basePath . "/styles";
        $img_dir = $basePath . "/img";
        $shared_dir = $basePath . "/shared/img";
        $resources = ['css' => $css_dir, 'img' => $img_dir, 'shared' => $shared_dir, 'isConnected' => isset($_SESSION['user'])];
        $view = Twig::fromRequest($request);
        $view->render($response, 'prestation.twig', ['presta' => $prestation, 'resources' => $resources]);
        return $response;
    }
}
