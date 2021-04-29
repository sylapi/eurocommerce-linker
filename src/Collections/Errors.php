<?php
declare(strict_types=1);

namespace Sylapi\EurocommerceLinker\Collections;

use Exception;
use Sylapi\EurocommerceLinker\Abstracts\Collection;
use Sylapi\EurocommerceLinker\Exceptions\CollectionException;
use Sylapi\EurocommerceLinker\Exceptions\ValidateException;

class Errors extends Collection
{
    public function getFirstError(): ?array
    {
        if($this->has()) {
            return null;
        }
        $errors = $this->toArray();
        $error = current($errors);
        return ($error === false || !is_array($error)) ? null : $error;
    }


    public function has()
    {
        return ($this->count() < 1);
    }

    public function createValidateException(): ValidateException
    {
        $error = $this->getFirstError();
        if(!$error) {
            throw new Exception('No Errors');
        }
    
        return  new ValidateException($this->createMessage($error));
    }

    private function createMessage(array $error): ?string
    {
        return current($error);
    }
}
