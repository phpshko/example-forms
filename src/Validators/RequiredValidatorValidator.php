<?php

namespace Phpshko\Test\Validators;

class RequiredValidatorValidator extends AbstractValidator implements RequiredValidatorInterface
{
    public $message = '{attribute} is required';

    /**
     * @inheritdoc
     */
    public function validateValue($value): ?array
    {
        //we assume that 0 and FALSE is a filled field
        if ($value === 0 || $value === false) {
            return null;
        }

        return !empty($value) ? null : $this->getDefaultErrors();
    }
}