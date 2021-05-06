<?php
declare(strict_types=1);

namespace Sylapi\EurocommerceLinker\Entities;

use Sylapi\EurocommerceLinker\Collections\Positions;
use Sylapi\EurocommerceLinker\Collections\ProductPackages;
use Sylapi\EurocommerceLinker\Collections\OrderAttachments;
use Sylapi\EurocommerceLinker\Collections\OrderParcels;

class Make
{
    public function product(): Product
    {
        return new Product;
    }

    public function productSet(): ProductSet
    {
        return new ProductSet;
    }

    public function productStock(): ProductStock
    {
        return new ProductStock;
    }

    public function productPackage(): ProductPackage
    {
        return new ProductPackage;
    }

    public function productPackages(): ProductPackages
    {
        return new ProductPackages;
    }

    public function order(): Order
    {
        return new Order;
    }

    public function positions(): Positions
    {
        return new Positions;
    } 

    public function position(): Position
    {
        return new Position;
    }
    
    public function orderAttachments(): OrderAttachments
    {
        return new OrderAttachments;
    }

    public function orderAttachement(): OrderAttachment
    {
        return new OrderAttachment;
    }

    public function orderParcels(): OrderParcels
    {
        return new OrderParcels;
    }    

    public function orderParcel(): OrderParcel
    {
        return new OrderParcel;
    }

    public function delivery(): Delivery
    {
        return new Delivery;
    }
}
