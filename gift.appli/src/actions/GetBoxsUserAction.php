<?php

namespace gift\app\actions;

use gift\app\services\box\BoxService;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\Twig;

class GetBoxsUserAction extends AbstractAction
{

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $view = Twig::fromRequest($request);
        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];
            $boxService = new BoxService();
            $boxs = $boxService->getBoxsIdByUserId($user->getId());
            return $view->render($response, 'boxsUser.html.twig', ['boxs' => $boxs]);
        } else {
            return $view->render($response, 'login.html.twig');
        }
    }
}