<?php

use gift\api\services\utils\Eloquent;
use Slim\Factory\AppFactory;
use Slim\Views\Twig as Twig;
use Slim\Views\TwigMiddleware;


Eloquent::init('../src/conf/config.ini');
$app = AppFactory::create();
$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, false, false);
$twig = Twig::create(__DIR__ . '/../templates', ['cache' => false]);
$app->add(
    TwigMiddleware::create($app, $twig));

return $app;