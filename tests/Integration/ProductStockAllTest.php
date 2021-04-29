<?php
declare(strict_types=1);

namespace Sylapi\EurocommerceLinker\Tests\Integration;

use GuzzleHttp\Psr7\Response;

use Sylapi\EurocommerceLinker\Api;
use Sylapi\EurocommerceLinker\Entities;
use Sylapi\EurocommerceLinker\Collections;
use PHPUnit\Framework\TestCase as PHPUnitTestCase;
use Sylapi\EurocommerceLinker\Exceptions\TransportException;
use Sylapi\EurocommerceLinker\Tests\Helpers\SessionMockTrait;

class ProductStockAllTest extends PHPUnitTestCase
{

    use SessionMockTrait;

    public function testProductStockAllSuccess(): void
    {
        $response = new Response(200, [], file_get_contents(__DIR__.'/Mock/ProductStockAllSuccess.json'));
        $session = $this->getSessionMock($response);
        $apiProductStocks = new Api\ProductStocks($session);
        $response = $apiProductStocks->all();
        $ProductStock2 = $response[1];
        $this->assertEquals(3, $response->count());
        $this->assertInstanceOf(Collections\ProductStocks::class, $response);
        $this->assertInstanceOf(Entities\ProductStock::class, $ProductStock2);
        $this->assertEquals('377800', $ProductStock2->getId());
    }

    public function testProductStockAllFailure(): void
    {
        $this->expectException(TransportException::class);
        $response = new Response(500, [], '{}');
        $session = $this->getSessionMock($response);
        $apiProductStocks = new Api\ProductStocks($session);
        $response = $apiProductStocks->all();
    }

    public function testProductStockAllUnauthorizedFailure(): void
    {
        $this->expectException(TransportException::class);
        $response = new Response(403, [], '{}');
        $session = $this->getSessionMock($response);
        $apiProductStocks = new Api\ProductStocks($session);
        $response = $apiProductStocks->all();
    }

    public function testProductStockAllJsonFailure(): void
    {
        $this->expectException(TransportException::class);
        $response = new Response(200, [], '');
        $session = $this->getSessionMock($response);
        $apiProductStocks = new Api\ProductStocks($session);
        $response = $apiProductStocks->all();
    }
}
