<?php
namespace gift\app\actions;

use gift\app\services\box\BoxService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;

class BoxCreateProcessAction extends AbstractAction
{

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): Response
    {
        $data = $request->getParsedBody();
        $data['libelle'] = filter_var($data['libelle'], FILTER_SANITIZE_SPECIAL_CHARS);
        $data['description'] = filter_var($data['description'], FILTER_SANITIZE_SPECIAL_CHARS);
//        $data['kdo'] = filter_var($data['kdo'], FILTER_SANITIZE_SPECIAL_CHARS);
        $data['message_kdo'] = filter_var($data['message_kdo'], FILTER_SANITIZE_SPECIAL_CHARS);
        $data['url'] = filter_var($data['url'], FILTER_SANITIZE_SPECIAL_CHARS);
        $boxService = new BoxService();
        $box = $boxService->CreateEmptyBox($data);
        $routeParser = RouteContext::fromRequest($request)->getRouteParser();
        //$url = $routeParser->urlFor('box', ['id' => $box['id']]);
        return $response->withHeader('location', $routeParser->urlFor('home'))->withStatus(302); // >withHeader('Location', $url);
    }
}