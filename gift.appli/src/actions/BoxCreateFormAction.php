<?php

namespace gift\app\actions;

use gift\app\services\utils\CsrfService;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;

class BoxCreateFormAction extends AbstractAction
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE)
        session_start();
    }

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $view = Twig::fromRequest($request);
        $token = CsrfService::generate();

        $user_id = $_SESSION['user']['id'];

        $basePath = RouteContext::fromRequest($request)->getBasePath();
        $css_dir = $basePath . "/styles";
        $img_dir = $basePath . "/img";
        $shared_dir = $basePath . "/shared/img";
        $resources = ['css' => $css_dir, 'img' => $img_dir, 'shared' => $shared_dir, 'isConnected' => isset($_SESSION['user'])];
        return $view->render($response, 'boxCreate.twig', ['token' => $token, 'user_id' => $user_id , 'resources' => $resources]);
    }
}