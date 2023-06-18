<?php

use gift\api\services\utils\Eloquent;
use Slim\Factory\AppFactory;


Eloquent::init('../src/conf/config.ini');
$app = AppFactory::create();
$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, false, false);

return $app;