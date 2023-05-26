<?php

namespace gift\app\actions;

use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;

class getHomeAction extends AbstractAction
{

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $view = Twig::fromRequest($request);
        $view->render($response, 'home.twig');
        return $response;
    }
}