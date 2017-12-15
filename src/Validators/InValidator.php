<?php

namespace Phpshko\Test\Validators;

class InValidator extends AbstractValidator
{
    /**
     * @var array Allowed values
     */
    public $range = [];

    public $message = '{attribute} is invalid';

    /**
     * @inheritdoc
     */
    public function validateValue($value): ?array
    {
        if ((!is_string($value) && !is_int($value)) || !in_array($value, $this->range, true)) {
            return $this->getDefaultErrors();
        }

        return null;
    }
}