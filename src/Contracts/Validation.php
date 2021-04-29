<?php

declare(strict_types=1);

namespace Sylapi\EurocommerceLinker\Contracts;

use Sylapi\EurocommerceLinker\Collections\Errors;

interface Validation
{
    public function addError(string $error): self;
    public function setErrors(array $errors): self;
    public function getErrors(): Errors;
    public function validate(): bool;
}