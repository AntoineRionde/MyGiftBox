<?php

namespace gift\app\actions;

use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;

class PayBoxProcessAction extends AbstractAction
{
//TODO à compléter
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $routeContext = RouteContext::fromRequest($request);

        if($request->getMethod() === 'POST'){
            $cardNumber=filter_var($request->getParsedBody()['card-number'],FILTER_SANITIZE_NUMBER_INT);

        }
    }
}