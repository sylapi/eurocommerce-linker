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

class OrderUpdateTest extends PHPUnitTestCase
{
    use SessionMockTrait;

    public function testOrderUpdateValidate(): void
    {
        $this->expectException(ValidateException::class);
        $response = new Response(200, [], file_get_contents(__DIR__.'/Mock/OrderGetSuccess.json'));
        $session = $this->getSessionMock($response);
        $apiOrders = new Api\Orders($session);
        $order = new Entities\Order;
        $response = $apiOrders->update($order);
    }

    public function testOrderUpdateIdNotExist(): void
    {
        $this->expectException(ValidateException::class);
        $response = new Response(200, [], file_get_contents(__DIR__.'/Mock/OrderGetSuccess.json'));
        $session = $this->getSessionMock($response);
        $apiOrders = new Api\Orders($session);
        $mockOrder = $this->createMock(Entities\Order::class);
        $mockOrder->method('validate')->willReturn(true);
        $response = $apiOrders->update($mockOrder);
    }

    public function testOrderUpdateSuccess(): void
    {
        $response = new Response(200, [], file_get_contents(__DIR__.'/Mock/OrderGetSuccess.json'));
        $session = $this->getSessionMock($response);
        $apiOrders = new Api\Orders($session);
        $mockOrder = $this->createMock(Entities\Order::class);
        $mockOrder->method('getId')->willReturn(1);
        $mockOrder->method('validate')->willReturn(true);
        $mockOrder->method('toArray')->willReturn([]);

        $response = $apiOrders->update($mockOrder);
        $this->assertInstanceOf(Entities\Order::class, $response);
    }

    public function testOrderUpdateFailure(): void
    {
        $this->expectException(TransportException::class);
        $response = new Response(404, [], '{}');
        $session = $this->getSessionMock($response);
        $mockOrder = $this->createMock(Entities\Order::class);
        $mockOrder->method('getId')->willReturn(1);
        $mockOrder->method('validate')->willReturn(true);
        $mockOrder->method('toArray')->willReturn([]);
        $apiOrders = new Api\Orders($session);
        $response = $apiOrders->update($mockOrder);
    }

    public function testOrderUpdateJsonFailure(): void
    {
        $this->expectException(TransportException::class);
        $response = new Response(200, [], '');
        $session = $this->getSessionMock($response);
        $apiOrders = new Api\Orders($session);
        $mockOrder = $this->createMock(Entities\Order::class);
        $mockOrder->method('getId')->willReturn(1);
        $mockOrder->method('validate')->willReturn(true);
        $mockOrder->method('toArray')->willReturn([]);
        $response = $apiOrders->update($mockOrder);
    }
}
