<?php

namespace Validators;

use Src\Validator\AbstractValidator;

class LatinValidator extends AbstractValidator
{

    protected string $message = 'Field :латиница и цифры';

    public function rule(): bool
    {
        return preg_match('/^[\p{Latin}]+/u', ($this->value));

    }
}
