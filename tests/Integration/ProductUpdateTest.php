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

class ProductUpdateTest extends PHPUnitTestCase
{
    use SessionMockTrait;

    public function testProductUpdateValidate(): void
    {
        $this->expectException(ValidateException::class);
        $response = new Response(200, [], file_get_contents(__DIR__.'/Mock/ProductGetSuccess.json'));
        $session = $this->getSessionMock($response);
        $apiProducts = new Api\Products($session);
        $Product = new Entities\Product;
        $response = $apiProducts->update($Product);
    }

    public function testProductUpdateIdNotExist(): void
    {
        $this->expectException(ValidateException::class);
        $response = new Response(200, [], file_get_contents(__DIR__.'/Mock/ProductGetSuccess.json'));
        $session = $this->getSessionMock($response);
        $apiProducts = new Api\Products($session);
        $mockProduct = $this->createMock(Entities\Product::class);
        $mockProduct->method('validate')->willReturn(true);
        $response = $apiProducts->update($mockProduct);
    }

    public function testProductUpdateSuccess(): void
    {
        $response = new Response(204, [], '');
        $session = $this->getSessionMock($response);
        $apiProducts = new Api\Products($session);
        $mockProduct = $this->createMock(Entities\Product::class);
        $mockProduct->method('getId')->willReturn(1);
        $mockProduct->method('validate')->willReturn(true);
        $mockProduct->method('toArray')->willReturn(['refId' => 1]);

        $response = $apiProducts->update($mockProduct);
        $this->assertTrue($response);
    }

    public function testProductUpdateFailure(): void
    {
        $this->expectException(TransportException::class);
        $response = new Response(404, [], '{}');
        $session = $this->getSessionMock($response);
        $mockProduct = $this->createMock(Entities\Product::class);
        $mockProduct->method('getId')->willReturn(1);
        $mockProduct->method('validate')->willReturn(true);
        $mockProduct->method('toArray')->willReturn([]);
        $apiProducts = new Api\Products($session);
        $response = $apiProducts->update($mockProduct);
    }
}
