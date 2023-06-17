<?php

namespace gift\app\actions;

use gift\app\services\prestations\PrestationsServices;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;

class getPrestationsActions
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $prestationsServices = new PrestationsServices();
        $prestations = $prestationsServices->getPrestations();

        foreach ($prestations as $key => $value) {
            $categorieLibelle = $prestationsServices->getCategorieById($value['cat_id']);
            $prestations[$key]['cat_libelle'] = $categorieLibelle['libelle'];
        }

        $view = Twig::fromRequest($request);

        $basePath = RouteContext::fromRequest($request)->getBasePath() ;
        $css_dir = $basePath . "/styles";
        $img_dir = $basePath . "/img";
        $shared_dir = $basePath . "/shared/img";
        $resources = ['css' => $css_dir, 'img' => $img_dir, 'shared' => $shared_dir];

        return $view->render($response, 'prestations.twig', ['prestations' => $prestations, 'resources' => $resources]);
    }

}