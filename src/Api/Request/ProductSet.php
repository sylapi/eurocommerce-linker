<?php
declare(strict_types=1);

namespace Sylapi\EurocommerceLinker\Api\Request;

use Sylapi\EurocommerceLinker\Entities\ProductSet as ProductSetEntity;

class ProductSet
{
    private $productaSet;

    function __construct(ProductSetEntity $productaSet)
    {
        $this->productaSet = $productaSet;
    }

    public function create(): array
    {
        $data = $this->productaSet->toArray();
        unset($data['id']);
        return $data;
    }

    public function update(): array
    {
        $data = $this->productaSet->toArray();
        return $data;
    }
}