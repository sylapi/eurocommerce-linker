<?php

declare(strict_types=1);

namespace Sylapi\EurocommerceLinker;

use GuzzleHttp\Client;

class Session
{
    private $parameters;
    private $client;

    public function __construct(Parameters $parameters)
    {
        $this->parameters = $parameters;
        $this->client = null;
    }

    public function client(): ?Client
    {
        if (!$this->client) {
            $this->initializeSession();
        }

        return $this->client;
    }

    public function headers()
    {
        return [
            'Content-Type' => 'application/json;charset=UTF-8',
            'Authorization' => 'Basic '.base64_encode($this->parameters()->getLogin().':'.$this->parameters()->getPassword())
        ];
    }

    private function initializeSession(): void
    {

        $this->client = new Client([
            'base_uri' => $this->parameters->getApiUrl(),
            'headers'  => $this->headers()
        ]);
    }

    public function parameters(): Parameters
    {
        return $this->parameters;
    }
}
