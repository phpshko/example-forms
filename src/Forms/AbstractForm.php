<?php

namespace Phpshko\Test\Forms;

abstract class AbstractForm implements FormInterface
{
    /**
     * @var string[]
     */
    protected $_errors = [];

    /**
     * Rules for validation
     * @return array
     */
    abstract protected function rules(): array;

    /**
     * @inheritdoc
     */
    public function validate(): bool
    {
        $this->_errors = [];

        foreach ($this->rules() as $rule) {
            $formRule = new FormRule($this, $rule);
            //Validate and add error to form
            $formRule->validate();
        }

        return empty($this->_errors);
    }

    /**
     * Load form attributes
     * @inheritdoc
     */
    public function load(array $data = []): bool
    {
        if (empty($data)) {
            return false;
        }

        foreach ($data as $attribute => $value) {
            $this->$attribute = $value;
        }

        return true;
    }

    /**
     * @inheritdoc
     */
    public function addError(string $attribute, string $message, array $params = []): void
    {
        $params['attribute'] = $attribute;

        foreach ($params as $name => $value) {
            $message = str_replace('{' . $name . '}', $value, $message);
        }

        $this->_errors[$attribute][] = $message;
    }

    /**
     * @inheritdoc
     */
    public function getErrors(array $attributes = []): array
    {
        if (empty($attributes)) {
            return $this->_errors;
        }

        $errors = [];

        foreach ($attributes as $attribute) {
            if (array_key_exists($attribute, $this->_errors)) {
                $errors[$attribute] = $this->_errors[$attribute];
            }
        }

        return $errors;
    }

    /**
     * @inheritdoc
     */
    public function hasErrors(array $attributes = []): bool
    {
        return !empty($this->getErrors($attributes));
    }
}