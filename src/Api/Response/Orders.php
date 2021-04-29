<?php
declare(strict_types=1);

namespace Sylapi\EurocommerceLinker\Api\Response;

use Sylapi\EurocommerceLinker\Collections\Orders as OrdersCollection;

class Orders
{
    private $result;

    function __construct(array $result)
    {
        $this->result = $result;
    }

    public function get(): OrdersCollection
    {
        $products = new OrdersCollection();
        foreach($this->result as $result)
        {
            $products->add(
                (new Order($result))->get()
            );
        }
        return $products;
    }
}