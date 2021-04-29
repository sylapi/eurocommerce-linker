<?php
declare(strict_types=1);

namespace Sylapi\EurocommerceLinker\Enums;

use Sylapi\EurocommerceLinker\Abstracts\Enums;

class ParcelStatusType extends Enums
{
    const NEW = 'ZAPAKOWANA';
    const SENT = 'WYSŁANA';
    const DELIVERED = 'DOSTARCZONA';
    const PICKUP_READY = 'W PUNKCIE ODBIORU';
    const CANCELLED = 'ANULOWANA';
    const OTHER = 'INNE';

    public static function toArray()
    {
        return [
            'NEW' => self::NEW,
            'SENT' => self::SENT,
            'DELIVERED' => self::DELIVERED,
            'PICKUP_READY' => self::PICKUP_READY,
            'CANCELLED' => self::CANCELLED,
            'OTHER' => self::OTHER
        ];
    }
}
