<?php

namespace Validators;

use Src\Validator\AbstractValidator;

class NumericValidator extends AbstractValidator
{

    protected string $message = 'Field : введены не числа';

    public function rule(): bool
    {
        return ctype_digit($this->value);
    }
}
