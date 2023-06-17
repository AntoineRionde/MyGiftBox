<?php

namespace gift\app\actions;

use gift\app\services\box\BoxService;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;

class addPrestaToBoxAction extends AbstractAction
{

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): Response
    {
        $routeParser = RouteContext::fromRequest($request)->getRouteParser();
        $urlBoxForm = $routeParser->urlFor('boxCreateForm');
        $urlPrestations = $routeParser->urlFor('prestations');
        if (!isset($args['box_id'])) {
            return $response->withHeader('Location', $urlBoxForm)->withStatus(401);
        }

        if (!isset($args['presta_id'])) {
            return $response->withHeader('Location', $urlPrestations)->withStatus(405);
        }

        $box_id = $args['box_id'];
        $presta_id = $args['presta_id'];
        $boxService = new BoxService();
        $boxService->addPrestaToBox($box_id, $presta_id);
        $url = $routeParser->urlFor('box', ['box_id' => $box_id]);
        return $response->withHeader('Location', $url)->withStatus(302);
    }
}