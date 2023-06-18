<?php

namespace gift\app\actions;

use gift\app\services\box\BoxService;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;

class GetBoxsUserAction extends AbstractAction
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE)
            session_start();
    }

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $routeContext = RouteContext::fromRequest($request);
        $urlLogin = $routeContext->getRouteParser()->urlFor('login', [], ['error' => 'UserNotFound']);
        if (!isset($_SESSION['user'])) {
            return $response->withHeader('Location', $urlLogin)->withStatus(302);
        }

        $view = Twig::fromRequest($request);
        $userId = $_SESSION['user']['id'];
        $boxService = new BoxService();
        try {
            $boxs = $boxService->getBoxsIdByUserId($userId);
        } catch (\Exception $e) {
            $url = $routeContext->getRouteParser()->urlFor('boxCreateForm', [], ['error' => $e->getMessage()]);
            return $response->withHeader('Location', $url)->withStatus(302);
        }

        $basePath = RouteContext::fromRequest($request)->getBasePath();
        $css_dir = $basePath . "/styles";
        $img_dir = $basePath . "/img";
        $shared_dir = $basePath . "/shared/img";
        $resources = ['css' => $css_dir, 'img' => $img_dir, 'shared' => $shared_dir, 'isConnected' => isset($_SESSION['user'])];
        return $view->render($response, 'boxsUser.twig', ['boxs' => $boxs, 'resources' => $resources]);

    }
}