<?php
declare(strict_types=1);

namespace Sylapi\EurocommerceLinker;

use Sylapi\EurocommerceLinker\Entities\Make;

class Api
{
    private $products;
    private $productSets;
    private $productStocks;
    private $orders;
    private $orderAttachments;
    private $make;

    public function __construct(
        Api\Products $products,
        Api\ProductSets $productSets,
        Api\ProductStocks $productStocks,
        Api\Orders $orders,
        Api\OrderAttachments $orderAttachments,
        Entities\Make $make
    ) {
        $this->products = $products;
        $this->productSets = $productSets;
        $this->productStocks = $productStocks;
        $this->orders = $orders;
        $this->orderAttachments = $orderAttachments;
        $this->make = $make;
    }

    public function make(): Make
    {
        return $this->make;
    }

    public function products(): Api\Products
    {
        return $this->products;
    }

    public function productSets(): Api\ProductSets
    {
        return $this->productSets;
    }

    public function productStocks(): Api\ProductStocks
    {
        return $this->productStocks;
    }

    public function orders(): Api\Orders
    {
        return $this->orders;
    }
    
    public function orderAttachments(): Api\OrderAttachments
    {
        return $this->orderAttachments;
    }  
}
