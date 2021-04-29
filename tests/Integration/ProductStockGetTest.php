<?php
declare(strict_types=1);

namespace Sylapi\EurocommerceLinker\Tests\Integration;

use GuzzleHttp\Psr7\Response;
use Sylapi\EurocommerceLinker\Api;
use Sylapi\EurocommerceLinker\Entities;
use PHPUnit\Framework\TestCase as PHPUnitTestCase;
use Sylapi\EurocommerceLinker\Exceptions\TransportException;
use Sylapi\EurocommerceLinker\Tests\Helpers\SessionMockTrait;

class ProductStockGetTest extends PHPUnitTestCase
{
    use SessionMockTrait;

    public function testProductStockGetSuccess(): void
    {
        $productStockId = 377798;
        $response = new Response(200, [], file_get_contents(__DIR__.'/Mock/ProductStockGetSuccess.json'));
        $session = $this->getSessionMock($response);
        $apiProductStocks = new Api\ProductStocks($session);
        $response = $apiProductStocks->get($productStockId);
        $this->assertInstanceOf(Entities\ProductStock::class,$response);
        $this->assertEquals($productStockId, $response->getId());
    }

    public function testProductStockGetFailure(): void
    {
        $this->expectException(TransportException::class);
        $ProductStockId = 377798;
        $response = new Response(404, [], '{}');
        $session = $this->getSessionMock($response);
        $apiProductStocks = new Api\ProductStocks($session);
        $response = $apiProductStocks->get($ProductStockId);
    }

    public function testProductStockAllJsonFailure(): void
    {
        $this->expectException(TransportException::class);
        $ProductStockId = 377798;
        $response = new Response(200, [], '');
        $session = $this->getSessionMock($response);
        $apiProductStocks = new Api\ProductStocks($session);
        $response = $apiProductStocks->get($ProductStockId);
    }
}
