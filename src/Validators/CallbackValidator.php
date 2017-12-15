<?php

namespace Phpshko\Test\Validators;

class CallbackValidator extends AbstractValidator
{
    /**
     * @var callable
     */
    public $callback;

    /**
     * Always return null. Errors to form add from callback
     * @inheritdoc
     */
    public function validateValue($value): ?array
    {
        ($this->callback)($value);
        return null;
    }
}