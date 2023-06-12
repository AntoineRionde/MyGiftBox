<?php
declare(strict_types=1);

namespace gift\test\services\box;
require_once __DIR__ . '/../../../src/vendor/autoload.php';

use gift\app\models\Box;
use gift\app\models\Prestation;
use PHPUnit\Framework\TestCase;
use Faker\Factory;
use gift\app\services\box\BoxService;
use gift\app\services\box\BoxServiceInvalidDataException;
use gift\app\services\box\BoxServiceNotFoundException;
use Illuminate\Database\Capsule\Manager as DB ;

final class BoxServiceTest extends TestCase
{
    protected $boxService;
    protected $box;

    protected function setUp(): void
    {
        $this->boxService = new BoxService();
        $this->box = new Box();
    }

    //A vérifier
    public function testDeletePresta()
    {
        // Create a mock Box instance
        $boxId = 'box_id';
        $prestaId = 'presta_id';
        $boxMock = $this->getMockBuilder(Box::class)
            ->disableOriginalConstructor()
            ->getMock();
        $boxMock->expects($this->once())
            ->method('prestations')
            ->willReturnSelf();
        $boxMock->expects($this->once())
            ->method('detach')
            ->with($prestaId);
        $boxMock->expects($this->once())
            ->method('save')
            ->willReturnSelf();

        // Set the mock Box instance in the BoxService
        $this->boxService->box = $boxMock;

        // Call the method to be tested
        $result = $this->boxService->deletePresta($boxId, $prestaId);

        // Assert the result
        $this->assertEquals($boxMock, $result);
    }

    //A vérifier
    public function testCreateBoxEmpty()
    {
        // Prepare test data
        $data = [
            'libelle' => 'Test Box',
            'cadeau' => 'off',
            'description' => 'Test description',
            'message_kdo' => 'Test message',
        ];

        // Call the method to be tested
        $result = $this->boxService->createBoxEmpty($data);

        // Assert the result
        $this->assertArrayHasKey('id', $result);
        $this->assertEquals($data['libelle'], $result['libelle']);
        // Add more assertions for other properties if needed
    }

    //A vérifier
    public function testAddPresta()
    {
        // Prepare test data
        $boxId = 'box_id';
        $prestaId = 'presta_id';
        $quantity = 2;

        // Create a mock Box instance
        $boxMock = $this->getMockBuilder(Box::class)
            ->disableOriginalConstructor()
            ->getMock();
        $boxMock->expects($this->once())
            ->method('prestations')
            ->willReturnSelf();
        $boxMock->expects($this->once())
            ->method('findOrFail')
            ->with($boxId)
            ->willReturnSelf();
        $boxMock->expects($this->once())
            ->method('attach')
            ->with($prestaId, ['quantite' => $quantity]);
        $boxMock->expects($this->once())
            ->method('save')
            ->willReturnSelf();

        // Create a mock Prestation instance
        $prestaMock = $this->getMockBuilder(Prestation::class)
            ->disableOriginalConstructor()
            ->getMock();
        $prestaMock->expects($this->once())
            ->method('findOrFail')
            ->with($prestaId)
            ->willReturnSelf();
        $prestaMock->tarif = 10; // Set the tarif property for testing purposes

        // Set the mock instances in the BoxService
        $this->boxService->box = $boxMock;
        $this->boxService->prestation = $prestaMock;

        // Call the method to be tested
        $this->boxService->addPresta($boxId, $prestaId, $quantity);

        // Assert the result
        $this->assertEquals(20, $boxMock->montant); // Assuming the mock tarif is 10
    }

}