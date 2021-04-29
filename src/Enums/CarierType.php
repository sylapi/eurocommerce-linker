<?php
declare(strict_types=1);

namespace Sylapi\EurocommerceLinker\Enums;

use Sylapi\EurocommerceLinker\Abstracts\Enums;

class CarierType extends Enums
{
    const GLSDEEUROB = 'GLSDEEUROB';
    const GLSPLSTAND = 'GLSPLSTAND';
    const GLSCZSTAND = 'GLSCZSTAND';
    const POCZTK48ST = 'POCZTK48ST';
    const POCZTK48OP = 'POCZTK48OP';
    const POCZTPECOM = 'POCZTPECOM';
    const INPOSPACZK = 'INPOSPACZK';

    public static function toArray()
    {
        return [
            'GLSDEEUROB' => self::GLSDEEUROB,
            'GLSPLSTAND' => self::GLSPLSTAND,
            'GLSCZSTAND' => self::GLSCZSTAND,
            'POCZTK48ST' => self::POCZTK48ST,
            'POCZTK48OP' => self::POCZTK48OP,
            'POCZTPECOM' => self::POCZTPECOM,
            'INPOSPACZK' => self::INPOSPACZK
        ];
    }    
}
