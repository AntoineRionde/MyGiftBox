<?php
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

$app = AppFactory::create();
$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, false, false);
$app->setBasePath('/BUT-S4/Archi_logicielle/gift/gift.appli/public/index.php');

$twig = Twig::create(__DIR__ . '/../views', ['cache' => __DIR__ . '/../views/cache', 'auto_reload' => true]);
$app->add(TwigMiddleWare::create($app, $twig));
return $app;