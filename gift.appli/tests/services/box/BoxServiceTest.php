<?php
declare(strict_types=1);

namespace gift\test\services\box;
require_once __DIR__ . '/../../../src/vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use Faker\Factory;
use gift\app\services\box\BoxService;
use gift\app\services\box\BoxServiceInvalidDataException;
use gift\app\services\box\BoxServiceNotFoundException;
use Illuminate\Database\Capsule\Manager as DB ;

final class BoxServiceTest extends TestCase
{

}