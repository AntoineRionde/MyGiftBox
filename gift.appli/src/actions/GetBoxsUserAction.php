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
        $basePath = RouteContext::fromRequest($request)->getBasePath();
        $css_dir = $basePath . "/styles";
        $img_dir = $basePath . "/img";
        $shared_dir = $basePath . "/shared/img";
        $resources = ['css' => $css_dir, 'img' => $img_dir, 'shared' => $shared_dir];

        $routeContext = RouteContext::fromRequest($request);
        $urlLogin = $routeContext->getRouteParser()->urlFor('login');
        if (!isset($_SESSION['user'])) {
            return $response->withHeader('Location', $urlLogin)->withStatus(302);
        }

        $view = Twig::fromRequest($request);
        $userId = $_SESSION['user']['id'];
        $boxService = new BoxService();
        $boxs = $boxService->getBoxsIdByUserId($userId);
        // ajouter toutes les prestations de chaque box
        $prestations = [];
        foreach ($boxs as $box) {
            $prestations[$box['id']] = $boxService->getPrestationsByBoxId($box['id']);
        }
        var_dump($boxs);
//        echo $userId;
        return $view->render($response, 'boxsUser.twig', ['boxs' => $boxs, 'prestations' => $prestations, 'resources' => $resources]);

    }
}