<?php

namespace gift\app\Actions;

use gift\app\models\Categorie;
use gift\app\services\prestation\PrestationsService;
use gift\app\services\utils\CsrfService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;

class CategorieCreateAction
{
    /**
     * @throws \Exception
     */
    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        $view = Twig::fromRequest($rq);

        if ($rq->getMethod() === 'GET')
        {
            $rs =  $view->render($rs, 'catCreateView.twig',[
                'csrf'=> CsrfService::generate() ] );
        }
        elseif ($rq->getMethod() === 'POST')
        {
            $data = $rq->getParsedBody();
            // vérifier la présence et la validité du token CSRF
            CsrfService::check($data['csrf']);
            // filtrer les données
            $data['libelle'] = filter_var($data['libelle'], FILTER_SANITIZE_STRING);
            $data['description'] = filter_var($data['description'], FILTER_SANITIZE_STRING);
            $prestationsService = new PrestationsService();
            $prestationsService->createCategorie($data);
            $url = RouteContext::fromRequest($rq)->getRouteParser()->urlFor('categories');
            $rs = $view->render($rs->withHeader('Location', $url)->withStatus(302), 'catCreateView.twig');
        }

        return $rs;

    }
}