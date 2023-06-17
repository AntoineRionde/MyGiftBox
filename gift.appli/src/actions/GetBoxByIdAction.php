<?php

namespace gift\app\actions;

use gift\app\services\box\BoxService;
use gift\app\services\box\BoxServiceNotFoundException;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\Twig;

class GetBoxByIdAction extends AbstractAction
{

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        if (!isset($args['id'])) {
            throw new BoxServiceNotFoundException("Box id is null", 400, null);
        }
        $id = (int) $args['id'];
        $BoxServices = new BoxService();
        $box = $BoxServices->getBoxById($id);

        $view = Twig::fromRequest($request);
        $view->render($response, 'box.twig', ['box' => $box]);
        return $response;
    }
}