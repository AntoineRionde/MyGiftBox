<?php

namespace gift\app\actions;

use gift\app\services\prestations\PrestationsServices;
use gift\app\services\utils\CsrfService;
use Slim\Exception\HttpBadRequestException;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;

class createCategorieAction extends AbstractAction
{

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $prestationsServices = new PrestationsServices();
        $categorie = $prestationsServices->getCategories();
        $routeContext = RouteContext::fromRequest($request);

        $url = $routeContext->getRouteParser()->urlFor('categories');
        $categorie['url'] = $url;
        $view = Twig::fromRequest($request);

        if ($request->getMethod() === 'POST') {
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
        } else {
            $token = CsrfService::generate();
            return $view->render($response, 'create_categorie.twig', ['categories' => $categorie, 'token' => $token]);
        }
    }
}