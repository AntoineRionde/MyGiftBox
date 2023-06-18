<?php

namespace gift\app\actions;

use gift\app\services\prestations\PrestationsServices;
use gift\app\services\utils\CsrfService;
use Slim\Exception\HttpBadRequestException;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;

class CreateCategorieAction extends AbstractAction
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
        $urlCategories = $routeContext->getRouteParser()->urlFor('categories');
        if ($request->getMethod() !== 'POST') {
            return $response->withHeader('Location', $urlCategories)->withStatus(302);
        }
        if (!isset($_SESSION['user'])) {
            return $response->withHeader('Location', $urlLogin)->withStatus(302);
        }

        $prestationsServices = new PrestationsServices();
        $categorie = $prestationsServices->getCategories();
        $routeContext = RouteContext::fromRequest($request);

        $url = $routeContext->getRouteParser()->urlFor('categories');
        $categorie['url'] = $url;
        $view = Twig::fromRequest($request);


        $data = $request->getParsedBody();
        $data['libelle'] = filter_var($data['libelle'], FILTER_SANITIZE_STRING);
        $data['description'] = filter_var($data['description'], FILTER_SANITIZE_STRING);
        try {
            CsrfService::check($data['token']);
        } catch (\Exception $e) {
            throw new HttpBadRequestException($request, 'csrf token error');
        }
        $prestationsServices->createCategorie($data);
        return $response->withStatus(302)->withHeader('Location', $url);

    }
}