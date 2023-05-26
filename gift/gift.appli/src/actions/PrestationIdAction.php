<?php

namespace gift\app\Actions;

use gift\app\services\prestation\PrestationServiceNotFoundException;
use gift\app\services\prestation\PrestationsService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpBadRequestException;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;

class PrestationIdAction extends AbstractAction
{
    /**
     * @throws PrestationServiceNotFoundException
     */
    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        $id = $args['id'] ?? null;
        if (is_null($id)) {
            throw new HttpBadRequestException($rq, "Incomplete request : missing prestation ID");
        }

        $PrestationsService = new PrestationsService();
        $presta = $PrestationsService->getPrestationById($id);

        $routeContext = RouteContext::fromRequest($rq);
        $basePath = $routeContext->getBasePath();

        $url = $routeContext->getRouteParser()->urlFor('prestationId', ['id' => $id]);
        $presta['url'] = $url;

        $view = Twig::fromRequest($rq);

        $view->render($rs, 'prestationView.twig', ['presta' => $presta]);

        return $rs;
    }
}