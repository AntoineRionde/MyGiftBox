<?php

namespace gift\api\actions;

use gift\api\actions\AbstractAction;
use gift\app\services\box\BoxService; //api
use PHPUnit\Exception;
use Slim\Exception\HttpNotFoundException;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class GetBoxByIdAction extends AbstractAction
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $boxService = new BoxService();

        try {
            $box = $boxService->getBoxById($args['id']);
        } catch
        (Exception $e) {
            throw new HttpNotFoundException($request, $e->getMessage());
        }

        $data = ['type' => 'ressource', 'box' => $box];
        $response->getBody()->write(json_encode($data));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}