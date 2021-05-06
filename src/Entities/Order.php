<?php
declare(strict_types=1);

namespace Sylapi\EurocommerceLinker\Entities;

use Sylapi\EurocommerceLinker\Abstracts\Entity;
use Sylapi\EurocommerceLinker\Enums\CarierType;
use Sylapi\EurocommerceLinker\Traits\Validatable;
use Sylapi\EurocommerceLinker\Collections\Positions;
use Sylapi\EurocommerceLinker\Collections\OrderParcels;
use Sylapi\EurocommerceLinker\Collections\OrderAttachments;

class Order extends Entity
{
    use Validatable;

    private $id;
    private $refId;
    private $number;
    private $signature;
    private $source;
    private $status;
    private $statusDate;
    private $addDate;
    private $forwardDate;
    private $packDate;
    private $comments;
    private $delivery;
    private $contactPerson;
    private $phone;
    private $email;
    private $name1;
    private $name2;
    private $name3;
    private $countryCode;
    private $postalCode;
    private $place;
    private $street;
    private $serialNumber;
    private $note;
    private $positions;
    private $attachments;
    private $parcels;

    
    public function validate(): bool
    {
        $rules = [
            'id' => 'nullable|integer',
            'refId' => 'nullable|integer',
            'number' => 'nullable|max:50',
            'signature' => 'nullable|max:50',
            'source' => 'nullable|max:10',
            'status' => 'nullable',
            'statusDate' => 'nullable',
            'addDate' => 'nullable',
            'forwardDate' => 'nullable',
            'packDate' => 'nullable',
            'comments' => 'nullable|max:1000',
            'delivery.carier' => 'required|max:10|in:'.implode(',', CarierType::toArray()),
            'delivery.currencyCOD' => 'nullable|max:10',
            'delivery.amountCOD' => 'nullable|numeric',
            'delivery.additionalInfo' => 'nullable',
            'delivery.note' => 'nullable',
            'contactPerson' => 'nullable|max:40',
            'phone' => 'nullable|max:20',
            'email' => 'nullable|email|max:40',
            'name1' => 'nullable|max:40',
            'name2' => 'nullable|max:40',
            'name3' => 'nullable|max:40',
            'countryCode' => 'nullable|alpha|max:3',
            'postalCode' => 'nullable|max:10',
            'place' => 'nullable|max:30',
            'street' => 'nullable|max:50',
            'serialNumber' => 'nullable',
            'note' => 'nullable|max:2048',
            'positions.*.productId' => 'nullable|integer',
            'positions.*.refId' => 'nullable|integer',
            'positions.*.additionalId' => 'nullable|integer',
            'positions.*.quantity' => 'nullable|integer',
            'attachments.*.name' => 'nullable',
            'attachments.*.content' => 'nullable',
            'parcels' => 'nullable',
        ];

        $data = $this->toArray();
        return $this->validateHandle($data, $rules);
    }


