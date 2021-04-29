<?php

declare(strict_types=1);

namespace Sylapi\EurocommerceLinker;

use Sylapi\EurocommerceLinker\Exceptions\ValidateException;

class SessionFactory
{
    private $sessions = [];
    private $parameters;

    const API_LIVE = 'https://magazyn.eurocommerce.pl/api/';

    public function session(Parameters $parameters): Session
    {
        if(!$parameters->validate()) {
            throw $parameters->getErrors()->createValidateException();
        }

        $this->parameters = $parameters;
        $this->parameters->setApiUrl(self::API_LIVE);
        $key = sha1($this->parameters->getApiUrl().':'.$this->parameters->getLogin().':'.$this->parameters->getPassword());
        return (isset($this->sessions[$key])) ? $this->sessions[$key] : ($this->sessions[$key] = new Session($this->parameters));
    }
}