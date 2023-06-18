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
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE)
        session_start();
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): Response
    {
        $routeContext = RouteContext::fromRequest($request);
        $urlLogin = $routeContext->getRouteParser()->urlFor('login');
        /*if (!isset($_SESSION['user'])) {
            return  $response->withHeader('Location', $urlLogin)->withStatus(302);
        }*/

        $data = $request->getParsedBody();
        $box['libelle'] = filter_var($data['libelle'], FILTER_SANITIZE_SPECIAL_CHARS);
        $box['description'] = filter_var($data['description'], FILTER_SANITIZE_SPECIAL_CHARS);
        $box['kdo'] = $data['kdo'] == 'on' ? 1 : 0;
        $box['message_kdo'] = filter_var($data['message_kdo'], FILTER_SANITIZE_SPECIAL_CHARS);
        $boxService = new BoxService();
        $box = $boxService->createEmptyBox($box);
        $url = $routeContext->getRouteParser()->urlFor('box', ['box_id' => $box['id']]);

        return $response->withHeader('location', $routeContext->urlFor($url))->withStatus(302);
    }
}