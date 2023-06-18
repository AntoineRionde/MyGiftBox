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

        if($request->getMethod() === 'POST'){
            $cardNumber=filter_var($request->getParsedBody()['card-number'],FILTER_SANITIZE_NUMBER_INT);
            $date=filter_var($request->getParsedBody()['expiration-date'],FILTER_SANITIZE_STRING);
            $cvv=filter_var($request->getParsedBody()['cvv'],FILTER_SANITIZE_NUMBER_INT);
        }

        $boxService = new BoxService();

        try {
            $boxService->payBox();
            $url = $routeContext->getRouteParser()->urlFor('home');
        }catch (Exception $exception) {
            $url = $routeContext->getRouteParser()->urlFor('payBoxForm', [], ['error' => 'invalid payment information']);
        }

        return $response->withHeader('Location', $url)->withStatus(302);
    }
}