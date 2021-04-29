<?php
declare(strict_types=1);

namespace Sylapi\EurocommerceLinker\Api\Request;

use Sylapi\EurocommerceLinker\Entities\Product as ProductEntity;

class Product
{
    private $product;

    function __construct(ProductEntity $product)
    {
        $this->product = $product;
    }

    public function create(): array
    {
        $data = $this->product->toArray();
        unset($data['id']);
        unset($data['productPackages']);
        $refId  = $data['refId'];
        unset($data['refId']);
        $data['refid'] = $refId;
        return $data;
    }

    public function update(): array
    {
        $data = $this->product->toArray();
        unset($data['productPackages']);
        $refId  = $data['refId'];
        unset($data['refId']);
        $data['refid'] = $refId;
        unset($data['statusDate']);
        unset($data['addDate']);
        unset($data['forwardDate']);
        unset($data['packDate']);
        unset($data['serialNumber']);
        return $data;
    }
}