<?php
declare(strict_types=1);

namespace Sylapi\EurocommerceLinker\Api\Response;

use stdClass;
use Sylapi\EurocommerceLinker\Entities\ProductStock as ProductStockEntity;

class ProductStock
{
    private $result;

    function __construct(stdClass $result)
    {
        $this->result = $result;
    }

    public function get(): ProductStockEntity
    {
        $product = new ProductStockEntity;
        $product->setId($this->result->id)
            ->setRefId($this->result->refid)
            ->setAdditionalId((int) $this->result->additionalId)
            ->setSku($this->result->sku)
            ->setCode128($this->result->code128)
            ->setEan($this->result->ean)
            ->setName($this->result->name)
            ->setWarehouse($this->result->warehouse)
            ->setQuantity((int) $this->result->quantity)
            ->setQuantityAdvice((int) $this->result->quantityAdvice)
            ->setQuantityAvaiable((int) $this->result->quantityAvaiable);
        return $product;
    }
}