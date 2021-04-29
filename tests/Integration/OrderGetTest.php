<?php
declare(strict_types=1);

namespace Sylapi\EurocommerceLinker\Tests\Integration;

use GuzzleHttp\Psr7\Response;

use Sylapi\EurocommerceLinker\Api;
use Sylapi\EurocommerceLinker\Entities;
use PHPUnit\Framework\TestCase as PHPUnitTestCase;
use Sylapi\EurocommerceLinker\Exceptions\TransportException;
use Sylapi\EurocommerceLinker\Tests\Helpers\SessionMockTrait;

class OrderGetTest extends PHPUnitTestCase
{

    use SessionMockTrait;

    public function testOrderGetSuccess(): void
    {
        $orderId = 413003;
        $response = new Response(200, [], file_get_contents(__DIR__.'/Mock/OrderGetSuccess.json'));
        $session = $this->getSessionMock($response);
        $apiOrders = new Api\Orders($session);
        $response = $apiOrders->get($orderId);
        $this->assertInstanceOf(Entities\Order::class,$response);
        $this->assertEquals($orderId, $response->getId());
    }

    public function testOrderGetFailure(): void
    {
        $this->expectException(TransportException::class);
        $orderId = 413003;
        $response = new Response(404, [], '{}');
        $session = $this->getSessionMock($response);
        $apiOrders = new Api\Orders($session);
        $response = $apiOrders->get($orderId);
    }

    public function testOrderAllJsonFailure(): void
    {
        $this->expectException(TransportException::class);
        $orderId = 413003;
        $response = new Response(200, [], '');
        $session = $this->getSessionMock($response);
        $apiOrders = new Api\Orders($session);
        $response = $apiOrders->get($orderId);
    }
}
