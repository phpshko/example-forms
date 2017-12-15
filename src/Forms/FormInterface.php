<?php

namespace Phpshko\Test\Forms;

interface FormInterface
{
    /**
     * @return bool
     */
    public function validate(): bool;

    /**
     * @param array $data
     * @return bool
     */
    public function load(array $data = []): bool;

    /**
     * @param string $attribute
     * @param string $message
     * @param array  $params
     * @return void
     */
    public function addError(string $attribute, string $message, array $params = []): void;

    /**
     * @param array $attributes
     * @return array
     */
    public function getErrors(array $attributes = []): array;

    /**
     * @param array $attributes
     * @return bool
     */
    public function hasErrors(array $attributes = []): bool;
}