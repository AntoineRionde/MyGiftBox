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
        $urlPrestations = $routeParser->urlFor('prestations', [], ['error' => 'prestaNotFound']);

        if ($request->getMethod() === 'POST') {
            $quantite = $request->getParsedBody()['quantite'];
            if ($quantite === 0 || $quantite === null){
                return $response->withHeader('Location', $urlPrestations)->withStatus(302);
            }

            if (!isset($args['presta_id'])) {
                return $response->withHeader('Location', $urlPrestations)->withStatus(302);
            }

            if (!isset($_SESSION['user'])) {
                return $response->withHeader('Location', $loginUrl)->withStatus(302);
            }

            if (!isset($_SESSION['box_id'])) {
                return $response->withHeader('Location', $urlBoxForm)->withStatus(302);
            }

            $box_id = $_SESSION['box_id'];
            $user = $_SESSION['user'];
            $presta_id = $args['presta_id'];
            $boxService = new BoxService();

            try {
                $boxService->isOwner($box_id, $user['id']);
                $boxService->addPresta($box_id, $presta_id,);
                $url = $routeParser->urlFor('box', ['box_id' => $box_id]);
            } catch (\Exception $e) {
                $url = $routeParser->urlFor('prestations', [], ['error' => $e->getMessage() === 'NotOwnerBox' ? 'NotOwnerBox' : 'prestaNotFound']);
            }
        }
        $url = $routeParser->urlFor('prestations', [], ['error' => 'postError']);

        return $response->withHeader('Location', $url)->withStatus(302);
    }
}