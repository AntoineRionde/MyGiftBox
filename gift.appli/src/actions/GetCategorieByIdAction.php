<?php

namespace gift\app\actions;

use gift\app\services\prestations\PrestationsServices;
use gift\app\services\prestations\PrestationsServicesException;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;

class GetCategorieByIdAction extends AbstractAction
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE)
        session_start();
    }

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        if (!isset($args['id'])) {
            throw new PrestationsServicesException("Categorie id is null", 400, null);
        }
        $id = (int)$args['id'];

        $prestationsServices = new PrestationsServices();
        $cat = $prestationsServices->getCategorieById($id);
        $prestations = $prestationsServices->getPrestationsByCategorie($id);

        $basePath = RouteContext::fromRequest($request)->getBasePath();
        $css_dir = $basePath . "/styles";
        $img_dir = $basePath . "/img";
        $shared_dir = $basePath . "/shared/img";
        $resources = ['css' => $css_dir, 'img' => $img_dir, 'shared' => $shared_dir, 'user' => $_SESSION['user'] ?? null];
        $view = Twig::fromRequest($request);
        $data = [
            'cat' => $cat,
            'prestations' => $prestations,
            'resources' => $resources
        ];
        return $view->render($response, 'categorie.twig', $data);
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