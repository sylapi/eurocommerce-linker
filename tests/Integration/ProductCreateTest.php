<?php
declare(strict_types=1);

namespace Sylapi\EurocommerceLinker\Tests\Integration;

use GuzzleHttp\Psr7\Response;

use Sylapi\EurocommerceLinker\Api;
use Sylapi\EurocommerceLinker\Entities;
use PHPUnit\Framework\TestCase as PHPUnitTestCase;
use Sylapi\EurocommerceLinker\Exceptions\TransportException;
use Sylapi\EurocommerceLinker\Exceptions\ValidateException;
use Sylapi\EurocommerceLinker\Tests\Helpers\SessionMockTrait;

class ProductCreateTest extends PHPUnitTestCase
{
    use SessionMockTrait;

    public function testProductCreateValidate(): void
    {
        $this->expectException(ValidateException::class);
        $response = new Response(200, [], file_get_contents(__DIR__.'/Mock/ProductGetSuccess.json'));
        $session = $this->getSessionMock($response);
        $apiProducts = new Api\Products($session);
        $product = new Entities\Product;
        $response = $apiProducts->create($product);
    }

    public function testProductCreateSuccess(): void
    {
        $response = new Response(200, [], file_get_contents(__DIR__.'/Mock/ProductGetSuccess.json'));
        $session = $this->getSessionMock($response);
        $apiProducts = new Api\Products($session);
        $mockProduct = $this->createMock(Entities\Product::class);
        $mockProduct->method('getId')->willReturn(1);
        $mockProduct->method('validate')->willReturn(true);
        $mockProduct->method('toArray')->willReturn(['refId' => 1]);

        $response = $apiProducts->create($mockProduct);
        $this->assertInstanceOf(Entities\Product::class, $response);
    }

    public function testProductCreateFailure(): void
    {
        $this->expectException(TransportException::class);
        $response = new Response(404, [], '{}');
        $session = $this->getSessionMock($response);
        $mockProduct = $this->createMock(Entities\Product::class);
        $mockProduct->method('getId')->willReturn(1);
        $mockProduct->method('validate')->willReturn(true);
        $mockProduct->method('toArray')->willReturn(['refId' => 1]);
        $apiProducts = new Api\Products($session);
        $response = $apiProducts->update($mockProduct);
    }

    public function testProductCreateJsonFailure(): void
    {
        $this->expectException(TransportException::class);
        $response = new Response(200, [], '');
        $session = $this->getSessionMock($response);
        $apiProducts = new Api\Products($session);
        $mockProduct = $this->createMock(Entities\Product::class);
        $mockProduct->method('getId')->willReturn(1);
        $mockProduct->method('validate')->willReturn(true);
        $mockProduct->method('toArray')->willReturn(['refId' => 1]);
        $response = $apiProducts->create($mockProduct);
    }
}
