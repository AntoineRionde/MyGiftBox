<?php

namespace gift\app\actions;

use gift\app\services\box\BoxService;
use PHPUnit\Exception;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;

class PayBoxProcessAction extends AbstractAction
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $routeContext = RouteContext::fromRequest($request);
        $urlLogin = $routeContext->getRouteParser()->urlFor('login');
        $urlPayBox = $routeContext->getRouteParser()->urlFor('payBoxForm', [], ['error' => 'invalidInfos']);
        if (!isset($_SESSION['user'])) {
            return $response->withHeader('Location', $urlLogin)->withStatus(302);
        }
        if ($request->getMethod() !== 'POST') {
            return $response->withHeader('Location', $urlPayBox)->withStatus(302);
        }

        $cardNumber = filter_var($request->getParsedBody()['card-number'], FILTER_SANITIZE_NUMBER_INT);
        $date = filter_var($request->getParsedBody()['expiration-date'], FILTER_SANITIZE_STRING);
        $cvv = filter_var($request->getParsedBody()['cvv'], FILTER_SANITIZE_NUMBER_INT);

        $boxService = new BoxService();

        try {
            $token = $_SESSION['box_token'];
            $boxService->payBox($token);
            $url = $routeContext->getRouteParser()->urlFor('home');
        } catch (Exception $exception) {
            $url = $routeContext->getRouteParser()->urlFor('payBoxForm', [], ['error' => 'invalid payment information']);
        }

        return $response->withHeader('Location', $url)->withStatus(302);
    }
}