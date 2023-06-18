<?php

namespace gift\app\actions;

use gift\app\services\box\BoxService;
use gift\app\services\box\BoxServiceInvalidDataException;
use gift\app\services\box\BoxServiceNotFoundException;
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
        $urlLogin = $routeContext->getRouteParser()->urlFor('login');
        $urlHome = $routeContext->getRouteParser()->urlFor('home');
        $urlHomeNotOwner = $routeContext->getRouteParser()->urlFor('home', [], ['error' => 'notOwner']);
        /*if (!isset($_SESSION['user'])) {
            return  $response->withHeader('Location', $urlLogin)->withStatus(302);
        }*/
        if (!isset($args['box_id'])) {
            return $response->withHeader('Location', $urlHome)->withStatus(302);
        }

        $id = (string) $args['box_id'];
        $boxServices = new BoxService();
        $box = $boxServices->getBoxById($id);

        try {
            $boxServices->checkOwner($box);
        } catch (BoxServiceInvalidDataException $e) {
            return $response->withHeader('Location', $urlHomeNotOwner)->withStatus(302);
        }

        $prestations = $boxServices->getPrestationsByBoxId($id);

        $basePath = RouteContext::fromRequest($request)->getBasePath();
        $css_dir = $basePath . "/styles";
        $img_dir = $basePath . "/img";
        $shared_dir = $basePath . "/shared/img";
        $resources = ['css' => $css_dir, 'img' => $img_dir, 'shared' => $shared_dir, 'user' => $_SESSION['user'] ?? null];
        $view = Twig::fromRequest($request);
        $view->render($response, 'box.twig', ['prestations' => $prestations, 'resources' => $resources]);
        return $response;
    }
}