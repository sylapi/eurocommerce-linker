<?php
declare(strict_types=1);

namespace Sylapi\EurocommerceLinker\Abstracts;

use Sylapi\EurocommerceLinker\Contracts\Validation;
use stdClass;

abstract class Entity extends stdClass implements Validation
{
    abstract public function validate(): bool;
}
