<?php
declare(strict_types=1);

namespace Sylapi\EurocommerceLinker\Entities;

use Sylapi\EurocommerceLinker\Abstracts\Entity;
use Sylapi\EurocommerceLinker\Traits\Validatable;
use Sylapi\EurocommerceLinker\Collections\ProductPackages;

class Product extends Entity
{
    use Validatable;
    
    private $id;
    private $refId;
    private $additionalId;
    private $sku;
    private $code128;
    private $ean;
    private $name;
    private $active = false;
    private $weight;
    private $length;
    private $width;
    private $height;
    private $productPackages;

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
            'active' => 'required|boolean',
            'weight' => 'nullable|numeric',
            'length' => 'nullable|numeric',
            'width' => 'nullable|numeric',
            'height' => 'nullable|numeric',
            'productPackages' => 'array',
            'productPackages.*.id' => 'nullable|integer',
            'productPackages.*.ean' => 'required|alpha_num|min:8|max:13',
            'productPackages.*.name' => 'required|max:20',
            'productPackages.*.number' => 'required|numeric'
        ];

        $data = $this->toArray();

        return $this->validateHandle($data, $rules);
    }

    public function toArray()
    {
        return [
            'id' => $this->getId(),
            'refId' => $this->getRefId(),
            'additionalId' => $this->getAdditionalId(),
            'sku' => $this->getSku(),
            'code128' => $this->getCode128(),
            'ean' => $this->getEan(),
            'name' => $this->getName(),
            'active' => $this->getActive(),
            'weight' => $this->getWeight(),
            'length' => $this->getLength(),
            'width' => $this->getWidth(),
            'height' => $this->getHeight(),
            'productPackages' => ($this->getProductPackages()) ? $this->getProductPackages()->toArray(): null
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
     * Get the value of active
     */ 
    public function getActive(): bool
    {
        return $this->active;
    }

    /**
     * Set the value of active
     *
     * @return  self
     */ 
    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get the value of weight
     */ 
    public function getWeight(): ?float
    {
        return $this->weight;
    }

    /**
     * Set the value of weight
     *
     * @return  self
     */ 
    public function setWeight(?float $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get the value of length
     */ 
    public function getLength(): ?int
    {
        return $this->length;
    }

    /**
     * Set the value of length
     *
     * @return  self
     */ 
    public function setLength(?int $length): self
    {
        $this->length = $length;

        return $this;
    }

    /**
     * Get the value of width
     */ 
    public function getWidth(): ?int
    {
        return $this->width;
    }

    /**
     * Set the value of width
     *
     * @return  self
     */ 
    public function setWidth(?int $width)
    {
        $this->width = $width;

        return $this;
    }

    /**
     * Get the value of height
     */ 
    public function getHeight(): ?int
    {
        return $this->height;
    }

    /**
     * Set the value of height
     *
     * @return  self
     */ 
    public function setHeight(?int $height)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Get the value of productPackages
     */ 
    public function getProductPackages(): ?ProductPackages
    {
        return $this->productPackages;
    }

    /**
     * Set the value of productPackages
     *
     * @return  self
     */ 
    public function setProductPackages(?ProductPackages $productPackages): self
    {
        $this->productPackages = $productPackages;

        return $this;
    }
}
