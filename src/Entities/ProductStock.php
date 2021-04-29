<?php
declare(strict_types=1);

namespace Sylapi\EurocommerceLinker\Entities;

use Sylapi\EurocommerceLinker\Abstracts\Entity;
use Sylapi\EurocommerceLinker\Traits\Validatable;

class ProductStock extends Entity
{
    use Validatable;

    private $id;
    private $refId;
    private $additionalId;
    private $sku;
    private $code128;
    private $ean;
    private $name;
    private $warehouse;
    private $quantity;
    private $quantityAdvice;
    private $quantityAvaiable;

    public function validate(): bool
    {
        $rules = [
            'id' => 'nullable|integer',
            'refId' => 'nullable|integer',
            'additionalId' => 'nullable|integer',
            'sku' => 'nullable|max:40',
            'code128' => 'nullable|max:40',
            'ean' => 'nullable|min:8|max:13',
            'name' => 'required|max:200',
            'warehouse' => 'nullable',
            'quantity' => 'nullable|integer',
            'quantityAdvice' => 'nullable|integer',
            'quantityAvaiable' => 'nullable|integer',
        ];

        $data = [
            'id' => $this->getId(),
        ];

        return $this->validateHandle($data, $rules);
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
    public function setRefId(?int $refId)
    {
        $this->refId = $refId;

        return $this;
    }

 /**
     * Get the value of additionalId
     */ 
    public function getAdditionalId(): ?int
    {
        return $this->additionalId;
    }

    /**
     * Set the value of additionalId
     *
     * @return  self
     */ 
    public function setAdditionalId(?int $additionalId): self
    {
        $this->additionalId = $additionalId;

        return $this;
    }

    /**
     * Get the value of sku
     */ 
    public function getSku(): ?string
    {
        return $this->sku;
    }

    /**
     * Set the value of sku
     *
     * @return  self
     */ 
    public function setSku(?string $sku): self
    {
        $this->sku = $sku;

        return $this;
    }

    /**
     * Get the value of code128
     */ 
    public function getCode128(): ?string
    {
        return $this->code128;
    }

    /**
     * Set the value of code128
     *
     * @return  self
     */ 
    public function setCode128(?string $code128): self
    {
        $this->code128 = $code128;

        return $this;
    }

    /**
     * Get the value of ean
     */ 
    public function getEan(): ?string
    {
        return $this->ean;
    }

    /**
     * Set the value of ean
     *
     * @return  self
     */ 
    public function setEan(?string $ean)
    {
        $this->ean = $ean;

        return $this;
    }

    /**
     * Get the value of name
     */ 
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }    

    /**
     * Get the value of warehouse
     */ 
    public function getWarehouse(): string
    {
        return $this->warehouse;
    }

    /**
     * Set the value of warehouse
     *
     * @return  self
     */ 
    public function setWarehouse(string $warehouse): self
    {
        $this->warehouse = $warehouse;

        return $this;
    }

    /**
     * Get the value of quantity
     */ 
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * Set the value of quantity
     *
     * @return  self
     */ 
    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get the value of quantityAdvice
     */ 
    public function getQuantityAdvice(): int
    {
        return $this->quantityAdvice;
    }

    /**
     * Set the value of quantityAdvice
     *
     * @return  self
     */ 
    public function setQuantityAdvice(int $quantityAdvice): self
    {
        $this->quantityAdvice = $quantityAdvice;

        return $this;
    }

    /**
     * Get the value of quantityAvaiable
     */ 
    public function getQuantityAvaiable(): int
    {
        return $this->quantityAvaiable;
    }

    /**
     * Set the value of quantityAvaiable
     *
     * @return  self
     */ 
    public function setQuantityAvaiable(int $quantityAvaiable): self
    {
        $this->quantityAvaiable = $quantityAvaiable;

        return $this;
    }
}
