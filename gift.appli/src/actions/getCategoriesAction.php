<?php

namespace gift\app\actions;

use gift\app\services\prestations\PrestationsServices;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;

class getCategoriesAction extends AbstractAction
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $prestationsServices = new PrestationsServices();
        $categories = $prestationsServices->getCategories();

        $view = Twig::fromRequest($request);
        $view->render($response, 'categories.twig', ['categories' => $categories]);

        return $response;
    }
}