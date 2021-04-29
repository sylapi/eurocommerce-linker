<?php
declare(strict_types=1);

namespace Sylapi\EurocommerceLinker\Entities;

use Sylapi\EurocommerceLinker\Abstracts\Entity;
use Sylapi\EurocommerceLinker\Traits\Validatable;

class ProductPackage extends Entity
{
    use Validatable;
    
    private $id;
    private $ean;
    private $name;
    private $number;

    public function validate(): bool
    {
        $rules = [
            'id' => 'nullable|integer',
            'ean' => 'required|alpha_num|min:8|max:13',
            'name' => 'required|max:20',
            'number' => 'required|numeric'
        ];

        $data = [
            'id' => $this->getId(),
            'ean' => $this->getEan(),
            'name' => $this->getName(),
            'number' => $this->getNumber()
        ];

        $validation = $this->validator()->validate(
            $data,
            $rules
        );

        if ($validation->fails()) {
            $this->setErrors($validation->errors()->toArray());
            return false;
        }

        return true;
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
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of ean
     */ 
    public function getEan(): string
    {
        return $this->ean;
    }

    /**
     * Set the value of ean
     *
     * @return  self
     */ 
    public function setEan(string $ean)
    {
        $this->ean = $ean;

        return $this;
    }

    /**
     * Get the value of name
     */ 
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of number
     */ 
    public function getNumber(): int
    {
        return $this->number;
    }

    /**
     * Set the value of number
     *
     * @return  self
     */ 
    public function setNumber(int $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'ean' => $this->ean,
            'name' => $this->name,
            'number' => $this->number
        ];
    }
}
