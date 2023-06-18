<?php

namespace gift\app\actions;

use gift\app\services\box\BoxService;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;

class BoxDeletePrestaProcessAction extends AbstractAction
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
        $urlHome = $routeContext->getRouteParser()->urlFor('home', [], ['error' => 'PrestaOrBoxNotFound']);
        if (!isset($_SESSION['user'])) {
            return $response->withHeader('Location', $urlLogin)->withStatus(302);
        }
        if (!isset($args['box_token'])) {
            return $response->withHeader('Location', $urlHome)->withStatus(302);
        }
        if (!isset($_GET['presta'])){
            return $response->withHeader('Location', $urlHome)->withStatus(302);
        }

        $boxService = new BoxService();
        $box = $boxService->getBoxByToken($args['box_token']);
        if ($box == null) {
            return $response->withHeader('Location', $urlHome)->withStatus(302);
        }
        $url = $routeContext->getRouteParser()->urlFor('box', ['box_token' => $box['token']]);

        $presta_id = $_GET['presta'];
        $boxService->deletePresta($box['token'], $presta_id);

        $_SESSION['box_token'] = $box['token'];

        return $response->withHeader('location', $url)->withStatus(302);
    }
}