<?php

namespace Validators;

use Src\Validator\AbstractValidator;

class CyrillicValidator extends AbstractValidator
{

    protected string $message = 'Field :кирилица';

    public function rule(): bool
    {
        return preg_match('/^[\p{Cyrillic}]+$/u', ($this->value));

    }
}