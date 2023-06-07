<?php

namespace gift\app\actions;

use gift\app\services\utils\CsrfService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\Twig;

class BoxCreateFormAction extends AbstractAction
{

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): Response
    {
        $view = Twig::fromRequest($request);
        $token = CsrfService::generate();
        return $view->render($response, 'boxCreateView.twig', ['token' => $token]);
    }
}