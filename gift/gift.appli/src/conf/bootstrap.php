<?php
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

$app = AppFactory::create();
$app->addRoutingMiddleWare();
$app->addErrorMiddleWare(true, false, false);
$app->setBasePath('/MyGiftBox/gift/gift.appli/public');

$twig = Twig::create(__DIR__ . '/../views', ['cache' => __DIR__ . '/../views/cache', 'auto_reload' => true]);
$app->add(TwigMiddleWare::create($app, $twig));
return $app;