<?php

namespace gift\app\actions;

use gift\app\services\prestations\PrestationsServices;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;

class GetPrestationsAction
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE)
        session_start();
    }
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $prestationsServices = new PrestationsServices();
        $prestations = $prestationsServices->getPrestations();

        if (isset($_GET['ordre'])) {
            $ordre = $_GET['ordre'];
            usort($prestations, 'gift\app\actions\GetPrestationsAction::comparePrestationsByPrice');

            if ($ordre == 'desc') {
                $prestations = array_reverse($prestations);
            }

        }

        foreach ($prestations as $key => $value) {
            $categorieLibelle = $prestationsServices->getCategorieById($value['cat_id']);
            $prestations[$key]['cat_libelle'] = $categorieLibelle['libelle'];
        }

        $view = Twig::fromRequest($request);

        $basePath = RouteContext::fromRequest($request)->getBasePath() ;
        $css_dir = $basePath . "/styles";
        $img_dir = $basePath . "/img";
        $shared_dir = $basePath . "/shared/img";
        $resources = ['css' => $css_dir, 'img' => $img_dir, 'shared' => $shared_dir, 'user' => $_SESSION['user'] ?? null];
        return $view->render($response, 'prestations.twig', ['prestations' => $prestations, 'resources' => $resources]);
    }

    function comparePrestationsByPrice($prestation1, $prestation2): int
    {
        $tarif1 = (float) $prestation1['tarif'];
        $tarif2 = (float) $prestation2['tarif'];

        if ($tarif1 == $tarif2) {
            return 0;
        } elseif ($tarif1 < $tarif2) {
            return -1;
        } else {
            return 1;
        }
    }
}