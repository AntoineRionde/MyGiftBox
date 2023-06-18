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
        $post_data = $request->getParsedBody();
        $token = $post_data['token'] ?? null;

        try {
            CsrfService::check($token);
        } catch (\Exception $e) {
            throw new HttpBadRequestException($request, 'csrf token error');
        }

        $categ_data = [
            'libelle' => $post_data['libelle'] ??
                throw new HttpBadRequestException($request, 'libelle is missing'),
            'description' => $post_data['description'] ??
                throw new HttpBadRequestException($request, 'description is missing')
        ];
        $prestationService = new PrestationsServices();
        $prestationService->createCategorie($categ_data);

        $routeParser = RouteContext::fromRequest($request)->getRouteParser();
        $url = $routeParser->urlFor('categories');
        return $response->withHeader('Location', $url)->withStatus(302);
    }
}