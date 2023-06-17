<?php

namespace gift\app\actions;

use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;

class GetHomeAction extends AbstractAction
{

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $basePath = RouteContext::fromRequest($request)->getBasePath() ;
        $css_dir = $basePath . "/styles";
        $img_dir = $basePath . "/img";
        $shared_dir = $basePath . "/shared/img";
        $resources = ['css' => $css_dir, 'img' => $img_dir, 'shared' => $shared_dir];
        $view = Twig::fromRequest($request);
        $view->render($response, 'home.twig', ['resources' => $resources]);
        return $response;
    }
}