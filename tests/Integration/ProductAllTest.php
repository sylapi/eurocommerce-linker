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

class ProductAllTest extends PHPUnitTestCase
{

    use SessionMockTrait;

    public function testProductAllSuccess(): void
    {
        $response = new Response(200, [], file_get_contents(__DIR__.'/Mock/ProductAllSuccess.json'));
        $session = $this->getSessionMock($response);
        $apiProducts = new Api\Products($session);
        $response = $apiProducts->all();
        $product2 = $response[1];
        $this->assertEquals(10, $response->count());
        $this->assertInstanceOf(Collections\Products::class, $response);
        $this->assertInstanceOf(Entities\Product::class, $product2);
        $this->assertEquals('377798', $product2->getId());
    }

    public function testProductAllFailure(): void
    {
        $this->expectException(TransportException::class);
        $response = new Response(500, [], '{}');
        $session = $this->getSessionMock($response);
        $apiProducts = new Api\Products($session);
        $response = $apiProducts->all();
    }

    public function testProductAllJsonFailure(): void
    {
        $this->expectException(TransportException::class);
        $response = new Response(200, [], '');
        $session = $this->getSessionMock($response);
        $apiProducts = new Api\Products($session);
        $response = $apiProducts->all();
    }
}
