<?php

namespace gift\app\actions;

use gift\app\services\prestations\PrestationsServices;
use gift\app\services\prestations\PrestationsServicesException;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;

class UpdatePrestationByIdAction extends AbstractAction
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE)
        session_start();
    }

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        if (!isset($args['id'])) {
            throw new PrestationsServicesException("id is null", 400, null);
        }
        $id = (string)$args['id'];
        $prestations = new PrestationsServices();
        if ($request->getMethod() === 'POST') {
            $prestations->updatePrestationById($id, $request->getParsedBody());
            return $response->withHeader('Location', "/prestation/{$id}");
        }
        $prestation = $prestations->getPrestationById($id);
        /**
        $html = <<<HTML
<html>
    <head>
        <title>Modifier une prestation - My Gift Box</title>
        <link rel="stylesheet" href="../../styles/main.css">
    </head>
    <body>
        <h1>Modifier une prestation</h1>
        <a href="/"><button>Home</button></a>
        <form action="/prestation/{$id}/update" method="post">
            <label for="libelle">Libelle</label>
            <input type="text" name="libelle" id="libelle" value="{$prestation['libelle']}">
            <label for="description">Description</label>
            <input type="text" name="description" id="description" value="{$prestation['description']}">
            <label for="url">Url</label>
            <input type="text" name="url" id="url" value="{$prestation['url']}">
            <label for="unite">Unite</label>
            <input type="text" name="unite" id="unite" value="{$prestation['unite']}">
            <label for="tarif">Tarif</label>
            <input type="text" name="tarif" id="tarif" value="{$prestation['tarif']}">
            <label for="img">Image</label>
            <input type="text" name="img" id="img" value="{$prestation['img']}">
            <label for="cat_id">Categorie</label>
            <input type="text" name="cat_id" id="cat_id" value="{$prestation['cat_id']}" required>
            <input type="submit" value="Modifier">
        </form>
    </body>
</html>
HTML;

        $response->getBody()->write($html);
        return $response;*/
        $basePath = RouteContext::fromRequest($request)->getBasePath() ;
        $css_dir = $basePath . "/styles";
        $img_dir = $basePath . "/img";
        $shared_dir = $basePath . "/shared/img";
        $resources = ['css' => $css_dir, 'img' => $img_dir, 'shared' => $shared_dir, 'user' => $_SESSION['user'] ?? null];
        $view = Twig::fromRequest($request);
        $view->render($response, 'edit-prestation.twig', ['resources' => $resources]);
        return $response;
    }
}
