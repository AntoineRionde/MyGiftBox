<?php
declare(strict_types=1);

//require_once __DIR__ . '/../src/vendor/autoload.php';

require_once 'C:/xampp/htdocs/MyGiftBox/gift/gift.appli/src/vendor/autoload.php';

/* application boostrap */
//$app = require_once __DIR__ . '/../src/conf/bootstrap.php';

$app = require_once 'C:/xampp/htdocs/MyGiftBox/gift/gift.appli/src/conf/bootstrap.php';

/* routes loading */
//(require_once __DIR__ . '/../src/conf/routes.php')($app);
(require_once 'C:/xampp/htdocs/MyGiftBox/gift/gift.appli/src/conf/routes.php')($app);

$app->run();
