<?php
declare(strict_types=1);

namespace Sylapi\EurocommerceLinker\Tests\Integration;

use Sylapi\EurocommerceLinker\Session;
use Sylapi\EurocommerceLinker\ApiFactory;
use Sylapi\EurocommerceLinker\Parameters;
use Sylapi\EurocommerceLinker\SessionFactory;
use PHPUnit\Framework\TestCase as PHPUnitTestCase;
use Sylapi\EurocommerceLinker\Api;
use Sylapi\EurocommerceLinker\Entities\Make;
use Sylapi\EurocommerceLinker\Exceptions\ValidateException;
use Sylapi\EurocommerceLinker\Tests\Helpers\SessionMockTrait;
use GuzzleHttp\Client;

class ApiFactoryTest extends PHPUnitTestCase
{

    use SessionMockTrait;
    
    public function testSessionFactory()
    {
        $sessionFactory = new SessionFactory();
        $session = $sessionFactory->session(
            Parameters::create([
                'login' => 'login',
                'password' => 'password',
                'debug' => false
            ])
        );
        $this->assertInstanceOf(Session::class, $session);
    }

    public function testSessionFactoryParametersNotValid()
    {
        $this->expectException(ValidateException::class);
        $sessionFactory = new SessionFactory();
        $session = $sessionFactory->session(
            Parameters::create([])
        );
    }

    public function testFactoryCreate()
    {
        $mockSessionFactory = $this->createMock(SessionFactory::class);
        $mockParameters = $this->createMock(Parameters::class);
        $apiFactory = new ApiFactory($mockSessionFactory);
        $api = $apiFactory->create($mockParameters);
        $this->assertInstanceOf(Api::class, $api);
        $this->assertInstanceOf(Make::class, $api->make());
        $this->assertInstanceOf(Api\Products::class, $api->products());
        $this->assertInstanceOf(Api\ProductSets::class, $api->productSets());
        $this->assertInstanceOf(Api\ProductStocks::class, $api->productStocks());
        $this->assertInstanceOf(Api\Orders::class, $api->orders());
    }

    public function testSession()
    {
        $mockParameters = $this->createMock(Parameters::class);
        $session = new Session($mockParameters);
        $this->assertInstanceOf(Client::class, $session->client());
    }
}