    public function toArray()
    {
        return [
            'id' => $this->getId(),
            'refId' => $this->getRefId(),
            'number' => $this->getNumber(),
            'signature' => $this->getSignature(),
            'source' => $this->getSource(),
            'status' => $this->getStatus(),
            'statusDate' => $this->getStatusDate(),
            'addDate' => $this->getAddDate(),
            'forwardDate' => $this->getForwardDate(),
            'packDate' => $this->getPackDate(),
            'comments' => $this->getComments(),
            'delivery' => ($this->getDelivery()) ? $this->getDelivery()->toArray() : null,
            'contactPerson' => $this->getContactPerson(),
            'phone' => $this->getPhone(),
            'email' => $this->getEmail(), 
            'name1' => $this->getName1(), 
            'name2' => $this->getName2(), 
            'name3' => $this->getName3(),
            'countryCode' => $this->getCountryCode(),
            'postalCode' => $this->getPostalCode(),
            'place' => $this->getPlace(),
            'street' => $this->getStreet(),
            'serialNumber' => $this->getSerialNumber(),
            'note' => $this->getNote(),
            'positions'=> ($this->getPositions()) ? $this->getPositions()->toArray() : null,
            'attachments' => ($this->getAttachments()) ? $this->getAttachments()->toArray() : null,
            'parcels' => ($this->getParcels()) ? $this->getParcels()->toArray() : null
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
    public function setRefId(int $refId): self
    {
        $this->refId = $refId;

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
     * Get the value of signature
     */ 
    public function getSignature(): ?string
    {
        return $this->signature;
    }

    /**
     * Set the value of signature
     *
     * @return  self
     */ 
    public function setSignature(?string $signature): self
    {
        $this->signature = $signature;

        return $this;
    }

    /**
     * Get the value of source
     */ 
    public function getSource(): ?string
    {
        return $this->source;
    }

    /**
     * Set the value of source
     *
     * @return  self
     */ 
    public function setSource(?string $source): self
    {
        $this->source = $source;

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
    public function setStatus(?string $status): self
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
     * Get the value of addDate
     */ 
    public function getAddDate(): ?string
    {
        return $this->addDate;
    }

    /**
     * Set the value of addDate
     *
     * @return  self
     */ 
    public function setAddDate(?string $addDate): self
    {
        $this->addDate = $addDate;

        return $this;
    }

    /**
     * Get the value of forwardDate
     */ 
    public function getForwardDate(): ?string 
    {
        return $this->forwardDate;
    }

    /**
     * Set the value of forwardDate
     *
     * @return  self
     */ 
    public function setForwardDate(?string $forwardDate): self
    {
        $this->forwardDate = $forwardDate;

        return $this;
    }

    /**
     * Get the value of packDate
     */ 
    public function getPackDate(): ?string
    {
        return $this->packDate;
    }

    /**
     * Set the value of packDate
     *
     * @return  self
     */ 
    public function setPackDate(?string $packDate): self
    {
        $this->packDate = $packDate;

        return $this;
    }

    /**
     * Get the value of comments
     */ 
    public function getComments(): ?string
    {
        return $this->comments;
    }

    /**
     * Set the value of comments
     *
     * @return  self
     */ 
    public function setComments(?string $comments): self
    {
        $this->comments = $comments;

        return $this;
    }

    /**
     * Get the value of delivery
     */ 
    public function getDelivery(): ?Delivery
    {
        return $this->delivery;
    }

    /**
     * Set the value of delivery
     *
     * @return  self
     */ 
    public function setDelivery(?Delivery $delivery)
    {
        $this->delivery = $delivery;

        return $this;
    }

    /**
     * Get the value of contactPerson
     */ 
    public function getContactPerson(): ?string
    {
        return $this->contactPerson;
    }

    /**
     * Set the value of contactPerson
     *
     * @return  self
     */ 
    public function setContactPerson(?string $contactPerson): self
    {
        $this->contactPerson = $contactPerson;

        return $this;
    }

    /**
     * Get the value of phone
     */ 
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * Set the value of phone
     *
     * @return  self
     */ 
    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of name1
     */ 
    public function getName1(): ?string
    {
        return $this->name1;
    }

    /**
     * Set the value of name1
     *
     * @return  self
     */ 
    public function setName1(?string $name1): self
    {
        $this->name1 = $name1;

        return $this;
    }

    /**
     * Get the value of name2
     */ 
    public function getName2(): ?string
    {
        return $this->name2;
    }

    /**
     * Set the value of name2
     *
     * @return  self
     */ 
    public function setName2(?string $name2): self
    {
        $this->name2 = $name2;

        return $this;
    }

    /**
     * Get the value of name3
     */ 
    public function getName3(): ?string
    {
        return $this->name3;
    }

    /**
     * Set the value of name3
     *
     * @return  self
     */ 
    public function setName3(?string $name3): self
    {
        $this->name3 = $name3;

        return $this;
    }

    /**
     * Get the value of countryCode
     */ 
    public function getCountryCode(): ?string
    {
        return $this->countryCode;
    }

    /**
     * Set the value of countryCode
     *
     * @return  self
     */ 
    public function setCountryCode(?string $countryCode): self
    {
        $this->countryCode = $countryCode;

        return $this;
    }

    /**
     * Get the value of postalCode
     */ 
    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    /**
     * Set the value of postalCode
     *
     * @return  self
     */ 
    public function setPostalCode(?string $postalCode): self
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * Get the value of place
     */ 
    public function getPlace(): ?string
    {
        return $this->place;
    }

    /**
     * Set the value of place
     *
     * @return  self
     */ 
    public function setPlace(?string $place): self
    {
        $this->place = $place;

        return $this;
    }

    /**
     * Get the value of street
     */ 
    public function getStreet(): ?string
    {
        return $this->street;
    }

    /**
     * Set the value of street
     *
     * @return  self
     */ 
    public function setStreet(?string $street): self
    {
        $this->street = $street;

        return $this;
    }

    /**
     * Get the value of serialNumber
     */ 
    public function getSerialNumber(): ?string
    {
        return $this->serialNumber;
    }

    /**
     * Set the value of serialNumber
     *
     * @return  self
     */ 
    public function setSerialNumber(?string $serialNumber): self
    {
        $this->serialNumber = $serialNumber;

        return $this;
    }

    /**
     * Get the value of note
     */ 
    public function getNote(): ?string
    {
        return $this->note;
    }

    /**
     * Set the value of note
     *
     * @return  self
     */ 
    public function setNote(?string $note): self
    {
        $this->note = $note;

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

    /**
     * Get the value of attachments
     */ 
    public function getAttachments(): ?OrderAttachments
    {
        return $this->attachments;
    }

    /**
     * Set the value of attachments
     *
     * @return  self
     */ 
    public function setAttachments(?OrderAttachments $attachments): self
    {
        $this->attachments = $attachments;

        return $this;
    }

    /**
     * Get the value of parcels
     */ 
    public function getParcels(): ?OrderParcels
    {
        return $this->parcels;
    }

    /**
     * Set the value of parcels
     *
     * @return  self
     */ 
    public function setParcels(?OrderParcels $parcels): self
    {
        $this->parcels = $parcels;

        return $this;
    }
}
