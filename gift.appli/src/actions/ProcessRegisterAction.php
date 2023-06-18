<?php

namespace gift\app\actions;

use gift\app\services\auth\AuthService;
use gift\app\services\user\UserService;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;

class ProcessRegisterAction extends AbstractAction
{

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $routeContext = RouteContext::fromRequest($request);
        $urlRegister = $routeContext->getRouteParser()->urlFor('register');
        $urlUserAlreadyExist = $routeContext->getRouteParser()->urlFor('register', [], ['error' => 'userAlreadyExist']);
        $urlPasswordNotEnoughStrong = $routeContext->getRouteParser()->urlFor('register', [],['error' => 'passwordNotEnoughStrong']);
        $urlPasswordNotMatch = $routeContext->getRouteParser()->urlFor('register', [],['error' => 'passwordNotMatch']);


        if ($request->getMethod() === 'POST') {
            $email = filter_var($request->getParsedBody()['email'], FILTER_SANITIZE_EMAIL);
            $password = htmlspecialchars($request->getParsedBody()['password']);
            $confirm_password = htmlspecialchars($request->getParsedBody()['confirm_password']);

            $authService = new AuthService();
            $isRegistered = $authService->register($email, $password, $confirm_password);

            if ($isRegistered === 1) {
                $urlLogin = $routeContext->getRouteParser()->urlFor('login');
                $url = $response->withHeader('location', $urlLogin)->withStatus(302);
            } else if ($isRegistered === 0) {
                $url =  $response->withHeader('location', $urlUserAlreadyExist)->withStatus(302);
            } else if ($isRegistered === -1) {
                $url = $response->withHeader('location', $urlPasswordNotEnoughStrong)->withStatus(302);
            } else {
                $url = $response->withHeader('location', $urlPasswordNotMatch)->withStatus(302);
            }

            return $url;
        }
        return $response->withHeader('Location', $urlRegister)->withStatus(302);
    }
}