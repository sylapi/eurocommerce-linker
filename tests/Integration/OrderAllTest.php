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

class OrderAllTest extends PHPUnitTestCase
{

    use SessionMockTrait;

    public function testOrderAllSuccess(): void
    {
        $response = new Response(200, [], file_get_contents(__DIR__.'/Mock/OrderAllSuccess.json'));
        $session = $this->getSessionMock($response);
        $apiOrders = new Api\Orders($session);
        $response = $apiOrders->all();
        $order2 = $response[1];
        $this->assertEquals(2, $response->count());
        $this->assertInstanceOf(Collections\Orders::class, $response);
        $this->assertInstanceOf(Entities\Order::class, $order2);
        $this->assertEquals('413004', $order2->getId());
    }

    public function testOrderAllFailure(): void
    {
        $this->expectException(TransportException::class);
        $response = new Response(500, [], '{}');
        $session = $this->getSessionMock($response);
        $apiOrders = new Api\Orders($session);
        $response = $apiOrders->all();
    }

    public function testOrderAllJsonFailure(): void
    {
        $this->expectException(TransportException::class);
        $response = new Response(200, [], '');
        $session = $this->getSessionMock($response);
        $apiOrders = new Api\Orders($session);
        $response = $apiOrders->all();
    }
}
