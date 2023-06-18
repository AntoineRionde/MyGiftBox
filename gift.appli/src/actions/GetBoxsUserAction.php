<?php

namespace gift\app\actions;

use gift\app\services\box\BoxService;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;

class GetBoxsUserAction extends AbstractAction
{

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $routeContext = RouteContext::fromRequest($request);
        $urlLogin = $routeContext->getRouteParser()->urlFor('login');
        if (!isset($_SESSION['user'])) {
            return $response->withHeader('Location', $urlLogin)->withStatus(302);
        }

        $view = Twig::fromRequest($request);
        $user = $_SESSION['user'];
        $boxService = new BoxService();
        $boxs = $boxService->getBoxsIdByUserId($user->getId());
        return $view->render($response, 'boxsUser.twig', ['boxs' => $boxs]);

    }
}