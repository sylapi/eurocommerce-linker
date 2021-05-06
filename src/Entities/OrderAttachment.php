<?php
declare(strict_types=1);

namespace Sylapi\EurocommerceLinker\Entities;

use Sylapi\EurocommerceLinker\Abstracts\Entity;
use Sylapi\EurocommerceLinker\Traits\Validatable;

class OrderAttachment extends Entity
{
    use Validatable;

    private $name;
    private $content;

    public function validate(): bool
    {
        $rules = [
            'name' => 'nullable',
            'content' => 'nullable'
        ];

        $data = [
            'name' => $this->getName(),
            'content' => $this->getContent()
        ];

        return $this->validateHandle($data, $rules);
    }

    public function toArray()
    {
        return [
            'name' => $this->getName(),
            'content' => $this->getContent()
        ];
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
     * Get the value of content
     */ 
    public function getContent(): ?string 
    {
        return $this->content;
    }

    /**
     * Set the value of content
     *
     * @return  self
     */ 
    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }
}
