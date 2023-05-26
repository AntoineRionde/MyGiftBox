<?php

namespace gift\app\Actions;

use gift\app\models\Categorie;
use gift\app\models\Prestation;
use gift\app\services\prestation\PrestationsService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;

class PrestationsAction extends AbstractAction
{

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {

        $prestaService = new PrestationsService();
        $prestas = $prestaService->getPrestations();

        $routeParser = RouteContext::fromRequest($rq)->getRouteParser();
        foreach ($prestas as $index => $presta)
        {
            $url = $routeParser->urlFor('prestationId', ['id' => $presta['id']]);
            $prestas[$index]['url'] = $url;
        }

        $view = Twig::fromRequest($rq);
        $data = ['prestas' => $prestas];

        $view->render($rs, 'prestationsView.twig', $data);

        return $rs;
    }
}