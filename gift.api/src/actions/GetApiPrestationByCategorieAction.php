<?php
namespace gift\api\actions;

use gift\api\services\prestations\PrestationsServices;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
class GetApiPrestationByCategorieAction extends AbstractAction
{

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $id = $args['cat_id'];
        $prestationsServices = new PrestationsServices();
        $prestationCategorie = $prestationsServices->getPrestationsByCategorie($id);
        $response->getBody()->write(json_encode($prestationCategorie));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}