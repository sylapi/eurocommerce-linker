<?php
declare(strict_types=1);

namespace Sylapi\EurocommerceLinker\Tests\Integration;

use GuzzleHttp\Psr7\Response;

use Sylapi\EurocommerceLinker\Api;
use Sylapi\EurocommerceLinker\Entities;
use PHPUnit\Framework\TestCase as PHPUnitTestCase;
use Sylapi\EurocommerceLinker\Exceptions\TransportException;
use Sylapi\EurocommerceLinker\Tests\Helpers\SessionMockTrait;

class ProductGetTest extends PHPUnitTestCase
{

    use SessionMockTrait;

    public function testProductGetSuccess(): void
    {
        $productId = 377800;
        $response = new Response(200, [], file_get_contents(__DIR__.'/Mock/ProductGetSuccess.json'));
        $session = $this->getSessionMock($response);
        $apiProducts = new Api\Products($session);
        $response = $apiProducts->get($productId);
        $this->assertInstanceOf(Entities\Product::class,$response);
        $this->assertEquals($productId, $response->getId());
    }

    public function testProductGetFailure(): void
    {
        $this->expectException(TransportException::class);
        $productId = 377800;
        $response = new Response(404, [], '{}');
        $session = $this->getSessionMock($response);
        $apiProducts = new Api\Products($session);
        $response = $apiProducts->get($productId);
    }

    public function testProductAllJsonFailure(): void
    {
        $this->expectException(TransportException::class);
        $productId = 377800;
        $response = new Response(200, [], '');
        $session = $this->getSessionMock($response);
        $apiProducts = new Api\Products($session);
        $response = $apiProducts->get($productId);
    }
}
