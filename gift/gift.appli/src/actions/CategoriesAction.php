<?php

namespace gift\app\Actions;

use gift\app\services\prestation\PrestationsService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;

class CategoriesAction extends AbstractAction
{
    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        $prestaService = new PrestationsService();
        $categories = $prestaService->getCategories();

        $routeContext = RouteContext::fromRequest($rq);
        $basePath = $routeContext->getBasePath();
        foreach ($categories as $index => $categorie)
        {
            $url = $routeContext->getRouteParser()->urlFor('categorie', ['id' => $categorie['id']]);
            $categories[$index]['url'] = $url;
        }

        $view = Twig::fromRequest($rq);

        $view->render($rs, 'categoriesView.twig', ['categories'=>$categories]);



        return $rs;
    }
}