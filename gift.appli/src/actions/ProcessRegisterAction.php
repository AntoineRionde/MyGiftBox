<?php

namespace gift\app\actions;

use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;

class ProcessRegisterAction extends AbstractAction
{

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $routeContext = RouteContext::fromRequest($request);
        $url = $routeContext->getRouteParser()->urlFor('home');

        //TODO : filtrer les valeurs

        if($request->getMethod() === 'POST'){
            $username = $request->getParsedBody()['username'];
            $password = $request->getParsedBody()['password'];
            $confirm_password = $request->getParsedBody()['confirm_password'];
        }

        //récupérer les datas
        if ($password === $confirm_password){
            $data = [
                'username' => $username,
                'password' => $password,
                'role' => 0,
            ];
        }

        //créer un nouvelle user

        //insérer le user dans la bd

        return $response->withHeader('Location', $url)->withStatus(302);
    }
}