<?php

namespace Sylapi\EurocommerceLinker\Tests\Helpers;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Sylapi\EurocommerceLinker\Session;
use Sylapi\EurocommerceLinker\Parameters;

trait SessionMockTrait
{
    private function getSessionMock(Response $response)
    {
        $mock = new MockHandler([$response]);
        $handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $handlerStack]);
        
        $mockParameters = $this->createMock(Parameters::class);

        $mockParameters->method('__call')
            ->willReturn(true);

        $mockSession = $this->createMock(Session::class);
        $mockSession->method('client')
            ->willReturn($client);
        $mockSession->method('parameters')
            ->willReturn($mockParameters);

        return $mockSession;
    }
}