<?php

namespace gift\app\actions;

use Exception;
use gift\app\services\auth\AuthService;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;
use gift\app\services\user\UserService;

class ProcessLoginAction extends AbstractAction
{

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $routeContext = RouteContext::fromRequest($request);

        if($request->getMethod() === 'POST'){
            $email = filter_var($request->getParsedBody()['email'], FILTER_SANITIZE_EMAIL);
            $password = htmlspecialchars($request->getParsedBody()['password']);
        }

        $authService = new AuthService();

        try {
            $authService->authenticate($email, $password);
            $url = $routeContext->getRouteParser()->urlFor('home');
        }catch (Exception $e) {
            $url = $routeContext->getRouteParser()->urlFor('login', [], ['error' => 'wrong email or password']);
        }

        return $response->withHeader('Location', $url)->withStatus(302);
    }
}