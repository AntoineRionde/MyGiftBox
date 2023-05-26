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

class CategoriesIdAction extends AbstractAction
{
    /**
     * @throws PrestationServiceNotFoundException
     */
    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        $id = intval($args['id']) ?? null;
        if (is_null($id)) {
            throw new HttpBadRequestException($rq, "Incomplete request : missing categorie ID");
        }

        $PrestationsService = new PrestationsService();
        $cat = $PrestationsService->getCategorieById($id);
        $prestaLies = $PrestationsService->getPrestationsbyCategorie($id);

        $routeContext = RouteContext::fromRequest($rq);
        $basePath = $routeContext->getBasePath();

        $url = $routeContext->getRouteParser()->urlFor('categorie', ['id' => $id]);
        $cat['url'] = $url;

        $view = Twig::fromRequest($rq);
        $data = ['cat' => $cat, 'prestaLies' => $prestaLies];

        $view->render($rs, 'categorieView.twig', $data);

        return $rs;
    }

}