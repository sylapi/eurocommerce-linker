<?php
declare(strict_types=1);

namespace Sylapi\EurocommerceLinker\Tests\Integration;

use GuzzleHttp\Psr7\Response;

use Sylapi\EurocommerceLinker\Api;
use PHPUnit\Framework\TestCase as PHPUnitTestCase;
use Sylapi\EurocommerceLinker\Exceptions\TransportException;
use Sylapi\EurocommerceLinker\Tests\Helpers\SessionMockTrait;

class ProductSetDeleteTest extends PHPUnitTestCase
{
    use SessionMockTrait;

    public function testProductSetDeleteSuccess(): void
    {
        $productSetId = 413003;
        $response = new Response(200, [], '');
        $session = $this->getSessionMock($response);
        $apiProductSets = new Api\ProductSets($session);
        $response = $apiProductSets->delete($productSetId);
        $this->assertTrue($response);
    }

    public function testProductSetUpdateFailure(): void
    {
        $productSetId = 413003;
        $this->expectException(TransportException::class);
        $response = new Response(404, [], '{}');
        $session = $this->getSessionMock($response);
        $apiProductSets = new Api\ProductSets($session);
        $response = $apiProductSets->delete($productSetId);
    }
}
