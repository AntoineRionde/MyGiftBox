<?php

namespace gift\app\actions;

use Exception;
use gift\app\services\box\BoxService;
use gift\app\services\prestations\PrestationsServices;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;

class GetBoxByIdAction extends AbstractAction
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE)
            session_start();
    }

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $routeContext = RouteContext::fromRequest($request);
        $urlHome = $routeContext->getRouteParser()->urlFor('home');

        if (!isset($args['box_token'])) {
            return $response->withHeader('Location', $urlHome)->withStatus(302);
        }

        $user_id = $_SESSION['user']['id'];

        $token = (string)$args['box_token'];
        $boxServices = new BoxService();
        $isOwner = true;

        try {
            $boxServices->isOwner($token, $user_id);
        } catch (Exception $e) {
            $isOwner = false;
        }

        $prestations = $boxServices->getPrestationsByBoxToken($token);
        foreach ($prestations as $key => $value) {
            $prestationsServices = new PrestationsServices();
            $categorieLibelle = $prestationsServices->getCategorieById($value['cat_id']);
            $prestations[$key]['cat_libelle'] = $categorieLibelle['libelle'];
        }

        $basePath = RouteContext::fromRequest($request)->getBasePath();
        $css_dir = $basePath . "/styles";
        $img_dir = $basePath . "/img";
        $shared_dir = $basePath . "/shared/img";
        $resources = ['css' => $css_dir, 'img' => $img_dir, 'shared' => $shared_dir, 'isConnected' => isset($_SESSION['user'])];
        $view = Twig::fromRequest($request);
        $view->render($response, 'box.twig', ['prestations' => $prestations, 'token' => $token, 'isOwner' => $isOwner, 'resources' => $resources]);
        return $response;
    }
}