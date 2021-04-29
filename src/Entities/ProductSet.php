<?php
declare(strict_types=1);

namespace Sylapi\EurocommerceLinker\Entities;

use Sylapi\EurocommerceLinker\Abstracts\Entity;
use Sylapi\EurocommerceLinker\Traits\Validatable;
use Sylapi\EurocommerceLinker\Collections\Positions;

class ProductSet extends Entity
{
    use Validatable;

    private $id;
    private $refId;
    private $additionalId;
    private $name;
    private $positions;



    public function validate(): bool
    {
        $rules = [
            'id' => 'nullable|integer',
            'refId' => 'nullable|integer',
            'additionalId' => 'nullable|integer',
            'name' => 'required|max:200',
            'positions.*.productId' => 'nullable|integer',
            'positions.*.refId' => 'nullable|integer',
            'positions.*.additionalId' => 'nullable|integer',
            'positions.*.quantity' => 'nullable|integer',
        ];

        $data = $this->toArray();
        
        return $this->validateHandle($data, $rules);
    }


    public function toArray() {
        return [
            'id' => $this->getId(),
            'refId' => $this->getRefId(),
            'additionalId' => $this->getAdditionalId(),
            'name' => $this->getName(),
            'positions'=> ($this->getPositions()) ? $this->getPositions()->toArray() : null,
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
     * Get the value of positions
     */ 
    public function getPositions(): ?Positions
    {
        return $this->positions;
    }

    /**
     * Set the value of positions
     *
     * @return  self
     */ 
    public function setPositions(?Positions $positions): self
    {
        $this->positions = $positions;

        return $this;
    }    
}
