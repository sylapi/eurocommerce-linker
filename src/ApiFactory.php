<?php

declare(strict_types=1);

namespace Sylapi\EurocommerceLinker;

class ApiFactory
{
    private $sessionFactory;

    public function __construct(SessionFactory $sessionFactory)
    {
        $this->sessionFactory = $sessionFactory;
    }

    public function create(Parameters $parameters)
    {
        $session = $this->sessionFactory
                    ->session($parameters);

        return new Api(
            new Api\Products($session),
            new Api\ProductSets($session),
            new Api\ProductStocks($session),
            new Api\Orders($session),
            new Api\OrderAttachments($session),
            new Entities\Make()
        );
    }
}
