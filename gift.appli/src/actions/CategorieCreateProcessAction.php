<?php

namespace gift\app\actions;

use gift\app\services\prestations\PrestationsServices;
use gift\app\services\utils\CsrfService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpBadRequestException;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;

class CategorieCreateProcessAction extends AbstractAction
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE)
        session_start();
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): Response
    {
        $routeParser = RouteContext::fromRequest($request)->getRouteParser();
        $urlLogin = $routeParser->urlFor('home', [], ['error' => 'BadUri']);
        if ($request->getMethod() !== 'POST') {
            return  $response->withHeader('Location', $urlLogin)->withStatus(302);
        }

        if (!isset($_SESSION['user'])) {
            return $response->withHeader('Location', $urlLogin)->withStatus(302);
        }

        $post_data = $request->getParsedBody();
        $token = $post_data['token'];

        try {
            CsrfService::check($token);
        } catch (\Exception $e) {
            $url = $routeParser->urlFor('categories', [], ['error' => $e->getMessage()]);
            return $response->withHeader('Location', $url)->withStatus(302);
        }

        $categ_data = [
            'libelle' => $post_data['libelle'] ??
                throw new HttpBadRequestException($request, 'libelle is missing'),
            'description' => $post_data['description'] ??
                throw new HttpBadRequestException($request, 'description is missing')
        ];
        $prestationService = new PrestationsServices();
        $prestationService->createCategorie($categ_data);

        $url = $routeParser->urlFor('categories');
        return $response->withHeader('Location', $url)->withStatus(302);
    }
}