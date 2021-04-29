<?php
declare(strict_types=1);

namespace Sylapi\EurocommerceLinker\Api;

class OrderAttachments
{
    private $session;

    const API_PATH = 'orders/{id}/attachments';

    public function __construct($session)
    {
        $this->session = $session;
    }
}