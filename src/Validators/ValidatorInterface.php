<?php

namespace Phpshko\Test\Validators;

use Phpshko\Test\Forms\FormInterface;

interface ValidatorInterface
{
    /**
     * @param FormInterface $form
     * @param string        $attribute
     * @return bool
     */
    public function validateAttribute(FormInterface $form, string $attribute): bool;

    /**
     * Return array of errors [$template, $params]
     * @param $value
     * @return array|null
     */
    public function validateValue($value): ?array;

    /**
     * @param mixed $value
     * @return bool
     */
    public function isEmpty($value): bool;
}