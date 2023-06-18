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
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE)
        session_start();
    }

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $routeContext = RouteContext::fromRequest($request);
        $urlLogin = $routeContext->getRouteParser()->urlFor('login');

        if ($request->getMethod() === 'POST') {
            $email = filter_var($request->getParsedBody()['email'], FILTER_SANITIZE_EMAIL);
            $password = htmlspecialchars($request->getParsedBody()['password']);

            if (isset($_SESSION['target_url'])) {
                $url = $_SESSION['target_url'];
                unset($_SESSION['target_url']);
            } else {
                $url = $routeContext->getRouteParser()->urlFor('home');
            }


            $authService = new AuthService();

            try {
                $authService->authenticate($email, $password);
            } catch (Exception $e) {
                $url = $routeContext->getRouteParser()->urlFor('login', [], ['error' => $e->getMessage()]);
            }

            return $response->withHeader('Location', $url)->withStatus(302);
        }
        return $response->withHeader('Location', $urlLogin)->withStatus(302);
    }
}