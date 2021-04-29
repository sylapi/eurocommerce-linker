<?php
declare(strict_types=1);

namespace Sylapi\EurocommerceLinker\Entities;

use Sylapi\EurocommerceLinker\Abstracts\Entity;
use Sylapi\EurocommerceLinker\Traits\Validatable;
use Sylapi\EurocommerceLinker\Enums\CarierType;

class Delivery extends Entity
{
    use Validatable;

    private $carier;
    private $currencyCOD;
    private $amountCOD;
    private $additionalInfo;
    private $note;

    public function validate(): bool
    {
        $rules = [
            'carier' => 'required|max:10|in:'.implode(',', CarierType::toArray()),
            'currencyCOD' => 'nullable|max:10',
            'amountCOD' => 'nullable|numeric',
            'additionalInfo' => 'nullable',
            'note' => 'nullable',
        ];

        $data = $this->toArray();

        return $this->validateHandle($data, $rules);
    }

    public function toArray(): array
    {
        return [
            'carier' => $this->getCarier(),
            'currencyCOD' => $this->getCurrencyCOD(),
            'amountCOD' => $this->getAmountCOD(),
            'additionalInfo' => $this->getAdditionalInfo(),
            'note' => $this->getNote(),
        ];
    }

    /**
     * Get the value of carier
     */ 
    public function getCarier(): string
    {
        return $this->carier;
    }

    /**
     * Set the value of carier
     *
     * @return  self
     */ 
    public function setCarier(string $carier)
    {
        $this->carier = $carier;

        return $this;
    }

    /**
     * Get the value of currencyCOD
     */ 
    public function getCurrencyCOD(): string
    {
        return $this->currencyCOD;
    }

    /**
     * Set the value of currencyCOD
     *
     * @return  self
     */ 
    public function setCurrencyCOD(string $currencyCOD)
    {
        $this->currencyCOD = $currencyCOD;

        return $this;
    }

    /**
     * Get the value of amountCOD
     */ 
    public function getAmountCOD(): float
    {
        return $this->amountCOD;
    }

    /**
     * Set the value of amountCOD
     *
     * @return  self
     */ 
    public function setAmountCOD(float $amountCOD)
    {
        $this->amountCOD = $amountCOD;

        return $this;
    }

    /**
     * Get the value of additionalInfo
     */ 
    public function getAdditionalInfo(): string
    {
        return $this->additionalInfo;
    }

    /**
     * Set the value of additionalInfo
     *
     * @return  self
     */ 
    public function setAdditionalInfo(string $additionalInfo)
    {
        $this->additionalInfo = $additionalInfo;

        return $this;
    }

    /**
     * Get the value of note
     */ 
    public function getNote(): string
    {
        return $this->note;
    }

    /**
     * Set the value of note
     *
     * @return  self
     */ 
    public function setNote(string $note)
    {
        $this->note = $note;

        return $this;
    }
}
