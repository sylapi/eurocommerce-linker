<?php
declare(strict_types=1);

namespace Sylapi\EurocommerceLinker\Enums;

use Sylapi\EurocommerceLinker\Abstracts\Enums;

class OrderStatusType extends Enums
{
    const DRAFT = 'ROBOCZE';
    const TRANSFERRED = 'PRZEKAZANE';
    const PACKED = 'ZAPAKOWANE';
    const SENT = 'WYSŁANE';
    const DELIVERED = 'DOSTARCZONE';
    const CANCELLED = 'ANULOWANE';
    const ERROR = 'BŁĄD';

    public static function toArray()
    {
        return [
            'DRAFT' => self::DRAFT,
            'TRANSFERRED' => self::TRANSFERRED,
            'PACKED' => self::PACKED,
            'SENT' => self::SENT,
            'DELIVERED' => self::DELIVERED,
            'CANCELLED' => self::CANCELLED,
            'ERROR' => self::ERROR
        ];
    }
}
