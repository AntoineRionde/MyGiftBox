<?php
namespace gift\app\actions;

use gift\app\services\box\BoxService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;

class ProcessBoxCreateAction extends AbstractAction
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

        if (!isset($_SESSION['user'])) {
            return  $response->withHeader('Location', $urlLogin)->withStatus(302);
        }

        $data = $request->getParsedBody();
        $boxService = new BoxService();
        $box = $boxService->createEmptyBox($data);
        $_SESSION['box_id'] = $box['id'];
        $url = $routeContext->getRouteParser()->urlFor('prestations');

        return $response->withHeader('location', $routeContext->getRouteParser()->urlFor($url))->withStatus(302);
    }
}