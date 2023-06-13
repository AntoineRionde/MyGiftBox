<?php

namespace gift\api\actions;

use gift\app\actions\AbstractAction;
use PrestationsServices;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;

class GetCatgoriesAction extends AbstractAction
{

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $prestaService = new PrestationsServices();
        $categories = $prestaService->getCategories();

        $routeParser = RouteContext::fromRequest($request)->getRouteParser();

        foreach ($categories as $category) {
            $categories_data[] = ['categorie' => $category, 'links' => ['self' => ['href' => $routeParser->urlFor('categ', ['id'=>$category['id']])]]];
        }

        $data = [
            'type' => 'collection',
            'count' => count($categories),
            'categories' => $categories_data
        ];
        $response->getBody()->write(json_encode($data));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}