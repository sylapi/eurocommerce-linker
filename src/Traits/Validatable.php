<?php
declare(strict_types=1);

namespace Sylapi\EurocommerceLinker\Traits;

use Rakit\Validation\Validator;
use Sylapi\EurocommerceLinker\Collections\Errors;

trait Validatable
{
    private $errors;
    private $validator;
    
    private function initializeValidation(): void
    {
        if(!($this->validator instanceof Validator)) {
            $this->validator = new Validator();
        }
        if(!($this->errors instanceof Errors)) {
            $this->errors = new Errors();
        }
    }

    private function validator(): Validator
    {
        $this->initializeValidation();
        return $this->validator;
    }

    private function validateHandle(array $data = [], array $rules = []): bool
    {
        $validation = $this->validator()->validate($data, $rules);

        if ($validation->fails()) {
            $this->setErrors($validation->errors()->toArray());
            return false;
        }

        return true;
    }

    public function addError(string $error): self
    {
        $this->initializeValidation();
        $this->errors->append($error);
        return $this;
    }

    public function setErrors(array $errors): self
    {
        $this->initializeValidation();
        $this->errors = new Errors($errors);
        return $this;
    }

    public function getErrors(): Errors
    {
        $this->initializeValidation();
        return $this->errors;
    }
}
