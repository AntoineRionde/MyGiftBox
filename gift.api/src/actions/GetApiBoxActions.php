<?php

namespace gift\api\actions;

use gift\api\services\box\BoxService;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class getApiBoxActions extends AbstractAction
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $id = $args['id'];
        $boxService = new BoxService();
        $box = $boxService->getBoxById($id);
        $response->getBody()->write(json_encode($box));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}