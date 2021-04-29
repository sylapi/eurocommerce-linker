<?php

declare(strict_types=1);

namespace Sylapi\EurocommerceLinker;

use ArrayObject;
use Sylapi\EurocommerceLinker\Contracts\Validation;
use Sylapi\EurocommerceLinker\Traits\Validatable;

/**
 * @method string getApiUrl()
 * @method string setApiUrl(string $value)
 * @method string getLogin()
 * @method string setLogin(string $value)
 * @method string getPassword()
 * @method string setPassword(string $value)
 * @method string getDebug()
 * @method string setDebug(bool $value)
 */
class Parameters extends ArrayObject implements Validation 
{
    use Validatable;
    
    public static function create(array $parameters): self
    {
        return new self($parameters, ArrayObject::ARRAY_AS_PROPS);
    }


    public function validate(): bool
    {
        $validation = $this->validator()->validate(
            (array) $this,
            [
                'login' => 'required',
                'password' => 'required'
            ]
        );

        $validation->validate();

        if ($validation->fails()) {
            $this->setErrors($validation->errors()->toArray());
            return false;
        }

        return true;
    }


    public function __call($method, $arguments)
    {
        if(preg_match("/^(get|set)/", $method)) {
            $response = null;
            $property = $this->propertyNameByMethod($method);
            if(preg_match("/^(get)/", $method)) {
                $response = $this->{$property} ?? null;
            } else {
                $this->{$property} = $arguments[0] ?? null;
                $response = $this;
            }
            return $response;
        } 
    }

    private function propertyNameByMethod(string $method): string
    {
        return lcfirst(str_replace(['get','set'], '', $method));
    }
}