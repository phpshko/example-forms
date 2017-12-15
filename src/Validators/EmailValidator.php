<?php

namespace Phpshko\Test\Validators;

class EmailValidator extends AbstractValidator
{
    public $pattern = '/^[a-zA-Z0-9!#$%&\'*+\\/=?^_`{|}~-]+(?:\.[a-zA-Z0-9!#$%&\'*+\\/=?^_`{|}~-]+)*@(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?$/';

    public $message = '{attribute} is not a valid email';

    /**
     * @inheritdoc
     */
    public function validateValue($value): ?array
    {
        if (is_string($value) && preg_match($this->pattern, $value)) {
            return null;
        }

        return $this->getDefaultErrors();
    }
}