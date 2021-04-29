<?php
declare(strict_types=1);

namespace Sylapi\EurocommerceLinker\Entities;

use Sylapi\EurocommerceLinker\Abstracts\Entity;
use Sylapi\EurocommerceLinker\Traits\Validatable;

class Position extends Entity
{
    use Validatable;

    private $id;
    private $productId;
    private $refId;
    private $additionalId;
    private $quantity;

    public function validate(): bool
    {
        $rules = [
            'id' => 'nullable|integer',
            'productId' => 'nullable|integer',
            'refId' => 'nullable|integer',
            'additionalId' => 'nullable',
            'quantity' => 'nullable|integer|min:1',
        ];

        $data = $this->toArray();

        return $this->validateHandle($data, $rules);
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'productId' => $this->getProductId(),
            'refId' => $this->getRefId(),
            'additionalId' => $this->getAdditionalId(),
            'quantity' => $this->getQuantity()
        ];
    }

    /**
     * Get the value of id
     */ 
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }    

    /**
     * Get the value of productId
     */ 
    public function getProductId(): ?int
    {
        return $this->productId;
    }

    /**
     * Set the value of productId
     *
     * @return  self
     */ 
    public function setProductId(?int $productId): self
    {
        $this->productId = $productId;

        return $this;
    }

    /**
     * Get the value of refId
     */ 
    public function getRefId(): ?int
    {
        return $this->refId;
    }

    /**
     * Set the value of refId
     *
     * @return  self
     */ 
    public function setRefId(?int $refId): self
    {
        $this->refId = $refId;

        return $this;
    }

    /**
     * Get the value of additionalId
     */ 
    public function getAdditionalId(): ?string
    {
        return $this->additionalId;
    }

    /**
     * Set the value of additionalId
     *
     * @return  self
     */ 
    public function setAdditionalId(?string $additionalId): self
    {
        $this->additionalId = $additionalId;

        return $this;
    }

    /**
     * Get the value of quantity
     */ 
    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    /**
     * Set the value of quantity
     *
     * @return  self
     */ 
    public function setQuantity(?int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

}
