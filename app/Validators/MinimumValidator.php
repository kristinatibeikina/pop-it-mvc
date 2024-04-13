<?php

namespace Validators;

use Src\Validator\AbstractValidator;

class MinimumValidator extends AbstractValidator
{

    protected string $message = 'Field :недостаточный размер';

    public function rule(): bool
    {
        return empty($this->value)>8;
    }
}
