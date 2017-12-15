<?php

namespace Phpshko\Test\Validators;

class StringValidator extends AbstractValidator
{
    public $message = '{attribute} should be string';
    public $tooShort = '{attribute} should contain at least {min} characters';
    public $tooLong = '{attribute} should contain at most {max} characters';

    /**
     * @var null|int Minimal string length
     */
    public $min;

    /**
     * @var null|int Maximal string length
     */
    public $max;

    /**
     * @inheritdoc
     */
    public function validateValue($value): ?array
    {
        $params = ['min' => $this->min, 'max' => $this->max];

        if (!is_string($value)) {
            return [[$this->message, $params]];
        }

        $length = mb_strlen($value);

        if ($this->min && $length < $this->min) {
            return [[$this->tooShort, $params]];
        }

        if ($this->max && $length > $this->max) {
            return [[$this->tooLong, $params]];
        }

        return null;
    }
}