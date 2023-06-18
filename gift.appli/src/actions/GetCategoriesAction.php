<?php

namespace gift\app\actions;

use gift\app\services\prestations\PrestationsServices;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;

class GetCategoriesAction extends AbstractAction
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE)
            session_start();
    }

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $routeContext = RouteContext::fromRequest($request);
        $urlLogin = $routeContext->getRouteParser()->urlFor('login');
        if (!isset($_SESSION['user'])) {
            return $response->withHeader('Location', $urlLogin)->withStatus(302);
        }

        $prestationsServices = new PrestationsServices();
        $categories = $prestationsServices->getCategories();
        //get a random image from a prestation of each category
        foreach ($categories as $key => $value) {
            $prestations = $prestationsServices->getPrestationsByCategorie($value['id']);
            $randomPrestation = $prestations[rand(0, count($prestations) - 1)];
            $categories[$key]['img'] = $randomPrestation['img'];
        }

        $basePath = RouteContext::fromRequest($request)->getBasePath();
        $css_dir = $basePath . "/styles";
        $img_dir = $basePath . "/img";
        $shared_dir = $basePath . "/shared/img";
        $resources = ['css' => $css_dir, 'img' => $img_dir, 'shared' => $shared_dir, 'isConnected' => isset($_SESSION['user'])];
        $view = Twig::fromRequest($request);
        $view->render($response, 'categories.twig', ['categories' => $categories, 'resources' => $resources]);

        return $response;
    }
}