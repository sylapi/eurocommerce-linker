<?php
declare(strict_types=1);

namespace Sylapi\EurocommerceLinker\Entities;

use Sylapi\EurocommerceLinker\Abstracts\Entity;
use Sylapi\EurocommerceLinker\Enums\CarierType;
use Sylapi\EurocommerceLinker\Traits\Validatable;

class OrderParcel extends Entity
{
    use Validatable;

    private $id;
    private $carrier;
    private $number;
    private $status;
    private $statusDate;
    private $originalStatus;
    private $addData;
    private $sentDate;
    private $deliveryDate;

    public function validate(): bool
    {
        $rules = [
            'id' => 'required|numeric',
            'carier' => 'required|max:10|in:'.implode(',', CarierType::toArray()),
            'number' => 'nullable',
            'status' => 'nullable',
            'statusDate' => 'nullable',
            'originalStatus' => 'nullable',
            'addData' => 'nullable',
            'sentDate' => 'nullable',
            'deliveryDate' => 'nullable'
        ];

        $data = $this->toArray();

        return $this->validateHandle($data, $rules);
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'carier' => $this->getCarrier(),
            'number' => $this->getNumber(),
            'status' => $this->getStatus(),
            'statusDate' => $this->getStatusDate(),
            'originalStatus' => $this->getOriginalStatus(),
            'addData' => $this->getAddData(),
            'sentDate' => $this->getSentDate(),
            'deliveryDate' => $this->getDeliveryDate()
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
     * Get the value of carrier
     */ 
    public function getCarrier(): ?string
    {
        return $this->carrier;
    }

    /**
     * Set the value of carrier
     *
     * @return  self
     */ 
    public function setCarrier(?string $carrier): self
    {
        $this->carrier = $carrier;

        return $this;
    }



    /**
     * Get the value of number
     */ 
    public function getNumber(): ?string
    {
        return $this->number;
    }

    /**
     * Set the value of number
     *
     * @return  self
     */ 
    public function setNumber(?string $number): self
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get the value of status
     */ 
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */ 
    public function setStatus(?string $status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of statusDate
     */ 
    public function getStatusDate(): ?string
    {
        return $this->statusDate;
    }

    /**
     * Set the value of statusDate
     *
     * @return  self
     */ 
    public function setStatusDate(?string $statusDate): self
    {
        $this->statusDate = $statusDate;

        return $this;
    }

    /**
     * Get the value of originalStatus
     */ 
    public function getOriginalStatus(): ?string
    {
        return $this->originalStatus;
    }

    /**
     * Set the value of originalStatus
     *
     * @return  self
     */ 
    public function setOriginalStatus(?string $originalStatus): self
    {
        $this->originalStatus = $originalStatus;
        
        return $this;
    }

    /**
     * Get the value of addData
     */ 
    public function getAddData(): ?string
    {
        return $this->addData;
    }

    /**
     * Set the value of addData
     *
     * @return  self
     */ 
    public function setAddData(?string $addData): self
    {
        $this->addData = $addData;

        return $this;
    }

    /**
     * Get the value of sentDate
     */ 
    public function getSentDate(): ?string
    {
        return $this->sentDate;
    }

    /**
     * Set the value of sentDate
     *
     * @return  self
     */ 
    public function setSentDate(?string $sentDate): self
    {
        $this->sentDate = $sentDate;

        return $this;
    }

    /**
     * Get the value of deliveryDate
     */ 
    public function getDeliveryDate(): ?string
    {
        return $this->deliveryDate;
    }

    /**
     * Set the value of deliveryDate
     *
     * @return  self
     */ 
    public function setDeliveryDate(?string $deliveryDate)
    {
        $this->deliveryDate = $deliveryDate;

        return $this;
    }
}
