<?php

namespace gift\app\actions;

use gift\app\services\box\BoxService;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;

class AddPrestaToBoxAction extends AbstractAction
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE)
        session_start();
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): Response
    {
        $routeParser = RouteContext::fromRequest($request)->getRouteParser();
        $loginUrl = $routeParser->urlFor('login', [], ['error' => 'userNotFound']);
        $urlBoxForm = $routeParser->urlFor('boxCreateForm', [], ['error' => 'boxNotFound']);
        $urlPrestations = $routeParser->urlFor('prestations', [], ['error' => 'prestaNotFound']);
        $urlBoxs = $routeParser->urlFor('boxs', [], ['error' => 'NotOwnerBox']);
        if (!isset($args['presta_id'])) {
            return $response->withHeader('Location', $urlPrestations)->withStatus(302);
        }

        if (!isset($_SESSION['user'])) {
            return $response->withHeader('Location', $loginUrl)->withStatus(302);
        }

        if (!isset($_SESSION['box_id'])){
            return $response->withHeader('Location', $urlBoxForm)->withStatus(302);
        }

        $box_id = $_SESSION['box_id'];
        $user = $_SESSION['user'];
        $presta_id = $args['presta_id'];
        $boxService = new BoxService();

        if (!$boxService->isOwner($box_id, $user['id'])){
            return $response->withHeader('Location', $urlBoxs)->withStatus(302);
        }

        $boxService->addPresta($box_id, $presta_id);
        $url = $routeParser->urlFor('box', ['box_id' => $box_id]);
        return $response->withHeader('Location', $url)->withStatus(302);
    }
}