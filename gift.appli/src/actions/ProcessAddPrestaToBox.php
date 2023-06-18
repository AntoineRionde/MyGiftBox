<?php

namespace gift\app\actions;

use gift\app\services\box\BoxService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;

class ProcessAddPrestaToBox extends AbstractAction
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE)
            session_start();
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): Response
    {
        $routeParser = RouteContext::fromRequest($request)->getRouteParser();
        $loginUrl = $routeParser->urlFor('login', [], ['error' => 'userNotConnected']);
        $urlBoxForm = $routeParser->urlFor('boxCreateForm', [], ['error' => 'boxNotFound']);
        $urlPrestations = $routeParser->urlFor('prestations', [], ['error' => 'errorInAddPrestaToBox']);

        if ($request->getMethod() === 'POST') {

            $quantity = $request->getParsedBody()['quantite'];
            $quantity = (int)$quantity;
            if ($quantity === 0){
                return $response->withHeader('Location', $urlPrestations)->withStatus(302);
            }

            if (!isset($args['presta_id'])) {
                return $response->withHeader('Location', $urlPrestations)->withStatus(302);
            }

            if (!isset($_SESSION['user'])) {
                return $response->withHeader('Location', $loginUrl)->withStatus(302);
            }

            if (!isset($_SESSION['box_token'])) {
                return $response->withHeader('Location', $urlBoxForm)->withStatus(302);
            }

            $box_token = $_SESSION['box_token'];
            $user = $_SESSION['user'];
            $presta_id = $args['presta_id'];
            $boxService = new BoxService();
            try {
                $boxService->isOwner($box_token, $user['id']);
                $boxService->addPresta($box_token, $presta_id, $quantity);
                $url = $routeParser->urlFor('box', ['box_token' => $box_token]);
            } catch (\Exception $e) {
                $url = $routeParser->urlFor('prestations', [], ['error' => $e->getMessage()]);
            }
            return $response->withHeader('Location', $url)->withStatus(302);
        }
        $url = $routeParser->urlFor('prestations', [], ['error' => 'postError']);

        return $response->withHeader('Location', $url)->withStatus(302);
    }
}