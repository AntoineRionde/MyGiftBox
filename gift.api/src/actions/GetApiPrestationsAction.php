<?php

namespace gift\api\actions;

use gift\api\services\prestations\PrestationsServices;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class GetApiPrestationsAction extends AbstractAction
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $prestationsServices = new PrestationsServices();
        $prestations = $prestationsServices->getPrestations();

        $data = ['prestations' => $prestations];
        $response->getBody()->write(json_encode($data));
        return
            $response->withHeader('Content-Type', 'application/json')
                ->withStatus(200);
    }

}